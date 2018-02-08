<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Album;
use App\Image;
use Session;
use File;
use Auth;
use App\Category;
use App\Cart;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class ShoppingCartController extends Controller 
{
    public function remove($id) 
    {
        return back();
        // dd($id);
    }

    public function decrease($id) 
    {
        dd($id);
    }

    public function increase($id) 
    {
        dd($id);
    }
}
