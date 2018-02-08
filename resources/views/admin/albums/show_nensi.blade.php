@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function() {
        $('a.pro1').click(function() {
            $("div#loader1").show();

        });
        $('a.pro2').click(function() {
            $("div#loader2").show();

        });
        $('a.pro3').click(function() {
            $("div#loader3").show();

        });
    });
</script>

<style>
	.img-name{
		text-align: center;
    margin-right: 10%;
	}
	.img-thumbnail{
		width : 90%;
	}
	#product_details {
    width: 90%;
	height: 86px;
	margin-top: -15px;
    background: rgb(219, 219, 219);
}
#pro_price {
    width: 58%;
    height: 80px;
    float: left;
	padding : 10px;
}
#pro_quantity {
    width: 40%;
    height: 80px;
    float: right;
	padding : 10px;
}
#add-cart {
    width: 50%;
    height: 50px;
    float: left;
}
#cart-btn {
    width: 100%;
    background-color: #FFBC00;
    color: white;
    border: 1px solid #FFCB00;
    padding: 10px 24px;
    font-size: 16px;
    cursor: pointer;
    margin-bottom: 15px;
}
#product i {
    color: white;
    text-decoration: none;
}
#view-cart {
    width: 50%;
    float: right;
}
</style>
<div class="container">
@include('errors')
@if (session('image_removed'))
    <div class="alert alert-success"> 
     {{ Session::get('image_removed')  }}  </div>
     {{ Session::forget('image_removed') }}
                        
   @endif
  @foreach(array_chunk($images->all(),3)as $r)
	<div class="row" >
	@foreach($r as $image)	

	@if($image->showImage())
		<article class="col-md-4">
		<div id="gallery">			
	    <h2>{{ $image->name }}</h2>	
	    <a href="/uploads/images/{{ $image->path}}" ><img alt="{{$image->name}}" class="img-thumbnail" height=200px width=200px src="/uploads/images/{{ $image->path}}"></a>
	    </div>
		<!-- shtim paypal -->
		<form id ="view-cart" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="viewcart">
            <form id ="form3" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="display" value="1" />
                <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
            </form>
			<form id ="form2" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="add" value="1" />
                <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
                <input type="hidden" name="item_name" value="<?php echo e($image->name); ?>" />
                <input type="hidden" name="amount" value="50" />
                <input type="hidden" name="currency_code" value="USD" />
                <input type="hidden" name="lc" value="US" />
                <input type="hidden" name="cancel_return" value="http://localhost:8000/album/1">
                <input type="hidden" name="return" value="http://localhost/paypal-shopping-cart/success.php">
            </form>
            <div id="product_details">
                <div id="pro_price">
                    <p><?php echo e($image->name); ?></p>
                    <p>Price : <b>$50</b></p>
                </div>
                <div id="pro_quantity">
                    <p>Quantity</p>
                    <select name="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div id="add-cart"><a class="pro1 add" style="padding-left: 50px;" href="#" 
                onclick="document.getElementById('form2').submit()" id="cart-btn" id="cart-btn">
                <i class="fa fa-cart-plus"></i> Add to Cart </a >
            </div>
            <div id="view-cart"><a href="javascript:void(0);" 
                onclick="document.getElementById('view-cart').submit()" id="cart-btn"><i class="fa fa-eye"></i> View Cart </a>
            </div>
        </form>
	          <!--ONLY ADMINS CAN REMOVE AN IMAGE -->
        	 @if(Auth::user()->isAdmin())
        	 	<div class="row">
        	 			<div class="col-sm-3">
			 			<a href="" style="color:inherit" class="links-dark edits pull-left" >
				            {{ Form::open(['url'=>['removeimg',$image->id ], 'method' => 'PUT', 'class'=>'col-md-12']) }}
				            
				             {!! Form::button('<i class="fa fa-remove fa-lg links-dark" style="font-size:20px;"></i>', ['type' => 'submit', 'style'=>'']) !!}
							{{ Form::close() }}
			           	</a>	
						</div>
						
			       </div>
		     @endif
			</article>	
			@endif	
		@endforeach
	</div>
@endforeach
<!--  -->
{{ $images->links() }}

		<link rel="stylesheet" href="/example2/colorbox.css" />
        <script type="text/javascript" src="/example2/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="/example2/jquery.colorbox.js"></script>
<script type="text/javascript">
	  
	    $.ajaxSetup({  
         headers: {  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                      } 
                     });
		$(document).ready(function(){                  
					$('#gallery a').colorbox({

						rel: 'slideshow',
						height: '65%',
						width: '65%',
				     	maxWidth: '100%'
				     });

	});			

		</script>
</div>	
@stop