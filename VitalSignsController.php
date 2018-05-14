<?php

namespace App\Http\Controllers\Doctors;
use App\Http\Controllers\Controller;
use App\DataTables\VitalSignsDatatable;
use Illuminate\Http\Request;
use App\VitalSigns;
use App\Children;


class VitalSignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VitalSignsDatatable $VitalSigns)
    {
       /*  return view('doctors.VitalSigns.index'); */
        return $VitalSigns->render('doctors.VitalSigns_table.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = Children::get()->pluck('name', 'id');
        return view('doctors.VitalSigns.create',['children'=>$children]);
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
            'child_id'               =>'required',
            'length'                 =>'required',
            'temperature'            =>'required',
            'respiratory_rate'       =>'required',
            'size'                   =>'required',
            'heart_beat'             =>'required',
            'blood_pressure'         =>'required',
        ],[],[
           'child_id'               =>trans('doctors.child_id'),
           'length'                 =>trans('doctors.length'),
           'temperature'            =>trans('doctors.gender_child'),
           'respiratory_rate'       =>trans('doctors.birth_of_date_child'),
           'size'                   =>trans('doctors.size'),
           'heart_beat'             =>trans('doctors.heart_beat'),
           'blood_pressure'         =>trans('doctors.blood_pressure'),
        ]);

        VitalSigns::create($data);
        session()->flash('success',trans('doctors.record_added_VitalSigns'));
        return redirect(aurl('VitalSigns'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VitalSigns  $vitalSigns
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test=VitalSigns::with('child_id')->find($id);
        return $test;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VitalSigns  $vitalSigns
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $VitalSigns = VitalSigns::find($id);
        $children = Children::get()->pluck('name', 'id');
        return view('doctors.VitalSigns.edit',['VitalSigns'=>$VitalSigns,'children'=>$children]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VitalSigns  $vitalSigns
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
        [
            'child_id'               =>'required',
            'length'                 =>'required',
            'temperature'            =>'required',
            'respiratory_rate'       =>'required',
            'size'                   =>'required',
            'heart_beat'             =>'required',
            'blood_pressure'         =>'required',
        ],[],[
           'child_id'               =>trans('doctors.child_id'),
           'length'                 =>trans('doctors.length'),
           'temperature'            =>trans('doctors.gender_child'),
           'respiratory_rate'       =>trans('doctors.birth_of_date_child'),
           'size'                   =>trans('doctors.size'),
           'heart_beat'             =>trans('doctors.heart_beat'),
           'blood_pressure'         =>trans('doctors.blood_pressure'),
        ]);

        VitalSigns::where('id',$id)->update($data);
        session()->flash('success',trans('doctors.updated_record_VitalSigns'));
        return redirect(aurl('VitalSigns'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VitalSigns  $vitalSigns
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VitalSigns::find($id)->delete();
        session()->flash('success',trans('doctors.deleted_record'));
        return redirect(aurl('VitalSigns'));
    }
    public function multi_delete()
    {
        if(is_array(request('item'))){
            VitalSigns::destroy(request('item'));
        }else{
            VitalSigns::find(request('item'))->delete();
        }
        session()->flash('success',trans('doctors.deleted_record'));
        return redirect(aurl('VitalSigns'));
    }
}
