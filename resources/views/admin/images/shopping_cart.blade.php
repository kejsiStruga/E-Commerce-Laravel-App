@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
    @include('errors')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-offset-3 col-sm-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($images as $p)
                        <li class="list-group-item">
                            <span class="badge">{{ $p['qty'] }}</span>
                            <strong>{{ $p['image']['name']  }}</strong>
                            <span class="label label-success">{{ '$'. $p['price']  }}</span>
                            {!! Form::open(array('url'=>'action', 'method'=>"get")) !!}
                                <a href= {{ route('image.removeImage', [ 'id' => $p['image']['id'] ] ) }}  class="glyphicon glyphicon-remove"></a>
                                <a href= {{ route('image.increaseQty', [ 'id' => $p['image']['id'] ] ) }} class="glyphicon glyphicon-plus"></a>
                                <a href= {{ route('image.decreaseQty', [ 'id' => $p['image']['id'] ] ) }}  class="glyphicon glyphicon-minus"></a>
                            {!! Form::close() !!}
                        </li>
                    @endforeach
                </ul>
                <div class="row col-sm-6">
                    Total Price:<strong> {!! ' $' .$totPrice .' '  !!} </strong>
                    <hr>
                  <a href="{{ route('checkout')  }}" type="button" class="btn btn-success">Checkout</a>
                    <!-- nensi begin -->
                    <form id ="view-cart" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="viewcart">
                        <form id ="form3" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_cart" />
                            <input type="hidden" name="display" value="1" />
                            <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
                        </form>
                        <form id ="form2" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_cart" />
                            <input type="hidden" name="add" value="1" />
                            <input type="hidden" name="upload" value="1">  <!-- add this line in your code -->
                            <input type="hidden" name="business" value="nsenensene202020@gmail.com" />

                            <input type="hidden" name="item_name_1" value="dddd"/>
                            <input type="hidden" name="item_number_1" value="1">
                            <input type="hidden" name= "amount_1" value="20"/>
                         
                            <input type="hidden" name="item_name_2" value="ffhdsjfhskdddd"/>
                            <input type="hidden" name="item_number_2" value="2">
                            <input type="hidden" name= "amount_2" value="20"/>

                            <input type="hidden" name="currency_code" value="USD" />
                            <input type="hidden" name="lc" value="US" />
                            <input type="hidden" name="cancel_return" value="http://localhost:8000/album/1">
                            <input type="hidden" name="return" value="http://localhost/paypal-shopping-cart/success.php">
                        </form>
                        <div id="add-cart"><a class="pro1 add" style="padding-left: 50px;" href="#" 
                            onclick="document.getElementById('form2').submit()" id="cart-btn" id="cart-btn">
                            <i class="fa fa-cart-plus"></i> Add to Cart </a >
                        </div>
                        <div id="view-cart"><a href="javascript:void(0);" 
                            onclick="document.getElementById('view-cart').submit()" id="cart-btn"><i class="fa fa-eye"></i> View Cart </a>
                        </div>
                    </form>
                    <!-- nesi end -->

                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_cart">  <!-- change _xclick to _cart -->
                        <input type="hidden" name="upload" value="1">  <!-- add this line in your code -->
                        <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
                        <input type="hidden" name="item_name_1" value="Item Name 1">
                        <input type="hidden" name="amount_1" value="1.00">
                        <input type="hidden" name="item_name_2" value="Item Name 2">
                        <input type="hidden" name="amount_2" value="2.00">
                        <input type="submit" value="PayPal">
                    </form>        

                </div>      
            </div>
        </div>
     </div>
    @else
    <h2>No Items in the cart </h2>
    @endif
@endsection