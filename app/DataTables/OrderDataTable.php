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
            ->editColumn('total_price', function ($order) {
                return number_format($order->total_price) . ' Rs./-';
            })
            ->editColumn('user_id', function ($order) {
                if (isset($order->user_id)) {
                    return Carbon::parse($order->user_id)->toDayDateTimeString() ?? '-';
                } else {
                    return '-';
                }
            })
            ->editColumn('status', function ($order) {
                if (!is_null($order->status)) {
                    if ($order->status == 'pending') {
                        return '<span class="badge rounded-pill bg-label-warning text-capitalize">pending</span>';
                    } elseif ($order->status == 'paid') {
                        return '<span class="badge rounded-pill bg-label-success text-capitalize">paid</span>';
                    } elseif ($order->status == 'cancelled') {
                        return '<span class="badge rounded-pill bg-label-danger text-capitalize">Cancelled</span>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->editColumn('product_name', function ($order) {
                return $order->product->name ?? '-';
            })
            // ->editColumn('created_by', function ($order) {
            //     $data =
            //         '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
            //             <div class="avatar avatar-sm me-2">
            //                 <img src="' . $order->users->profile_photo_url . '"
            //                     alt class="h-auto rounded-circle">
            //             </div>
            //         </div>
            //         <div class="d-flex flex-column">
            //             <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
            //         . $order->users->name ?? '-' . '</span></a>
            //             </div>';
            //     return $data;
            // })
            // ->editColumn('confirmed_by', function ($order) {
            //     if ($order->confirmed_by != null) {
            //         $confirmed_by = Auth::user()->find($order->confirmed_by) ?? '-';
            //         $data =
            //             '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
            //                 <div class="avatar avatar-sm me-2">
            //                     <img src="' . $confirmed_by->profile_photo_url . '"
            //                         alt class="h-auto rounded-circle">
            //                 </div>
            //             </div>
            //             <div class="d-flex flex-column">
            //             <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
            //             . $confirmed_by->name ?? '-' . '</span></a>
            //             </div>';
            //         return $data;
            //     } else {
            //         return '-';
            //     }
            // })
            ->editColumn('action', function ($order) {
                return $order->status != 'cancelled' ? '<div class="d-flex justify-content-cetner align-items-center">
                    <div class="btn-group">
                        <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                            <div id="dropDownMenu_">' . view('app.orders.actions', ['model' => $order,]) . '
                            </div>
                        </div>
                    </div>
                </div>' : '-';
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
            return $order->newQuery()->with('user')->orderBy('id', 'desc');
        } else {
            return $order->newQuery()->with('user')->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
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
            Column::computed('product_name')->title('Product')->addClass('text-nowrap')->orderable(false)->searchable(false),
            Column::make('status')->title('status')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::make('price')->title('Amount')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::make('quantity')->title('quantity')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::make('total_price')->title('Total Amount')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('user_id')->title('created at')->addClass('text-nowrap')->orderable(true),
            // Column::computed('completed_at')->title('completed at')->addClass('text-nowrap')->orderable(true),
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
