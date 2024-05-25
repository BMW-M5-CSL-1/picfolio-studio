<?php

namespace App\DataTables;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->editColumn('users', function ($users) {
                $data =
                    '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-3">
                            <img src="' . $users->profile_photo_url . '"
                                alt class="h-auto rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
                    . $users->name ?? '-' . '</span></a>
                        </div>';
                return $data;
            })
            ->editColumn('role', function ($users) {
                foreach ($users->roles as $row) {
                    // if ($row->slug == 'super_admin') {
                    //     $data = '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary me-2 w-px-30 h-px-30"><i class="ti ti-device-laptop ti-sm"></i></span>' . $row->name . '</span>';
                    //     return $data;
                    // } elseif ($row->slug == 'user') {
                    //     $data = '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary me-2 w-px-30 h-px-30"><i class="ti ti-user ti-sm"></i></span>' . $row->name . '</span>';
                    //     return $data;
                    // } elseif ($row->slug == 'print_media') {
                    //     $data = '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary me-2 w-px-30 h-px-30"><i class="ti ti-printer ti-sm"></i></span>' . $row->name . '</span>';
                    //     return $data;
                    // } elseif ($row->slug == 'vehicle_media') {
                    //     $data = '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary me-2 w-px-30 h-px-30"><i class="ti ti-car ti-sm"></i></span>' . $row->name . '</span>';
                    //     return $data;
                    // } elseif ($row->slug == 'distributor') {
                    //     $data = '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary me-2 w-px-30 h-px-30"><i class="ti ti-map ti-sm"></i></span>' . $row->name . '</span>';
                    //     return $data;
                    // }
                    $data = $row->name ?? '-';
                    return '<span class="text-capitalize fw-semibold">' . $data . '</span>';
                }
            })


            // ->editColumn('email', function ($user) {
            //     return $user->email ?? '-';
            // })
            // ->editColumn('password', function ($user) {
            //     return Crypt::decryptString($user->password);
            // })
            // ->editColumn('role', function ($user) {
            //     return $user->roles[0]->name ?? '-';
            // })
            // ->editColumn('created_at', function ($user) {
            //     return Carbon::parse($user->created_at)->toDayDateTimeString() ?? '-';
            // })

            ->rawColumns(array_merge($columns, ['action']))
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stakeholder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $users): QueryBuilder
    {
        // dd($users->newQuery()->with('roles')->orderBy('id', 'asc')->get());
        // return $users->newQuery()->with('users')->orderBy('id', 'asc');
        return $users->newQuery()->with('roles')->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('role-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            // ->rowGroupDataSrc('role')
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->languageSearchPlaceholder('Search...')
            ->orderBy(1)
            ->scrollX(true);
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
            Column::computed('DT_RowIndex')->title('Sr. #')->addClass('text-nowrap')->orderable(false),
            Column::computed('users')->title('users')->addClass('text-nowrap')->orderable(true),
            Column::computed('role')->title('Role')->addClass('text-nowrap')->orderable(false),
            // Column::computed('role')->title('Role')->addClass('text-nowrap')->orderable(true)->searchable(true),
            // Column::computed('email')->title('email')->addClass('text-nowrap')->orderable(true),
            // Column::computed('password')->title('password')->addClass('text-nowrap')->orderable(true),
            // Column::computed('sides')->title('Printing sides')->addClass('text-nowrap')->orderable(true)->searchable(true),
            // Column::computed('created_at')->title('Creation Date')->addClass('text-nowrap')->orderable(true),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Stakeholder_' . date('YmdHis');
    }
}
