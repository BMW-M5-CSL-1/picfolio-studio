<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\DistributionUser;
use App\Models\Event;
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
        $userRole = $user->roles->where('slug', 'user')->count() == 1;

        $orders = Order::query();
        $events = Event::query()->with('eventPhotographers');

        if ($admin) {
            $totalOrders = $orders->clone()->count();
            $pendingOrders = $orders->clone()->where('status', 'pending')->count();
            $completedOrders = $orders->clone()->where('status', 'paid')->count();
            $revenue = $orders->clone()->where('status', 'paid')->sum('total_price');

            $cancelledOrder = Order::where('status', 'cancelled')->count() ?? 0;

            $totalEvents = $events->clone()->count();
            $completedEvents = $events->clone()->where('status', 'closed')->count();
            $pendingEvents = $events->clone()->whereNotIn('status', ['closed', 'cancelled'])->count();
            $cancelledEvents = $events->clone()->where('status', 'cancelled')->count();

            // $closedEvents = $events->clone()->where
        } elseif ($photographer) {
            $totalOrders = $orders->clone()->where('user_id', Auth::id())->count();
            $pendingOrders = $orders->clone()->where('user_id', Auth::id())->where('status', 'pending')->count();
            $completedOrders = $orders->clone()->where('user_id', Auth::id())->where('status', 'paid')->count();
            $revenue = $orders->clone()->where('user_id', Auth::id())->where('status', 'paid')->sum('total_price');

            $cancelledOrder = Order::where('user_id', Auth::id())->where('status', 'cancelled')->count() ?? 0;

            $totalEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'partial_paid')->count();
            $completedEvents = $events->clone()->where('status', 'closed')->where('user_id', Auth::id())->where('status', 'partial_paid')->count();
            $pendingEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'partial_paid')->whereNotIn('status', ['closed', 'cancelled'])->count();
            $cancelledEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'cancelled')->count();

            $assignedEvents = $events->clone()->whereHas('eventPhotographers', function ($query) {
                $query->where('photographer_id', Auth::id());
            });

            $totalEvents = $assignedEvents->clone()->count();
            $completedEvents = $assignedEvents->clone()->where('status', 'closed')->count();
            $pendingEvents = $assignedEvents->clone()->whereNotIn('status', ['closed', 'cancelled'])->count();
            $cancelledEvents = $assignedEvents->clone()->where('status', 'cancelled')->count();
        } elseif ($userRole) {
            $totalOrders = $orders->clone()->where('user_id', Auth::id())->count();
            $pendingOrders = $orders->clone()->where('user_id', Auth::id())->where('status', 'pending')->count();
            $completedOrders = $orders->clone()->where('user_id', Auth::id())->where('status', 'paid')->count();
            $revenue = $orders->clone()->where('user_id', Auth::id())->where('status', 'paid')->sum('total_price');

            $cancelledOrder = Order::where('user_id', Auth::id())->where('status', 'cancelled')->count() ?? 0;

            $totalEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'partial_paid')->count();
            $completedEvents = $events->clone()->where('status', 'closed')->where('user_id', Auth::id())->where('status', 'partial_paid')->count();
            $pendingEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'partial_paid')->whereNotIn('status', ['closed', 'cancelled'])->count();
            $cancelledEvents = $events->clone()->where('user_id', Auth::id())->where('status', 'cancelled')->count();
        }


        $data = [
            'totalOrders' => $totalOrders ?? 0,
            'pendingOrders' => $pendingOrders ?? 0,
            'completedOrders' => $completedOrders ?? 0,
            'revenue' => $revenue ?? 0,
            'cancelledOrder' => $cancelledOrder ?? 0,
            'admin' => $admin,
            'totalEvents' => $totalEvents ?? 0,
            'completedEvents' => $completedEvents ?? 0,
            'pendingEvents' => $pendingEvents ?? 0,
            'cancelledEvents' => $cancelledEvents ?? 0,
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
