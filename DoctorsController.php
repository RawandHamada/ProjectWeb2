<?php

namespace App\Http\Controllers\Api;
use App\DataTables\DoctorsDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctors;
use App\Children;

class DoctorsController extends Controller
{
    public function all_doctors(){
        $all_doctors= Doctors::orderBy('id','desc')->paginate(10);
        return response(['all_doctors'=>$all_doctors]);
    }
    public function doctor($id){
        $doctor = Doctors::find($id)->with('children')->paginate(10);
        return !empty($doctor) ? response(['status'=>true,'doctor'=>$doctor]) : response(['status'=>false]);
    }

}