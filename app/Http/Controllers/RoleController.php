<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\RoleRequest;
use App\Services\Roles\RoleInterface;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $roles;

    public function __construct(RoleInterface $roles)
    {
        $this->roles = $roles;
    }

    public function index(RoleDataTable $dataTable)
    {
        $roles = Role::select('id', 'name', 'slug', 'guard_name')->get();
        // return $dataTable->render('app.roles.index', ['roles' => $roles]);
        return view('app.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $record = $this->roles->store($data);
        return redirect()->route('roles.index')->withSuccess('Data Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Role::find($id);
        return view('app.roles.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        // dd($request['slug_name'], $id);
        $record = (new Role())->find($id)->update([
            'name' => $request['role_name'],
            'slug' => $request['slug_name'],
            'guard_name' => $request['guard_name'],
        ]);

        return redirect()->route('roles.index')->withSuccess('Data Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $record = Role::find($id);
            // dd($record);
            DB::transaction(function () use ($record) {
                $record->delete();
            });
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
