<?php

namespace App\DataTables;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EventDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('action', function ($model) {
                return '-';
            })
            ->rawColumns(array_merge($columns, ['action']))
            ->addColumn('action', 'event.action')
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Event $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Event $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $buttons = [];
        if (Auth::user()->can('event.create')) {
            $buttons[] = [
                Button::make()->text('<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Create</span>')->addClass('add-new btn btn-sm btn-primary ms-3')
                    ->attr([
                        'onClick' => 'create()',
                    ]),
            ];
        }
        return $this->builder()
            // ->setTableId('event-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom(
                '<"row me-2"' .
                    '<"col-md-2"<"me-3"l>>' .
                    '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' .
                    '>t' .
                    '<"row mx-2"' .
                    '<"col-sm-12 col-md-6"i>' .
                    '<"col-sm-12 col-md-6"p>' .
                    '>'
            )
            ->processing(false)
            ->serverSide(true)
            ->scrollX()
            // ->fixedColumns()
            // ->fixedColumnsLeftColumns(2)
            ->searchDelay(900)
            ->lengthMenu([30, 50, 100])
            ->select([
                'style' => 'multi',
            ])
            ->pageLength(50)
            ->language([
                'sLengthMenu' => '_MENU_',
                'search' => '',
                'searchPlaceholder' => 'Search..',
                'processing' => '<img width="50" src="assets/img/loader.gif"/>',
            ])->select([
                'style' => 'multi',
            ])
            ->buttons($buttons);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('Sr. #')->addClass('text-nowrap')->orderable(false),
            Column::make('doc_no')->addClass('text-nowrap'),
            Column::make('type')->addClass('text-nowrap'),
            Column::make('description')->addClass('text-nowrap'),
            Column::make('start_date')->addClass('text-nowrap'),
            Column::make('end_date')->addClass('text-nowrap'),
            Column::make('location')->addClass('text-nowrap'),
            Column::make('required_photographers')->addClass('text-nowrap'),
            Column::make('arieal_view')->addClass('text-nowrap'),
            Column::make('status')->addClass('text-nowrap'),
            Column::make('user_id')->searchable(false)->orderable(false)->addClass('text-nowrap'),
            Column::make('created_at')->addClass('text-nowrap'),
            Column::make('updated_at')->addClass('text-nowrap'),
            Column::computed('action')->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Event_' . date('YmdHis');
    }
}
