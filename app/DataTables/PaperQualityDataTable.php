<?php

namespace App\DataTables;

use App\Models\PaperQuality;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaperQualityDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'paperquality.action')
            ->setRowId('id')
            ->addIndexColumn()
            ->editColumn('name', function ($paper_quality) {
                return [
                    $paper_quality->name
                ];
            })
            ->editColumn('action', function ($paper_quality) {
                return '
                <div class="d-flex justify-content-cetner align-items-center" onclick="action_buttons(' . $paper_quality->id . ')">
                    <div class="btn-group">
                        <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                            <div id="loader_' . $paper_quality->id . '">
                            Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                            </div>
                            <div id="dropDownMenu_' . $paper_quality->id . '">

                            </div>
                        </div>
                    </div>
                </div>
            ';
            })
            ->editColumn('slug', function ($paper_quality) {
                return [
                    $paper_quality->slug
                ];
            });

        // ->editColumn('created_at', function ($paper_quality) {
        //   return [
        //     $paper_quality->created_at
        //   ];
        // })
        // ->editColumn('updated_at', function ($paper_quality) {
        //   return [
        //     $paper_quality->updated_at
        //   ];
        // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PaperQuality $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PaperQuality $paper_quality): QueryBuilder
    {
        return $paper_quality->newQuery()->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('paperquality-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->languageSearchPlaceholder('Search ...')
            //->dom('Bfrtip')
            ->orderBy(1);
            // ->selectStyleSingle();
        // ->buttons([
        //     Button::make('excel'),
        //     Button::make('csv'),
        //     Button::make('pdf'),
        //     Button::make('print'),
        //     Button::make('reset'),
        //     Button::make('reload')
        // ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::computed('DT_RowIndex')->title('Sr. #')->addClass('text-nowrap')->orderable(false),
            Column::make('name')->title('Name')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::make('slug')->title('Slug')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::make('action')->title('Action')->addClass('text-nowrap')->orderable(false)->searchable(false),

            // Column::make('created_at')->title('Created At')->addClass('text-nowrap')->orderable(false),
            // Column::make('updated_at')->title('Updated At')->addClass('text-nowrap')->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PaperQuality_' . date('YmdHis');
    }
}
