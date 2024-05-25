<?php

namespace App\DataTables;

use App\Models\StakeholderManagement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StakeholderDataTable extends DataTable
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
            ->editColumn('name', function ($user) {
                $data =
                    '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-3">
                            <img src="' . $user->profile_photo_url . '"
                                alt class="h-auto rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <a class="text-body text-truncate" href="#"><span class="text-capitalize fw-semibold">'
                    . $user->name ?? '-' . '</span></a>
                        </div>';
                return $data;
            })
            ->editColumn('father_name', function ($user) {
                return '<span class="text-capitalize">' . $user->father_name ?? '-' . '</span>';
            })

            ->editColumn('email', function ($user) {
                return $user->email ?? '-';
            })
            ->editColumn('cnic', function ($user) {
                return $user->cnic ?? '-';
            })
            ->editColumn('contact', function ($user) {
                return $user->contact ?? '-';
            })
            // ->editColumn('password', function ($user) {
            //     return Crypt::decryptString($user->password);
            // })
            ->editColumn('role', function ($user) {
                // dd($user->roles);
                foreach ($user->roles as $user_role) {
                    $allRoles[] = $user_role->name ?? '-';
                }
                return $allRoles ?? '-';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->toDayDateTimeString() ?? '-';
            })
            ->editColumn('action', function ($user) {
                return '<div class="d-flex justify-content-cetner align-items-center" onclick="action_buttons(' . $user->id . ')">
                        <div class="btn-group">
                            <button class="btn btn-flat-primary custom_dotted" type="button" id="dropdownMenuButton100"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="ti ti-dots-vertical" style="font-size: 21px;"></i></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100" id="">
                                <div id="loader_' . $user->id . '">
                                Loading...   <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                                    <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="20px" height="20px" viewBox="0 0 128 128" xml:space="preserve"><rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#000000"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(30 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(60 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#e5e5e5" transform="rotate(90 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#cecece" transform="rotate(120 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#b7b7b7" transform="rotate(150 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#9f9f9f" transform="rotate(180 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#898989" transform="rotate(210 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#727272" transform="rotate(240 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#5c5c5c" transform="rotate(270 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#444444" transform="rotate(300 64 64)"/><path d="M56.9-.1h15.17V37H56.9V-.1z" fill="#2e2e2e" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>
                                </div>
                                <div id="dropDownMenu_' . $user->id . '">

                                </div>
                            </div>
                        </div>
                    </div>';
            })
            ->rawColumns(array_merge($columns, ['action']))
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stakeholder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $user): QueryBuilder
    {
        return $user->newQuery()->with('roles')->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stakeholder-table')
            ->addTableClass(['table-hover', 'table-striped'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->languageSearchPlaceholder('Search...')
            // ->rowGroupDataSrc('role')
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
            Column::computed('name')->title('Name')->addClass('text-nowrap')->orderable(true),
            Column::computed('father_name')->title('Father name')->addClass('text-nowrap')->orderable(true),
            Column::computed('cnic')->title('CNIC')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('role')->title('Roles')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('contact')->title('Contact No. #')->addClass('text-nowrap')->orderable(true)->searchable(true),
            Column::computed('email')->title('email')->addClass('text-nowrap')->orderable(true),
            // Column::computed('password')->title('password')->addClass('text-nowrap')->orderable(true),
            Column::computed('created_at')->title('Creation Date')->addClass('text-nowrap')->orderable(true),
            Column::computed('action')->title('Actions')->addClass('text-nowrap')->orderable(false)->searchable(false),
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
