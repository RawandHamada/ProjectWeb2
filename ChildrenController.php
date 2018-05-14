<?php

namespace App\Http\Controllers\Doctors;
use App\DataTables\ChildrenDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Children;
use App\Doctors;


class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChildrenDatatable $children)
    {

        return $children->render('doctors.children_table.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctors::get()->pluck('name', 'id');
        $enum_gender = Children::$enum_gender;
        return view('doctors.children.create',['enum_gender'=>$enum_gender,'doctors'=>$doctors]);
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
            'doctor_id'         =>'required',
            'child_id'          =>'required|unique:children',
            'name'              =>'required',
            'gender'            =>'required',
            'birth_of_date'     =>'required',
            'age'               =>'required',
        ],[],[
           'doctor_id'          =>trans('doctors.doctor_id'),
           'child_id'           =>trans('doctors.child_id'),
           'name'               =>trans('doctors.name_child'),
           'gender'             =>trans('doctors.gender_child'),
           'birth_of_date'      =>trans('doctors.birth_of_date_child'),
           'age'                =>trans('doctors.age_child'),
        ]);

  /*       dd($data); */

        Children::create($data);
        session()->flash('success',trans('doctors.record_added_child'));
        return redirect(aurl('allchildren'));
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
        $doctors = Doctors::get()->pluck('name', 'id');
        $child = Children::find($id);
        $enum_gender = Children::$enum_gender;
        return view('doctors.children.edit',['child'=>$child,'enum_gender'=>$enum_gender,'doctors'=>$doctors]);
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
            'child_id'          =>'required|unique:children,child_id,'.$id,
            'name'              =>'required',
            'gender'            =>'required',
            'birth_of_date'     =>'required',
            'age'               =>'required',
        ],[],[
           'child_id'           =>trans('doctors.child_id'),
           'name'               =>trans('doctors.name_child'),
           'gender'             =>trans('doctors.gender_child'),
           'birth_of_date'      =>trans('doctors.birth_of_date_child'),
           'age'                =>trans('doctors.age_child'),
        ]);
        Children::where('id',$id)->update($data);
        session()->flash('success',trans('doctors.updated_record_added_child'));
        return redirect(aurl('allchildren'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Children::find($id)->delete();
        session()->flash('success',trans('doctors.deleted_record_child'));
        return redirect(aurl('allchildren'));
    }
    public function multi_delete()
    {
        if(is_array(request('item'))){
            Children::destroy(request('item'));
        }else{
            Children::find(request('item'))->delete();
        }
        session()->flash('success',trans('doctors.deleted_record_child'));
        return redirect(aurl('allchildren'));
    }

}