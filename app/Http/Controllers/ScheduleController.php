<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function getSchedule()
    {
        $user = Auth::user();

        $admin_role = $user->roles->where('slug', 'admin')->count() == 1;
        $photographer_role = $user->roles->where('slug', 'photographer')->count() == 1;
        $user_role = $user->roles->where('slug', 'user')->count() == 1;

        if ($admin_role) {
            $events = Event::with('eventPhotographers')->orderBy('start_date')->get();
        } elseif ($photographer_role) {
            $events = Event::whereHas('eventPhotographers', function ($query) use ($user) {
                $query->where('photographer_id', $user->id)
                    ->whereIn('status', ['applied', 'hired']);
            })
                ->orderBy('start_date')
                ->get();
        } elseif ($user_role) {
            $events = Event::where('user_id', $user->id)
                ->with('eventPhotographers')
                ->orderBy('start_date')
                ->get();
        } else {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $data = [
            'events' => $events,
            'admin_role' => $admin_role,
            'photographer_role' => $photographer_role,
            'user_role' => $user_role,
        ];

        return view('app.schedule.index', $data);
    }
}
