<?php

namespace App\Http\Controllers;

use App\DataTables\StakeholderDataTable;
use App\Http\Requests\Stakeholder\store;
use App\Http\Requests\Stakeholder\update;
use App\Models\Role;
use App\Models\Route;
use App\Models\StakeholderManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StakeholderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StakeholderDataTable $dataTable)
    {
        try {
            $data = [
                'roles' => Role::select('id', 'name', 'slug')->get(),
                'users' => User::all(),
            ];
            return $dataTable->render('app.stakeholders.index', $data);
            // view('app.stakeholders.index', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->withDanger($ex->getMessage());
        }
    }

    public function action_buttons($id)
    {
        try {
            $data = [
                'user' => User::where('id', $id)->first(),
                'edit_permission' => Auth::user()->can('stakeholders.update'),
                'delete_permission' => Auth::user()->can('stakeholders.destroy'),
            ];
            return view('app.stakeholders.actions', $data);
        } catch (\Exception $ex) {
            return redirect()->back()->withDanger($ex->getMessage());
        }
    }

    public function get_user_data($id)
    {
        try {
            if (!is_null($id)) {
                $user = User::find($id);
                $roles = [];
                foreach ($user->roles as $role) {
                    $roles[] = $role;
                }
                // dd($roles);
                return response()->json([
                    'success' => true,
                    'user' => $user,
                    'roles' => $roles,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                ], 200);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->withDanger($ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(store $request)
    {
        // dd($request->all());
        try {
            $data = [
                'name' => $request->fullName,
                'father_name' => $request->fatherName,
                'cnic' => $request->cnic,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'email' => $request->email,
                'contact' => $request->contact,
                'country' => $request->country,
                'state' => $request->state,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ];
            $roles[] = $request->role;
            $routes[] = $request->route ?? null;
            DB::transaction(function () use ($data, $roles, $routes) {
                $record = User::create($data);
                foreach ($roles as $role) {
                    $record->assignRole($role);
                }
                // if (!is_null($routes)) {
                //     foreach ($routes as $route) {
                //         $record->routes()->attach($route);
                //     }
                // }
            });
            return redirect()->route('stakeholders.index')->withSuccess('Data Saved');
        } catch (\Exception $ex) {
            return redirect()->back()->withDanger($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StakeholderManagement  $stakeholderManagement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $stakeholderManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StakeholderManagement  $stakeholderManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(StakeholderManagement $stakeholderManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StakeholderManagement  $stakeholderManagement
     * @return \Illuminate\Http\Response
     */
    public function update(update $request, $id)
    {
        try {
            if (!is_null($id)) {
                $new_roles = $request->role;
                $new_routes = $request->route;
                $data = [
                    'name' => $request->fullName,
                    'father_name' => $request->fatherName,
                    'cnic' => $request->cnic,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'country' => $request->country,
                    'state' => $request->state,
                    'address' => $request->address,
                    'password' => Hash::make($request->password),
                ];
                $record = User::find($id);
                DB::transaction(function () use ($record, $new_roles, $new_routes, $data) {
                    // Remove Existing Roles
                    foreach ($record->roles as $role) {
                        $record->removeRole($role);
                    }
                    // Remove Existing Routes
                    if (!is_null($new_routes)) {
                        foreach ($record->routes as $route) {
                            $record->routes()->detach($route);
                        }
                    }
                    // New Roles
                    foreach ($new_roles as $role) {
                        $record->assignRole($role);
                    }
                    // New Routes
                    if (!is_null($new_routes)) {
                        foreach ($new_routes as $route) {
                            $record->routes()->attach($route);
                        }
                    }
                    $record->update($data);
                });
                return redirect()->route('stakeholders.index')->withSuccess('Data Saved');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->withDanger($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StakeholderManagement  $stakeholderManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(StakeholderManagement $stakeholderManagement)
    {
        //
    }
}
