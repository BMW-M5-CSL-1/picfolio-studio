<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\DistributionUser;
use App\Models\Order;
use App\Models\PrintingPress;
use App\Models\VehicleMedia;
use App\Models\VehicleMediaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $admin = $user->roles->where('slug', 'admin')->count() == 1;
        $photographer = $user->roles->where('slug', 'photographer')->count() == 1;
        $user_role = $user->roles->where('slug', 'user')->count() == 1;

        $orders = Order::query();

        if ($admin) {
            $totalOrders = $orders->clone()->count();
            $pendingOrders = $orders->clone()->where('status', 'pending')->count();
            $completedOrders = $orders->clone()->where('status', 'paid')->count();
            $revenue = $orders->clone()->where('status', 'paid')->sum('total_price');

            $paidOrder = Order::where('status', 'paid')->count() ?? 0;
            $unPaidOrder = Order::where('status', 'partial_paid')->count() ?? 0;
            $cancelledOrder = Order::where('status', 'cancelled')->count() ?? 0;
        }

        $data = [
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'revenue' => $revenue,
            'paidOrder' => $paidOrder,
            'unPaidOrder' => $unPaidOrder,
            'cancelledOrder' => $cancelledOrder
        ];
        // dd($data['orders_graph']);
        return view('app.dashboard.dashboards', $data);
    }

    public function adminData($user) {}

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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
