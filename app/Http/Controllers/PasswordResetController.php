<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use File;
use Session;
use Auth;
use Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

/*
    Ctrl to reset the password of users, therefore its secured by the 'auth' middleware, in oppose
    to the 'admin' middleware
*/
    
class PasswordResetController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reset_password() 
    {
        return view('auth.reset_password');
    }

    public function reset_submit() 
    {
        $input = Input::except('_token');
        $rules = array(
            'current_password' => 'required',
            'newpassword' => 'required|min:7|different:current_password|confirmed'
        );
        $validator = Validator::make($input, $rules);
        
        if(!Hash::check($input['current_password'], Auth::user()->password))
        {
            $validator->errors()->add('current_password', 'Current password doesn\'t match');
            return back()->withErrors($validator);
        }
        else 
        {
            if(!$validator->passes())
            {
                return back()->withErrors($validator);
            }
            else 
            {
                Auth::user()->password = bcrypt($input['newpassword']);
                Auth::user()->save();
                return redirect()->back()->with('pass_update', 'Password changed');
            }
        }
    }

}

    