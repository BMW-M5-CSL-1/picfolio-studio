<?php

namespace App\DataTables;

use App\Models\WorkExperience;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WorkExperienceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $columns = array_column($this->getColumns(), 'data');
        return (new EloquentDataTable($query))
            ->editColumn('name', function ($model) {
                return $model->company_name ?? '-';
            })
            ->editColumn('column_2', function ($model) {
                return $model->job_title ?? '-';
            })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDayDateTimeString();
            })
            ->editColumn('action', function ($model) {
                return '<a href="javascript:void(0)" onclick="deleteRecord(' . $model->id . ', \'work\')"><i class="ti ti-trash"></i></a>';
            })
            ->editColumn('description', function ($model) {
                if (strlen($model->description) > 20) {
                    $span = '<span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="tooltip-primary"
                        data-bs-title="' . $model->description . '">';
                    return $span . substr($model->description, 0, 20) . ' ...</span>';
                }
                return $model->description ?? '-';
            })
            ->addIndexColumn()
            ->addColumn('action', 'workexperience.action')
            ->rawColumns(array_merge($columns, ['created_at', 'description']))
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WorkExperience $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WorkExperience $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', $this->user_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('workexperience-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'WorkExperience_' . date('YmdHis');
    }
}
