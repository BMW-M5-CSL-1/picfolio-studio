<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index($user_id)
    {
        $user = User::find($user_id);

        // Role checks
        $isAdmin = $user->roles->where('slug', 'admin')->count() == 1;
        $isPhotographer = $user->roles->where('slug', 'photographer')->count() == 1;
        $isUser = $user->roles->where('slug', 'user')->count() == 1;

        // dd( $isAdmin, $isPhotographer, $isUser);

        $query = Event::query();

        // Get total, completed, and pending events based on roles
        if ($isAdmin) {
            $totalEvents = $query->count();
            $completedEvents = $query->where('status', 'closed')->count();
            $pendingEvents = $query->whereIn('status', ['pending', 'published', 'in_process', 'locked'])->count();
            $cancelledEvents = Event::where('status', 'cancelled')->count();
        } elseif ($isPhotographer) {
            $totalEvents = $query->whereHas('eventPhotographers', function ($q) use ($user) {
                $q->where('photographer_id', $user->id);
            })->count();

            $completedEvents = $query->where('status', 'closed')
                ->whereHas('eventPhotographers', function ($q) use ($user) {
                    $q->where('photographer_id', $user->id);
                })->count();

            $pendingEvents = $query->whereIn('status', ['pending', 'published', 'in_process', 'locked'])
                ->whereHas('eventPhotographers', function ($q) use ($user) {
                    $q->where('photographer_id', $user->id);
                })->count();

            $cancelledEvents = $query->where('status', 'cancelled')
                ->whereHas('eventPhotographers', function ($q) use ($user) {
                    $q->where('photographer_id', $user->id);
                })->count();
        } elseif ($isUser) {
            $totalEvents = $query->where('user_id', $user->id)->count();
            $completedEvents = $query->where('user_id', $user->id)->where('status', 'closed')->count();
            $pendingEvents = $query->where('user_id', $user->id)->whereIn('status', ['pending', 'published', 'in_process', 'locked'])->count();
            $cancelledEvents = $query->where('user_id', $user->id)->where('status', 'cancelled')->count();
        }

        $data = [
            'user' => $user,
            'can_edit' => request()->has('only_view') ? false : true,
            'totalEvents' => $totalEvents ?? 0,
            'completedEvents' => $completedEvents ?? 0,
            'pendingEvents' => $pendingEvents ?? 0,
            'cancelledEvents' => $cancelledEvents ?? 0,
        ];
        return view('profile.index', $data);
    }
    /**
     * Display the user's profile form.
     */
    public function edit($id, Request $request)
    {
        if ($id && $id > 0) {
            $user = User::find($id);
            if ($user) {
                $data = [
                    'user' => $user,
                ];
                return view('profile.edit', $data);
            } else {
                return redirect()->back()->withDanger('User not found');
            }
        }
    }

    /**
     * Update the user's profile information.
     */

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cnic' => ['required', 'numeric', 'max_digits:14', 'unique:users,cnic,' . $id],
            'contact' => ['required', 'numeric', 'max_digits:11', 'min_digits:10'],
            'gender' => 'required',
            'country' => 'required',
            'dob' => 'required',
        ], [
            'name.*' => 'First Name is Invalid',
            'contact.*' => 'Contact Field is Invalid',
            'cnic.*' => 'CNIC Field is Invalid',
            'dob.*' => 'Date of Birth is Invalid',
            'country.*' => 'Country is Invalid',
            'gender.*' => 'Gender is Invalid',
        ]);

        $user = User::find($id);
        if ($user) {
            $data = [
                'name' => $request->name,
                'father_name' => $request->fatherName,
                'cnic' => $request->cnic,
                'dob' => $request->dob,
                'contact' => $request->contact,
                'gender' => $request->gender,
                'country' => $request->country,
            ];
            DB::transaction(function () use ($user, $data) {
                $user->update($data);
            });
        } else {
            return redirect()->back()->withDanger('User not found');
        }

        return Redirect::route('profile.index', ['id' => $id])->withSuccess('Profile Updated');
    }

    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.index')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
