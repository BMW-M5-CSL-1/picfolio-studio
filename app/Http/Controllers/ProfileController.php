<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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

    public function index()
    {
        // $data = [
        //     'orders' => Order::where('user_id', Auth::user()->id)->get(),
        // ];
        return view('profile.index');
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

        return Redirect::route('profile.index')->withSuccess('Profile Updated');
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
