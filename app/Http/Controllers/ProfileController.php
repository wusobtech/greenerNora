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
         
       $data = $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|string|min:8|confirmed',
                ]);
         $user = User::findOrFail(Auth::user()->id);
    //    dd($request->all());
        if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            $user->password = bcrypt($request->get('new_password'));
            // $user->password = $request->input('new_password');
        }
         
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
       

            $user = Auth::user();
            $user->password = bcrypt($request->get('new_password'));   
            $user->update($data);

            return back()->with('success','password changed successfully');
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
