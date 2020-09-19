<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            toastr()->error('Your current password does not matche with the password you provided. Please try again.');
            return redirect()->back();
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            toastr()->error('New Password cannot be same as your current password. Please choose a different password.');
            return redirect()->back();
        }

        if(strcmp($request->get('new-password'), $request->get('new-password_confirmation')) != 0){
            //new password and confirm password are  not the same
            toastr()->error('New Password and Confirm password are not the same. Please try again');
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        toastr()->success('Password changed successfully !');
        return redirect()->back();
    }

    public function changeProfile(Request $request){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','string','min:11','unique:users'],
            'state' => ['required','string'],
            'address' => ['required','string']
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->update($data);

        return redirect()->back();
    }

    }
