<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Auth;
use Session;
use App\Album;
use File;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{
    public function __constructor()
    { 

    }

    public function testMail() 
    {
        dd(' Test correct !! :DDDDDDDD');
    }
}