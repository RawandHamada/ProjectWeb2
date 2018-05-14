<?php

namespace App\Http\Controllers\Doctors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctors;
use App\Mail\DoctorResetPassword;
use DB;
use Carbon\Carbon;
use Mail;

//use Illuminate\Support\Facades\Request;
class DoctorAuth extends Controller
{
    public function login(){

        return view('doctors.login');
    }

    public function dologin(){
        if(doctors()->attempt(['email'=>request('username'),'password'=>request('password')])||doctors()->attempt(['name'=>request('username'),'password'=>request('password')]) ){

            return redirect('doctors');
        }else{
            session()->flash('error',trans('doctors.incorrect_information_login'));
            return redirect('doctors/login');
        }
    }

    public function forgot_password(){
        return view('doctors.forgot_password');
    }

    public function forgot_password_post(){

        $doctor = Doctors::get()->where('email',request('username'))->first();

        if(!empty($doctor)){

            //$token = app('auth.password.broker')->createToken($doctor);
            $token = str_random(64);
            $data = DB::table('password_resets')->insert([

                'email'=>$doctor->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);
            //return new DoctorResetPassword(['data'=>$doctor,'token'=>$token]);
            Mail::to($doctor->email)->send(new DoctorResetPassword(['data'=>$doctor,'token'=>$token]));
            session()->flash('success',trans('doctors.link_reset_sent'));
            return back();
        }
        return back();

    }

    public function reset_password($token){

        $check_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('doctors.reset_password',['data'=>$check_token]);
        }else{
            return redirect(aurl('forgot/password'));
        }
    }

    public function reset_password_final($token){
        //return request();
        $this->validate(request(),[
           'password'               =>'required|confirmed',
           'password_confirmation'  => 'required',
        ],[],[
                'password'              =>'Password',
                'password_confirmation' =>'Password Confirmation'

        ]);
        $check_token = DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            $doctors = Doctors::where('email',$check_token->email)
            ->update(['email'=>$check_token->email,'password'=>bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email',request('email'))->delete();
/*             doctors()->attempt($doctors); */
            doctors()->attempt(['email'=>$check_token->email,'password'=>request('password')]);

            return redirect(aurl());
        }else{
            return redirect(aurl('forgot/password'));
        }
    }

    public function logout(){

        auth()->guard('doctors')->logout();
        return redirect('doctors/login');

    }
}
