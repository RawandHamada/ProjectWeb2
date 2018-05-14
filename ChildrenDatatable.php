<?php

namespace App\DataTables;

use App\Children;
use Yajra\DataTables\Services\DataTable;

class ChildrenDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', 'doctors.children_table.btn.checkbox')
            ->addColumn('edit', 'doctors.children_table.btn.edit')
            ->addColumn('delete', 'doctors.children_table.btn.delete')
            ->rawColumns([
                'edit','delete','checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
      //  return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
          return Children::query();
    }

   /*  public static function lang()
    {
        $langJson = [
            'sProcessing'       => trans('doctors.sProcessing'),
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
            'oPaginate'         => [ 
                                        trans('doctors.sFirst'),
                                        trans('doctors.sLast'),
                                        trans('doctors.sNext'),
                                        trans('doctors.sPrevious'),
                                    ],
            'oAria'             => [ 
                                        trans('doctors.sSortAscending'),
                                        trans('doctors.sSortDescending'),
                                    ],
        ];
       // return (object)$langJson;
       // return json_encode($langJson);
       //return response($langJson);
       return $langJson;
    }  */
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'       =>'Blfrtip',
                        'lengthMenu'=>[[10,25,50,100],[10,25,50,trans('doctors.allrec')]],
                        'buttons'=>[
                            ['text'=>'<i class="fa fa-plus"></i> ' .trans('doctors.create_children'),
                            'className'=>'btn btn-info',"action"=>"function(){
                                window.location.href = '".\URL::current()."/create'
                            }"],
                            
                            ['extend'=>'print','className'=>'btn btn-primary','text'=>'<i class="fa fa-print"></i>'],
                            ['extend'=>'csv','className'=>'btn btn-info','text'=>'<i class="fa fa-file"> '.trans('doctors.exp_csv').'</i>'],
                            ['extend'=>'excel','className'=>'btn btn-success','text'=>'<i class="fa fa-file"> '.trans('doctors.exp_excel').'</i>'],
                            ['extend'=>'reload','className'=>'btn btn-default','text'=>'<i class="fa fa-refresh"></i>'],
                            ['text'=>'<i class="fa fa-trash"></i> ' .trans('doctors.delete_all'),
                            'className'=>'btn btn-danger delBtn'],

                        ],
                        'initComplete'=> "function () {
                            this.api().columns([1,2,3,4,5]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language'  => datatable_Lang(),
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
                    [
                        'name'=>'checkbox',
                        'data'=>'checkbox',
                        'title'=>'<input type="checkbox" class="check_all" onclick="check_all()" />',
                        'exportable'=> false,
                        'printable' => false,
                        'orderable' => false,
                        'searchable'=> false,
                    ],
                    [
                        'name'=>'id',
                        'data'=>'id',
                        'title'=>trans('doctors.id'),

                    ],
                    [
                        'name'=>'child_id',
                        'data'=>'child_id',
                        'title'=>trans('doctors.child_id'),

                    ],
                    [
                        'name'      =>'name',
                        'data'      =>'name',
                        'title'     =>trans('doctors.name_child'),
                    ],
                    [
                        'name'      =>'gender',
                        'data'      =>'gender',
                        'title'     =>trans('doctors.gender_child'),
                    ],
                    [
                        'name'      =>'gender',
                        'data'      =>'gender',
                        'title'     =>trans('doctors.gender_child'),
                    ],
                  /*   [
                        'name'      =>'birth_of_date',
                        'data'      =>'birth_of_date',
                        'title'     =>trans('doctors.birth_of_date_child'),
                    ],
                    [
                        'name'      =>'age',
                        'data'      =>'age',
                        'title'     =>trans('doctors.age_child'),
                    ],
                    [
                        'name'      =>'created_at',
                        'data'      =>'created_at',
                        'title'     =>trans('doctors.created_at'),
                    ],
                    [
                        'name'      =>'updated_at',
                        'data'      =>'updated_at',
                        'title'     =>trans('doctors.updated_at'),
                    ], */
                    [
                        'name'      =>'edit',
                        'data'      =>'edit',
                        'title'     =>trans('doctors.edit'),
                        'exportable'=> false,
                        'printable' => false,
                        'orderable' => false,
                        'searchable'=> false,
                    ],
                    [
                        'name'      =>'delete',
                        'data'      =>'delete',
                        'title'     =>trans('doctors.delete'),
                        'exportable'=> false,
                        'printable' => false,
                        'orderable' => false,
                        'searchable'=> false,
                    ],
                   
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Doctors_' . date('YmdHis');
    }
}
