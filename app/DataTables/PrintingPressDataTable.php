<?php

namespace App\DataTables;

use App\Models\PrintingPress;
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

class PrintingPressDataTable extends DataTable
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
            ->addColumn('action', 'printingpress.action')
            ->addIndexColumn()
            ->editColumn('press_no', function ($print) {
                return $print->press_no ?? '-';
            })
            ->editColumn('order_id', function ($print) {
                return $print->orders->order_no ?? '-';
            })
            ->editColumn('order_type', function ($print) {
                if ($print->orders->type == 'paper_media') {
                    return '<span class="text-capitalize">paper media</span>';
                } elseif ($print->orders->type == 'vehicle_media') {
                    return '<span class="text-capitalize">vehicle media</span>';
                } else {
                    return '-';
                }
            })
            ->editColumn('paper_type', function ($print) {
                return $print->orders->paper_types->name;
            })
            ->editColumn('paper_quality', function ($print) {
                return $print->orders->paper_types->paper_qualities->name;
            })
            ->editColumn('sides', function ($print) {
                return '<span class="text-capitalize">' . $print->orders->paper_types->side . '</span>';
            })
            ->editColumn('copies', function ($print) {
                return number_format($print->orders->total_copies);
            })
            ->editColumn('design', function ($print) {
                return '<a href="#" class="detailsModal" data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $print->orders->id . '" data-modaltype="template">View</a>';
            })
            ->editColumn('primary_color', function ($print) {
                return '<span style"background-color: ' . $print->orders->primary_color . '"> ' . $print->orders->primary_color . '</span>';
            })
            ->editColumn('secondary_color', function ($print) {
                return '<span style"background-color: ' . $print->orders->secondary_color . ' !important;"> ' . $print->orders->secondary_color . '</span>';
            })
            ->editColumn('tertiary_color', function ($print) {
                return '<span style"borders:2px solid ' . $print->orders->tertiary_color . ';"> ' . $print->orders->tertiary_color . '</span>';
            })
            ->editColumn('comments', function ($print) {
                return '<a href="#" class="detailsModal" data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $print->id . '" data-modaltype="comments">View</a>';
            })
            ->editColumn('attachments', function ($print) {
                return '<a href="#" class="detailsModal"  data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $print->orders->id . '" data-modaltype="attachments">View</a>';
            })
            ->editColumn('status', function ($print) {
                if ($print->status == 'new') {
                    return '<span class="badge rounded-pill bg-label-warning text-capitalize">New</span>';
                } elseif ($print->status == 'printing') {
                    return '<span class="badge rounded-pill bg-label-info text-capitalize">printing</span>';
                } elseif ($print->status == 'completed') {
                    return '<span class="badge rounded-pill bg-label-success text-capitalize">completed</span>';
                } elseif ($print->status == 'not-assigned') {
                    return '<span class="badge rounded-pill bg-label-danger text-capitalize">not assigned</span>';
                } else {
                    return '-';
                }
            })
            ->editColumn('assigned_to', function ($print) {
                return '<a href="#" class="detailsModal"  data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $print->id . '" data-modaltype="assigned_to">View</a>';
            })
            ->editColumn('created_at', function ($print) {
                return Carbon::parse($print->created_at)->toDayDateTimeString() ?? '-';
            })
            ->editColumn('completed_at', function ($print) {
                if ($print->completed_at) {
                    return Carbon::parse($print->completed_at)->toDayDateTimeString();
                } else {
                    return '-';
                }
            })
            ->editColumn('price', function ($print) {
                return number_format($print->price) ?? '-';
            })
            ->editColumn('payment_status', function ($order) {
                if (!is_null($order->payment_status)) {
                    if ($order->payment_status == 'partial_paid') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">partial paid</span>';
                    } elseif ($order->payment_status == 'paid') {
                        return '<span class="badge rounded-pill bg-label-success text-capitalize">paid</span>';
                    } elseif ($order->payment_status == 'un_paid') {
                        return '<span class="badge rounded-pill bg-label-danger text-capitalize">un paid</span>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->editColumn('action', function ($print) {
                return '<div class="d-flex justify-content-cetner align-items-center" onclick="action_buttons(' . $print->id . ')">
                        <div class="btn-group">
                            <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                                <div id="loader_' . $print->id . '">
                                Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                                </div>
                                <div id="dropDownMenu_' . $print->id . '">

                                </div>
                            </div>
                        </div>
                    </div>';
            })
            ->rawColumns(array_merge($columns, ['action', 'locations', 'primary_color', 'secondary_color']))

            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PrintingPress $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PrintingPress $print): QueryBuilder
    {
        $user = Auth::user()->roles->where('slug', 'super_admin');
        if (count($user) == 1) {
            return $print->newQuery()->with('orders')->orderBy('id', 'desc');
        } else {
            return $print->newQuery()->with('orders', 'users')->where('printer_id', Auth::user()->id)->orderBy('id', 'desc');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('printingpress-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->languageSearchPlaceholder('Search...')
            ->scrollX()
            ->scrollY('300px');
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
        $user = Auth::user()->roles->where('slug', 'super_admin');
        $columns = [
            Column::computed('DT_RowIndex')->title('Sr. #')->addClass('text-nowrap')->orderable(false),
            Column::computed('press_no')->title('Print No#')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('order_id')->title('Order No#')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('order_type')->title('Order Type')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('paper_type')->title('Paper Type')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('paper_quality')->title('Paper Quality')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('sides')->title('Printing sides')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('copies')->title('Total Copies')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('design')->title('Template')->addClass('text-nowrap')->searchable(false),
            Column::computed('primary_color')->title('Primary Color')->addClass('text-nowrap')->searchable(false),
            Column::computed('secondary_color')->title('Secondary Color')->addClass('text-nowrap')->searchable(false),
            Column::computed('tertiary_color')->title('Tertiary Color')->addClass('text-nowrap')->searchable(false),
            Column::computed('attachments')->title('Attachments')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('comments')->title('Details')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('price')->title('Price')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('status')->title('status')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('payment_status')->title('Payment Status')->addClass('text-nowrap')->orderable(true)->searchable(true),

        ];

        if (count($user) > 0) {
            $columns[] = Column::computed('assigned_to')->title('assigned to')->addClass('text-nowrap')->orderable(false)->searchable(false);
            // array_unshift($columns, $newColumn);
        }

        $columns[] = Column::computed('created_at')->title('created at')->addClass('text-nowrap')->orderable(true);
        $columns[] = Column::computed('completed_at')->title('completed at')->addClass('text-nowrap')->orderable(true);
        $columns[] = Column::computed('action')->title('Actions')->addClass('text-nowrap')->orderable(false)->searchable(false);

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PrintingPress_' . date('YmdHis');
    }
}
