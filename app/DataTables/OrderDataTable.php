<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\User;
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

class OrderDataTable extends DataTable
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
            ->addColumn('action', 'order.action')
            ->addIndexColumn()
            ->editColumn('order_no', function ($order) {
                return $order->order_no ?? '-';
            })
            ->editColumn('type', function ($order) {
                return '-';
            })

            ->editColumn('price', function ($order) {
                return number_format($order->price) . ' Rs./-';
            })
            ->editColumn('comments', function ($order) {
                return '<a href="#" class="detailsModal" data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $order->id . '" data-modaltype="comments">View</a>';
            })
            ->editColumn('created_at', function ($order) {
                if (isset($order->created_at)) {
                    return Carbon::parse($order->created_at)->toDayDateTimeString() ?? '-';
                } else {
                    return '-';
                }
            })
            ->editColumn('completed_at', function ($order) {
                if (isset($order->completed_at)) {
                    return Carbon::parse($order->completed_at)->toDayDateTimeString() ?? '-';
                } else {
                    return 'Not Yet Completed';
                }
            })
            ->editColumn('status', function ($order) {
                if ($order) {
                    if ($order->status == 'created') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">created</span>';
                    } elseif ($order->status == 'edited') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">edited</span>';
                    } elseif ($order->status == 'confirmed') {
                        return '<span class="badge rounded-pill bg-label-secondary text-capitalize">confirmed</span>';
                    } elseif ($order->status == 'printing') {
                        return '<span class="badge rounded-pill bg-label-info text-capitalize">printing</span>';
                    } elseif ($order->status == 'printed') {
                        return '<span class="badge rounded-pill bg-label-info text-capitalize">Printed</span>';
                    } elseif ($order->status == 'distribution') {
                        return '<span class="badge rounded-pill bg-label-primary text-capitalize">distribution</span>';
                    } elseif ($order->status == 'pasting') {
                        return '<span class="badge rounded-pill bg-label-primary text-capitalize">Pasting</span>';
                    } elseif ($order->status == 'distributed') {
                        return '<span class="badge rounded-pill bg-label-primary text-capitalize">distributed</span>';
                    } elseif ($order->status == 'completed') {
                        return '<span class="badge rounded-pill bg-label-success text-capitalize">completed</span>';
                    } elseif ($order->status == 'rejected') {
                        return '<span class="badge rounded-pill bg-label-danger text-capitalize">rejected</span>';
                    } else {
                        return '-';
                    }
                }
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
            ->editColumn('created_by', function ($order) {
                $data =
                    '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-2">
                            <img src="' . $order->users->profile_photo_url . '"
                                alt class="h-auto rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
                    . $order->users->name ?? '-' . '</span></a>
                        </div>';
                return $data;
            })
            ->editColumn('confirmed_by', function ($order) {
                if ($order->confirmed_by != null) {
                    $confirmed_by = Auth::user()->find($order->confirmed_by) ?? '-';
                    $data =
                        '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-2">
                                <img src="' . $confirmed_by->profile_photo_url . '"
                                    alt class="h-auto rounded-circle">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                        <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
                        . $confirmed_by->name ?? '-' . '</span></a>
                        </div>';
                    return $data;
                } else {
                    return '-';
                }
            })
            ->editColumn('action', function ($order) {
                return '<div class="d-flex justify-content-cetner align-items-center" onclick="action_buttons(' . $order->id . ')">
                        <div class="btn-group">
                            <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                                <div id="loader_' . $order->id . '">
                                Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                                </div>
                                <div id="dropDownMenu_' . $order->id . '">

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
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $order): QueryBuilder
    {
        $user = Auth::user()->roles->where('slug', 'super_admin');
        if (count($user) == 1) {
            return $order->newQuery()->with('media', 'paper_types', 'users')->orderBy('id', 'desc');
        } else {
            return $order->newQuery()->with('media', 'paper_types', 'users')->where('created_by', Auth::user()->id)->orderBy('id', 'desc');
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
            ->setTableId('order-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->scrollY('600px')
            ->scrollX(true)
            ->orderBy(1)
            ->languageSearchPlaceholder('Search...');
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
            Column::computed('order_no')->title('Order No#')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('type')->title('Order Type')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('paper_type')->title('Paper Type')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('paper_quality')->title('Paper Quality')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('sides')->title('Printing sides')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('total_copies')->title('Total Copies')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('distribution_type')->title('Distribution Type')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('duration')->title('Duration')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('locations')->title('Location')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('design')->title('Template')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('primary_color')->title('Primary Color')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('secondary_color')->title('Secondary Color')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('tertiary_color')->title('Tertiary Color')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('attachments')->title('Attachments')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('comments')->title('Details')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('status')->title('status')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('payment_status')->title('Payment Status')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('price')->title('Amount')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('created_by')->title('created by')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('confirmed_by')->title('confirmed by')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::computed('created_at')->title('created at')->addClass('text-nowrap')->orderable(true),
            Column::computed('completed_at')->title('completed at')->addClass('text-nowrap')->orderable(true),
            Column::computed('action')->title('Actions')->addClass('text-nowrap')->orderable(false)->searchable(false),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
