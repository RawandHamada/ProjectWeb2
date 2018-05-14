<?php

namespace App\Http\Controllers\Api;
use App\DataTables\ChildrenDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Children;
use App\Doctors;

class ChildrenController extends Controller
{
    public function all_children(){
        $all_children= Children::orderBy('id','desc')->paginate(10);
        return response(['all_children'=>$all_children]);
    }
    public function child($id){
        $child = Children::find($id)->with('vital')->paginate(10);
        return !empty($child) ? response(['status'=>true,'child'=>$child]) : response(['status'=>false]);
    }

}