<?php

namespace App\Http\Controllers\Doctors;
use App\DataTables\DoctorsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctors;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorsDatatable $doctor)
    {
        return $doctor->render('doctors.doctors_table.index',['title' => 'Doctor Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
        [
            'name'      =>'required',
            'email'     =>'required|email|unique:doctors',
            'password'  =>'required|min:6'
        ],[],[
           'name'       =>trans('doctors.doctor.fields.name'),
           'email'      =>trans('doctors.doctor.fields.email'),
           'password'   =>trans('doctors.doctor.fields.password'),
        ]);
        $data['password'] = bcrypt(request('password'));
        Doctors::create($data);
        session()->flash('success',trans('doctors.record_added'));
        return redirect(aurl('alldoctors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctors::find($id);
        return view('doctors.doctors.edit',['doctor'=>$doctor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
        [
            'name'      =>'required',
            'email'     =>'required|email|unique:doctors,email,'.$id,
            'password'  =>'sometimes|nullable|min:6'
        ],[],[
           'name'       =>trans('doctors.doctor.fields.name'),
           'email'      =>trans('doctors.doctor.fields.email'),
           'password'   =>trans('doctors.doctor.fields.password'),
        ]);
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
        }
        Doctors::where('id',$id)->update($data);
        session()->flash('success',trans('doctors.updated_record_added'));
        return redirect(aurl('alldoctors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctors::find($id)->delete();
        session()->flash('success',trans('doctors.deleted_record'));
        return redirect(aurl('alldoctors'));
    }
    public function multi_delete()
    {
        if(is_array(request('item'))){
            Doctors::destroy(request('item'));
        }else{
            Doctors::find(request('item'))->delete();
        }
        session()->flash('success',trans('doctors.deleted_record'));
        return redirect(aurl('alldoctors'));
    }

}