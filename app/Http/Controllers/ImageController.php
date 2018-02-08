<?php
namespace App\Http\Controllers;
use Session;
use Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Image;
use Illuminate\Support\Facades\URL;
use App\Album;
use File;
use App\Order;
use App\Cart;
use Validator;
use Auth;
use App\Http\Requests;

class ImageController extends Controller
{
    public function index()
    {       
        if(Auth::user()->isAdmin())
        {
            return view('admin.images.index')->with('images', Image::paginate(6));
        }
        else
        {
            $images = $images=Image::where('active',1)
                                ->orWhere('user_id','=',Auth::user()->id)
                                ->paginate(6);
            return view('admin.images.index')->with('images', $images);
        }
    }
    
    public function create()
    {
        return view('admin.images.create', array('user'=>Auth::user()));
    }

    public function store(Request $request)
    {
        if($request->hasFile('path'))
        {
            /*$data = $request->all();
            var_dump($data);*/
        
            $file = $request->file('path');
            $p = time(). '.'.$file->getClientOriginalExtension();
            \Image::make($file)->resize(450,450)->save(public_path('/uploads/images/'.$p));

            $img = new Image;
            $img->path = $p;
            Auth::user()->addImage($img);
            $img->name = $request->input('name');
            $img->album_id = $request->input('album_id');
            $img->save();

            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['error' => true]);
        }  
    }

    public function show(Image $image)
    {

        return view('admin.images.show', ['image' => $image]);
    }

    public function edit(Image $image)
    {
        if (Gate::denies('edit-image',$image)) 
        {
            abort(403,'Not authorized to update!');            
        }
        $albums  = Album::all();
        $arr = ['image'=> $image,
                 'albums' => $albums   
                ];
       return view('admin.images.edit',['arr'=>$arr]);
    }
   
    public function update(Request $req, Image $image)
    {  
        $change = 0;
        if(($req->act == 'Active' && $image->active==0) || ($req->act == 'Not active' && $image->active==1))
        {
            $change = true;
        }
        if($req->act=='Active')
        {   
             $image->active = 1;
             $image->save();
        }
        if($req->act=='Not active')
        {
             $image->active = 0;
             $image->save();
        }
       
        $this->validate($req, [ 
            'name' => 'required|min:4|max:32| 
            unique:images,name,'.$image->id,  
        ]);
        
        if( ($image->name != $req->name) || ($req->album_id != $image->album_id) || $change)
        {
            $image->name = $req->name;
            $image->album_id = $req->album_id;
            $image->save();
            Session::flash('image_updated', 'Image Successfully Updated');
            return redirect()->route('image.index');
        }
        else
        {
            return redirect()->route('image.index');  
        }     
    }

    public function destroy(Image $image)
    {
        $path = '/uploads/images/';
        $p = $image->path;
        File::Delete(public_path($path.$image->path));
        $image->delete();
        return back()->with('image_deleted','Image Deleted Successfully');
    }
    
    public function addImageToCart(Request $req, Image $image)
    {
        $c = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($c);
        $cart->addImage($image);
        $req->session()->put('cart', $cart);

        // dd(URL::current());
        // if(URL::current() )
        $url = URL::current();
        if (strpos($url, 'paypal_success') !== false) {
            dd('You have successfully passed the pau[fskldlfjsdklfjkl');
        }
        return back();
    }
    
    public function getShoppingCart()
    {
        if(!Session::has('cart'))
        {
            return view('admin/images.shopping_cart', ['images' => null]);
        }
        $c = Session::get('cart');
        $ct = new Cart($c);
        return view('admin/images.shopping_cart', [
            'images' => $ct->images,
            'totPrice' => $ct->totPrice,
        ]);
    }
    
    public function getDecreaseQty($id) 
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->decreaseQty($id);
        
        if(count($cart->images) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }
        
        return redirect()->route('image.getShoppingCart');
    }

    public function getIncreaseQty($id) 
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->increaseQty($id);
        
        Session::put('cart', $cart);
        return redirect()->route('image.getShoppingCart');
    }

    public function getRemoveImage($id) 
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeImage($id);
        
        if(count($cart->images) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        return redirect()->route('image.getShoppingCart');
    }

    public function getCheckout()
    {
        if(!Session::has('cart'))
        {
            return view('admin/images.shopping_cart', ['images' => null]);
        }
        $cart = Session::get('cart');
        $newCart = new Cart($cart);
        $totPrice = $newCart->totPrice;
        return view('admin/images.checkout', ['total' => $totPrice]);
    }

    public function postCheckout(Request $req)
    {
        if(!Session::has('cart'))
        {
            return redirect()->back();
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        //on back-end we set the private key
        Stripe::setApiKey('sk_test_B00D8AmIQM0ULB65WlUp1wqe');
        try{
            $charge = Charge::create(array(
                "amount" => $cart->totPrice * 100,
                "currency" => "usd",
                "source" => $req['stripeToken'], // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart=serialize($cart); // convert the object into string
            // $order->address=
            // before clearing we must store the order
        }
        catch(\Exception $e)
        {
            return redirect()->route('checkout')->withError($e->getMessage());
        }
        //bsc we cheked out; !!
        Session::forget('cart');
        return redirect()->back();
    }

    public function successPayPal() 
    {
        // dd(Session::get('cart')->images);
        if(!empty(Session::get('cart')->images))
        {
            $images = Session::get('cart')->images;
            //dd( $images);
            DB::table('orders')->insert(
                ['user_id' => Auth::user()->id, 'status' => 1]
            );
            $purchased_items=[];
            $latest_id=DB::table('orders')->orderBy('id', 'desc')->first();
            $id_latest_paypal_order = json_decode(json_encode($latest_id),true)['ID'];
            foreach($images as $img)
            {
                // var_dump( $img['image']['id'] . 'quantity' .'== '.  $img['qty'], 'price' .  $img['price']);
                DB::table('order_details')->insert(
                    ['order_id' => $id_latest_paypal_order, 'art_item_id' => $img['image']['id'], 'quantity' =>  $img['qty'], 'price' =>  $img['price']]
                );
            }
            Session::forget('cart');
            $obj_images= $images;
            return view('admin.images.paypal_success')->with(compact('images'));
        }
        else 
        {
            return view('admin.images.paypal_success');
        }
    }
}
