<?php

namespace App\DataTables;

use App\Models\VehicleMedia;
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

class VehicleMediaDataTable extends DataTable
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
            ->addColumn('action', 'vehicle-media.action')
            ->addIndexColumn()
            ->editColumn('vehicle_media_no', function ($vehicle_media) {
                // dd($vehicle_media);
                return $vehicle_media->vehicle_media_no ?? '-';
            })
            ->editColumn('order_id', function ($vehicle_media) {
                return $vehicle_media->orders->order_no ?? '-';
            })
            ->editColumn('duration', function ($vehicle_media) {
                return $vehicle_media->orders->duration;
            })
            ->editColumn('status', function ($vehicle_media) {
                $vehicle_media_users = Auth::user()->roles->where('slug', 'vehicle_media');
                if (count($vehicle_media_users) > 0) {
                    foreach ($vehicle_media->vehicleUsers as $vehicle_media_user) {
                        $records = $vehicle_media_user->pivot->where('user_id', Auth::user()->id)->where('vehicle_media_id', $vehicle_media->id)->get();
                        foreach ($records as $record) {
                            if ($record->status == 'new') {
                                return '<span class="badge rounded-pill bg-label-warning text-capitalize">New</span>';
                            } elseif ($record->status == 'confirmed') {
                                return '<span class="badge rounded-pill bg-label-info text-capitalize">Confirmed</span>';
                            } elseif ($record->status == 'completed') {
                                return '<span class="badge rounded-pill bg-label-success text-capitalize">completed</span>';
                            } elseif ($record->status == 'rejected') {
                                return '<span class="badge rounded-pill bg-label-danger text-capitalize">rejected</span>';
                            } else {
                                return '-';
                            }
                        }
                    }
                } else {
                    $isCompleted = true;
                    if ($vehicle_media->status == 'new') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">New</span>';
                    } elseif ($vehicle_media->status == 'confirmed') {
                        return '<span class="badge rounded-pill bg-label-info text-capitalize">confirmed</span>';
                    } elseif ($vehicle_media->status == 'completed') {
                        return '<span class="badge rounded-pill bg-label-success text-capitalize">completed</span>';
                    } else {
                        return '-';
                    }
                }
            })
            ->editColumn('created_at', function ($vehicle_media) {
                return Carbon::parse($vehicle_media->created_at)->toDayDateTimeString() ?? '-';
            })
            ->editColumn('confirmed_at', function ($vehicle_media) {
                if ($vehicle_media->confirmed_at != null) {
                    return Carbon::parse($vehicle_media->confirmed_at)->toDayDateTimeString() ?? '-';
                } else {
                    return '-';
                }
            })
            ->editColumn('completed_at', function ($vehicle_media) {
                if ($vehicle_media->completed_at != null) {
                    return Carbon::parse($vehicle_media->completed_at)->toDayDateTimeString() ?? '-';
                } else {
                    return '-';
                }
            })
            ->editColumn('amount_to_be_paid', function ($distribution) {
                return number_format($distribution->amount_to_be_paid) . ' Rs./-';
            })
            ->editColumn('payment_status', function ($distribution) {
                if (!is_null($distribution->payment_status)) {
                    if ($distribution->payment_status == 'partial_paid') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">partial paid</span>';
                    } elseif ($distribution->payment_status == 'paid') {
                        return '<span class="badge rounded-pill bg-label-success text-capitalize">paid</span>';
                    } elseif ($distribution->payment_status == 'un_paid') {
                        return '<span class="badge rounded-pill bg-label-danger text-capitalize">un paid</span>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->editColumn('assigned_to', function ($vehicle_media) {
                return '<a href="#" class="detailsModal" data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $vehicle_media->id . '" data-modaltype="vehicleDetails">View</a>';
            })
            ->editColumn('details', function ($vehicle_media) {
                return '<a href="#" class="detailsModal" data-bs-toggle="modal"  data-bs-target="#detailsModal" data-id="' . $vehicle_media->id . '" data-modaltype="details">View</a>';
            })
            ->editColumn('action', function ($vehicle_media) {
                return '<div class="d-flex justify-content-cetner align-items-center" onclick="action_buttons(' . $vehicle_media->id . ')">
                        <div class="btn-group">
                            <button class="btn  custom_dotted" type="button" id="dropdownMenuButton100"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                                <div id="loader_' . $vehicle_media->id . '">
                                Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                                </div>
                                <div id="dropDownMenu_' . $vehicle_media->id . '">

                                </div>
                            </div>
                        </div>
                    </div>';
            })
            ->rawColumns(array_merge($columns, ['action', 'assigned_to']))
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VehicleMedia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VehicleMedia $vehicle_media): QueryBuilder
    {
        // return $vehicle_media->newQuery()->with('orders')->orderBy('id', 'asc');
        $user = Auth::user()->roles->where('slug', 'super_admin');
        if (count($user) == 1) {
            return $vehicle_media->newQuery()->with('orders', 'vehicleUsers')->orderBy('id', 'desc');
        } else {
            return $vehicle_media->newQuery()->with('orders', 'vehicleUsers')->whereHas('vehicleUsers', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->orderBy('id', 'desc');
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
            ->setTableId('vehicle-media-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->languageSearchPlaceholder('Search...')
            ->scrollX()
            ->scrollY('300px');
        // ->selectStyleSingle()
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
            Column::computed('vehicle_media_no')->title('Vehicle Media No#')->addClass('text-nowrap')->orderable(true),
            Column::computed('order_id')->title('Order No#')->addClass('text-nowrap')->orderable(false),
            Column::computed('duration')->title('Duration')->addClass('text-nowrap')->orderable(true)->searchable(false),
            Column::computed('details')->title('details')->addClass('text-nowrap')->orderable(false),
            Column::computed('status')->title('status')->addClass('text-nowrap')->orderable(true)->searchable(true),
        ];

        if (count($user) > 0) {
            $columns[] = Column::computed('assigned_to')->title('assigned to')->addClass('text-nowrap')->orderable(false)->searchable(false);
            $columns[] = Column::computed('amount_to_be_paid')->title('Amount To Pay')->addClass('text-nowrap')->orderable(true)->searchable(true);
            // array_unshift($columns, $newColumn);
        }

        $columns[] = Column::computed('payment_status')->title('Payment Status')->addClass('text-nowrap')->orderable(false)->searchable(false);
        $columns[] = Column::computed('created_at')->title('created at')->addClass('text-nowrap')->orderable(false)->searchable(false);
        $columns[] = Column::computed('confirmed_at')->title('confirmed at')->addClass('text-nowrap')->orderable(false)->searchable(false);
        $columns[] = Column::computed('completed_at')->title('completed at')->addClass('text-nowrap')->orderable(false)->searchable(false);
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
        return 'VehicleMedia_' . date('YmdHis');
    }
}
