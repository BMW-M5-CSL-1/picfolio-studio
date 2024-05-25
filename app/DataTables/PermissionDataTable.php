<?php

namespace App\DataTables;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query)
    {
        $columns = array_column($this->getColumns(), 'data');

        return (new EloquentDataTable($query))
            // ->editColumn('created_at', function ($permission) {
            //     return editDateColumn($permission->created_at);
            // })
            // ->editColumn('class', function ($permission) {
            //     $explodedArray = explode('.', $permission->name);

            //     return Str::of($explodedArray[count($explodedArray) > 1 ? count($explodedArray) - 2 : 0])->title();
            // })
            // ->editColumn('default', function ($permission) {
            //     return editBooleanColumn($permission->default);
            // })
            // ->editColumn('actions', function ($permission) {
            //     return view('app.permissions.actions', ['id' => $permission->id]);
            // })
            // ->editColumn('show_name', function ($permission) {
            //     return $permission->id . ' - ' . $permission->show_name . ' - ' . $permission->name;
            //  })
            ->editColumn('roles', function ($permission) {
                return [
                    'permission_id' => $permission->id,
                    'roles' => $permission->roles->pluck('id')->toArray(),
                ];
            })
            ->setRowId('id')
            ->rawColumns(array_merge($columns, ['action', 'check']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Spatie\Permission\Models\Permission  $model
     */
    public function query(Role $model): QueryBuilder
    {
        if (Auth::user()->can('permissions.view_all')) {
            $permissions = new Permission;

            return $permissions->newQuery();
        } else {
            $CurrentUserRole = Auth::user()->roles->pluck('id');

            return $model->newQuery()->where('id', $CurrentUserRole[0])->with('permissions')->first()->permissions->toQuery();
        }
    }

    public function html(): HtmlBuilder
    {
        $buttons = [];

        return $this->builder()
            ->setTableId('permissions-table')
            ->columns($this->getColumns())
            ->addTableClass(['table-hover', 'table-striped'])
            ->rowGroupDataSrc('title')
            ->minifiedAjax()
            ->stateSave()
            ->serverSide()
            ->processing()
            // ->dom('BlfrtipC')
            ->languageSearchPlaceholder('Search...')
            ->fixedHeader()
            ->lengthMenu([25, 50, 70, 100, 500])
            ->pageLength(50)
            // ->dom('<"card-header custom_button_card pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
            ->buttons($buttons)
            ->scrollX(true)
            ->scrollCollapse(true)
            ->scrollY('500px')
            ->fixedColumns(true)
            ->fixedColumnsLeftColumns();
    }

    /**
     * Get columns.
     */
    protected function getColumns(): array
    {
        $roles = (new Role())->select('id', 'name')->orderBy('id')->get()->toArray();
        $currentAuthentiactedRoleId = Auth::user()->roles->pluck('id');
        // $roles = getLinkedTreeData(new Role(), $currentAuthentiactedRoleId);
        // $roles = array_merge(Auth::user()->roles->toArray(), $roles);
        $colArray = [
            // Column::computed('#'),
            Column::make('show_name')->title('Permission Name')->ucfirst()->addClass('text-nowrap'),
            // Column::make('guard_name')->title('Guard Name'),
            // Column::computed('class')->title('Class')->visible(false),
        ];

        foreach ($roles as $key => $role) {

            // if ($role['is_child'] == false) {
            // if (in_array($role->name, ['Director', 'Admin', 'Super Admin']) )
            //     continue;
            $checkAssignPermission = Auth::user()->hasPermissionTo('permissions.assign-permission');
            $checkRevokePermission = Auth::user()->hasPermissionTo('permissions.revoke-permission');
            // $checkEditOwnPermission = Auth::user()->hasPermissionTo('permissions.edit-own-permission');
            $assignPermssion = 0;
            $revokePermission = 0;
            $editOwnPermission = 0;
            if ($checkAssignPermission) {
                $assignPermssion = 1;
            }
            if ($checkRevokePermission) {
                $revokePermission = 1;
            }
            // if ($checkEditOwnPermission) {
            //     $editOwnPermission = 1;
            // }
            $colArray[] = Column::computed('roles')
                ->title($role['name'])
                ->searchable(false)
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->addClass('text-nowrap')
                ->render('function () {
                  var roles = data.roles;
                  var isPermissionAssigned = roles.includes(' . $role['id'] . ');
                  if(' . $currentAuthentiactedRoleId[0] . ' == ' . $role['id'] . '){
                      var checkbox = "<div class=\'form-check d-flex justify-content-center\'>";
                      if(isPermissionAssigned) {
                          if(' . $editOwnPermission . ')
                          {
                              if(' . $revokePermission . '){
                              checkbox += "<input  class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' checked />";
                              }
                              else{
                                  checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' checked />";
                              }
                          }
                          else{
                              checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' checked />";
                          }
                      } else {
                          if(' . $editOwnPermission . ')
                          {
                              if(' . $assignPermssion . '){
                                  checkbox += "<input class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' />";
                              }
                              else
                              {
                                  checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' />";
                              }
                          }
                          else{
                              checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' />";
                          }
                      }
                      checkbox += "<label class=\'form-check-label\' for=\'chkRolePermission_' . $role['id'] . '\'></label></div>";

                      return checkbox;
                  }
                  else
                  {
                      var checkbox = "<div class=\'form-check d-flex justify-content-center\'>";
                      if(isPermissionAssigned) {
                          if(' . $revokePermission . '){
                             checkbox += "<input  class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' checked />";
                          }
                          else{
                              checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' checked />";
                          }
                      } else {
                          if(' . $assignPermssion . '){
                              checkbox += "<input class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' />";
                          }
                          else
                          {
                              checkbox += "<input disabled class=\'form-check-input\' type=\'checkbox\' onchange=\'changeRolePermission(' . $role['id'] . ', " + data.permission_id + ")\'  id=\'chkRolePermission_' . $role['id'] . '_' . '" + data.permission_id + "\' />";
                          }
                      }
                      checkbox += "<label class=\'form-check-label\' for=\'chkRolePermission_' . $role['id'] . '\'></label></div>";

                      return checkbox;
                  }
               }');
            // }
        }

        // $colArray[] = Column::computed('actions')->exportable(false)->printable(false)->width(60);
        return $colArray;
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Permissions_' . date('YmdHis');
    }

    /**
     * Export PDF using DOMPDF
     *
     * @return mixed
     */
    // public function pdf()
    // {
    //     $data = $this->getDataForPrint();
    //     $pdf = Pdf::loadView($this->printPreview, ['data' => $data])->setOption(['defaultFont' => 'sans-serif']);

    //     return $pdf->download($this->filename().'.pdf');
    // }
}
