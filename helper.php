<?php
    if(!function_exists('aurl'))
    {
        function aurl($url=null){

            return url('doctors/'.$url);
        }
    }
    if(!function_exists('surl'))
    {
        function surl($url=null){

            return url('Childrens/'.$url);
        }
    }
    if(!function_exists('doctors'))
    {
        function doctors(){

            return auth()->guard('doctors');
        }
    }

    if(!function_exists('lang')){
        function lang(){
            if(session()->has('lang')){
                return session('lang');
            }else{
                return 'en';
            }
        }
    }
    if(!function_exists('direction')){
        function direction(){
            if(session()->has('lang')){
                if(session('lang')== 'ar'){
                    return 'rtl';
                }else{
                    return 'ltr';
                }
            }else{
                return 'ltr';
            }
        }
    }
    if(!function_exists('datatable_Lang')){
        function datatable_Lang(){
           return ['sProcessing'       => trans('doctors.sProcessing'),
           'sLengthMenu'       => trans('doctors.sLengthMenu'),
           'sZeroRecords'      => trans('doctors.sZeroRecords'),
           'sEmptyTable'       => trans('doctors.sEmptyTable'),
           'sInfo'             => trans('doctors.sInfo'),
           'sInfoEmpty'        => trans('doctors.sInfoEmpty'),
           'sInfoFiltered'     => trans('doctors.sInfoFiltered'),
           'sInfoPostFix'      => trans('doctors.sInfoPostFix'),
           'sSearch'           => trans('doctors.sSearch'),
           'sUrl'              => trans('doctors.sUrl'),
           'sInfoThousands'    => trans('doctors.sInfoThousands'),
           'sLoadingRecords'   => trans('doctors.sLoadingRecords'),
           'oPaginate'         =>  [ 
                                       'sFirst'            => trans('doctors.sFirst'),
                                       'sLast'             => trans('doctors.sLast'),
                                       'sNext'             => trans('doctors.sNext'),
                                       'sPrevious'         => trans('doctors.sPrevious'),
                                   ],
           'oAria'             =>  [ 
                                       'sSortAscending'    =>trans('doctors.sSortAscending'),
                                       'sSortDescending'   =>trans('doctors.sSortDescending'),
                                   ],];
        }
    }