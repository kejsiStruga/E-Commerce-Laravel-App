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
                  <!-- <a href="{{ route('checkout')  }}" type="button" class="btn btn-success">Checkout</a> -->
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_cart">  <!-- change _xclick to _cart -->
                        <input type="hidden" name="upload" value="1">  <!-- add this line in your code -->
                        <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
                        <?php
                            $cnt=1;
                            //  dd($images);
                            foreach($images as $img)
                            {  
                        ?>
                                <input type="hidden" name="<?php echo "item_name_$cnt" ?>" value="<?php echo $img['image']['name']; ?>"/>
                                <input type="hidden" name="<?php echo "amount_$cnt" ?>" value="<?php echo  $img['image']['price']; ?>"/>
                        <?php
                                $cnt++;
                            }
                        ?>
                        <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                        <!-- <input type="submit" value="PayPal Checkout" class="btn btn-success"> -->
                    </form>        
                </div>      
            </div>
        </div>
     </div>
    @else
    <h2>No Items in the cart </h2>
    @endif
@endsection