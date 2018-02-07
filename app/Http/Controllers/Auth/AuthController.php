<?php
namespace App\Http\Controllers\Auth;

use Validator;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $username = 'username';
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
   
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>'required|regex:/^[\pL\s\-]+$/u|min:4|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(Request $request)
    {
        $count = 0;
        $count++;
        if($count == 3)
        {
            dd($request);   
        }
        if($this->validateLogjjjjjjjjjjin1($request) != null)
        {
            dd($request);
        }
        else
        {
            dd('fkdjfkd: '.$this->validateLogjjjjjjjjjjin1($request));
        }
    }

    protected function validateLogjjjjjjjjjjin1(Request $request)
    {
        // $count = 0;
        // $count++;
        // var_dump($count);
        $this->validate($request, [
            $this->loginUsername1($request) => 'required', 'password' => 'required',
        ]);
    }

    protected function loginUsername1 (Request $request)
    {
        return property_exists($request, 'username') ? $request->username : 'email';
    }
}
