<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Photo Gallery </title>

        <!-- JavaScripts -->
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
 
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css
    ">
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
             font-size: 16px;
        }
       .navbar 
       {
        background : none;
        filter: none;
        box-shadow: none;
        background-color: #2d3538;
       }
       .navbar .nav >li >a {
        color: #fff;
        text-shadow: none;
       }
       #p{
        color: #fff;
        text-shadow: none;
       }
       .navbar .nav >li > a:hover
       {
color: gray;
       }
	   
	   .fa {
		   font-size: 20px;
    margin-right: 5px;
	   }
	   
	   .slider-cont{
		   height : 500px;
		   background: rgba(0,0,0,0.5);
		    margin-top: 50px
	   }
	   
	   .item{
		   height : 500px;
	   }

	   .footer-distributed{
	background-color: #292c2f;
	box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
	box-sizing: border-box;
	width: 100%;
	text-align: left;
	font: bold 16px sans-serif;

	padding:25px 50px;
	margin-top: 80px;
}

.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right{
	display: inline-block;
	vertical-align: top;
}

/* Footer left */

.footer-distributed .footer-left{
	width: 40%;
}

/* The company logo */

.footer-distributed h3{
	color:  #ffffff;
	font: normal 36px 'Cookie', cursive;
	margin: 0;
}

.footer-distributed h3 span{
	color:  #5383d3;
}

/* Footer links */

.footer-distributed .footer-links{
	color:  #ffffff;
	margin: 20px 0 12px;
	padding: 0;
}

.footer-distributed .footer-links a{
	display:inline-block;
	line-height: 1.8;
	text-decoration: none;
	color:  inherit;
}

.footer-distributed .footer-company-name{
	color:  #8f9296;
	font-size: 14px;
	font-weight: normal;
	margin: 0;
}

/* Footer Center */

.footer-distributed .footer-center{
	width: 35%;
}

.footer-distributed .footer-center i{
	background-color:  #33383b;
	color: #ffffff;
	font-size: 25px;
	width: 38px;
	height: 38px;
	border-radius: 50%;
	text-align: center;
	line-height: 42px;
	margin: 10px 15px;
	vertical-align: middle;
}

.footer-distributed .footer-center i.fa-envelope{
	font-size: 17px;
	line-height: 38px;
}

.footer-distributed .footer-center p{
	display: inline-block;
	color: #ffffff;
	vertical-align: middle;
	margin:0;
}

.footer-distributed .footer-center p span{
	display:block;
	font-weight: normal;
	font-size:14px;
	line-height:2;
}

.footer-distributed .footer-center p a{
	color:  #5383d3;
	text-decoration: none;;
}


/* Footer Right */

.footer-distributed .footer-right{
	width: 20%;
}

.footer-distributed .footer-company-about{
	line-height: 20px;
	color:  #92999f;
	font-size: 13px;
	font-weight: normal;
	margin: 0;
}

.footer-distributed .footer-company-about span{
	display: block;
	color:  #ffffff;
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 20px;
}

.footer-distributed .footer-icons{
	margin-top: 25px;
}

.footer-distributed .footer-icons a{
	display: inline-block;
	width: 35px;
	height: 35px;
	cursor: pointer;
	background-color:  #33383b;
	border-radius: 2px;

	font-size: 20px;
	color: #ffffff;
	text-align: center;
	line-height: 35px;

	margin-right: 3px;
	margin-bottom: 5px;
}

/* If you don't want the footer to be responsive, remove these media queries */

@media (max-width: 880px) {
	.footer-distributed{
		font: bold 14px sans-serif;
	}

	.footer-distributed .footer-left,
	.footer-distributed .footer-center,
	.footer-distributed .footer-right{
		display: block;
		width: 100%;
		margin-bottom: 40px;
		text-align: center;
	}

	.footer-distributed .footer-center i{
		margin-left: 0;
	}
}
</style>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <span class="navbar-brand" id="p">
                     <i class="fa fa-image"></i> Photo Gallery 
                </span>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav"> 
                    <li class="{{ Request::is('category')? 'active' : '' }}"><a href="{{ url('/category') }}"><i class="fa fa-home"></i>Home</a></li>
                    @if(!Auth::guest() && Auth::user()->isAdmin())
						<li class="{{ Request::is('user')? 'active' : '' }}"><a href="{{ url('/user') }}"><i class="fa fa-users"></i>Users</a></li>
						<li class="{{ Request::is('role')? 'active' : '' }}"><a href="{{ url('/role') }}"><i class="fa fa-user"></i>Roles</a></li>
                    @endif
                    @if(!Auth::guest())
                        <li class="{{ Request::is('album')? 'active' : '' }}"><a href="{{ url('/album') }}"><i class="fa fa-camera"></i>Albums</a></li>
                        <li class="{{ Request::is('image')? 'active' : '' }}"><a href="{{ url('/image') }}"><i class="fa fa-image"></i>Images</a></li>
						<li class="{{ Request::is('shopping_cart')? 'active' : '' }}"><a href="{{ route('image.getShoppingCart') }}">Shopping Cart
							@if(Session::has('cart')) 
								<span class="badge">
									{{ Session::get('cart')->totQuantity }}  
								</span>
							@endif  
							</a>	
						</li>
				    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ Request::is('login')? 'active' : '' }}"><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i>Login</a></li>
                        <li class="{{ Request::is('register')? 'active' : '' }}"><a href="{{ url('/register') }}"><i class="fa fa-sign-out"></i>Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>
                                Hello {{ Auth::user()->username }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                <li><a href="{{ url('reset_password') }}"><i class="fa fa-key fa-fw"></i>Change Password</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
				<ul>
					<li>CHECKOUT</li>
				</ul>
            </div>
        </div>
    </nav>
    </nav>
    @yield('content')
    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>	
	<footer class="footer-distributed">
		<div class="footer-left">
			<h3>Creative<span>Artists</span></h3>
			<p class="footer-links">
				<a href="#">Home</a>					
			</p>
			<p class="footer-company-name">Creative Artists &copy; 2018</p>
		</div>
		<div class="footer-center">
			<div>
				<i class="fa fa-map-marker"></i>
				<p><span>Fakulteti i Shkencave Te Natyres</span> Tirane, Albania</p>
			</div>

			<div>
				<i class="fa fa-phone"></i>
				<p>(355)694745884</p>
			</div>
			<div>
				<i class="fa fa-envelope"></i>
				<p><a href="mailto:support@company.com">nensi.skenderi@fshnstudent.info</a></p>
			</div>
			<div>
				<i class="fa fa-envelope"></i>
				<p><a href="mailto:support@company.com">kejsi.struga@fshnstudent.info</a></p>
			</div>
		</div>
		<div class="footer-right">
			<p class="footer-company-about">
				We’ll keep you up to date on the latest developments in the art world and invite you to exclusive events in the <span style="color : #5383d3;">Creative Artists<span> galleries.
			</p>
			<div class="footer-icons">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-github"></i></a>
			</div>
		</div>
	</footer>
</body>
</html>