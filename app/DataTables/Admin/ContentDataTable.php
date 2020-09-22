<?php

namespace App\DataTables\Admin;

use App\Models\Content;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ContentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'admin.contents.datatables_actions')
        ->editColumn('headline', '{{ ($headline == 1) ? "Yes" : "No" }}')
        ->editColumn('published_at', '{{ date(\'d-M-Y\', strtotime($published_at)) }}')
        ->editColumn('picture', function ($content) 
        {  return '<img src='.$content->picture.' height="80px"/>'; })
            ->rawColumns(['picture','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Content $model)
    {
        return $model->newQuery()
        ->with('category')
        ->with('status');
    }

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
            ->addAction(['width' => '90px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'stateSave' => true, 
                'order'   => [[0, 'desc']],
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
                // 'initComplete' => "function() {
                //     this.api().columns().every(function() {
                //         var column = this;
                //         var input = document.createElement(\"input\");
                //         $(input).appendTo($(column.footer()).empty())
                //         .on('change', function () {
                //             column.search($(this).val(), false, false, true).draw();
                //         });
                //     });
                // }",
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
            'id' => [ 'visible' => false ],
            'category' => ['name' => 'category.title', 'data' => 'category.title', 'defaultContent'=> '', 'searchable'=>false],        
            'title',
            'picture',
            'published_at',
            'headline',
            'status' => ['name' => 'status.title', 'data' => 'status.title', 'defaultContent'=> '', 'searchable'=>false]        
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'contentsdatatable_' . time();
    }
}
