@extends('layouts.app')
@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}" />
<center><h2>WELCOME </h2></center>

<style>
 .main-category{
	 text-align: center;
	
 }
 
 .img-thumbnail{
	 border : 0px;
	 background : none;
	 padding : 0px;
 }
 
 .sub-cat{
	 background: rgba(0,0,0,0.2);
     text-align: center;
	 margin: 0px;
     padding: 10px;
 }
 
 .desc-cat{
	text-align: center;
 }
 
 .deletecategory{
	     border: 0px;
    background: none;
 }
</style>
<div class="slider-cont">
	<div class="container">  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	 <div class="item active">
        <img src="https://media.gettyimages.com/photos/norwegian-fjord-painting-by-adelsteen-normann-picture-id583749024?b=1&k=6&m=583749024&s=612x612&w=0&h=Zku28D1B121znyIXtQpJ23Y835Bhp4uKBdm7rDek0IA="  style="width:100%;">
      </div>
    
      <div class="item ">
        <img src="https://media.gettyimages.com/photos/oil-on-panel-935-x-128-cm-private-collection-picture-id544228848?b=1&k=6&m=544228848&s=612x612&w=0&h=AQJTC7v7utSkC_0ppCNEko8YOugzHchGx_unNfgPwTo="  style="width:100%;">
      </div>

     
      <div class="item">
        <img src="https://media.gettyimages.com/photos/yosemite-valley-california-chromolithograph-after-a-painting-by-w-picture-id544254392?b=1&k=6&m=544254392&s=612x612&w=0&h=YlWgYYo0BhNaohBu94BGSaKG017T-TV8_4JuOv6davo=" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
<div class="container">
@include('errors')
  @if (Session::has('category_updated'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_updated')  }}  
                 </div>
                 
                  {{ Session::forget('category_updated')}}

  @endif 
     @if (Session::has('category_created'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_created')  }}  
                 </div>
                  {{ Session::forget('category_created')}}

  @endif
     @if (Session::has('category_deleted'))
                 
                 <div class="alert alert-success">
                   {{ Session::get('category_deleted')  }}  
                 </div>
                 {{ Session::forget('category_deleted')}}
  @endif 
 @if(Auth::user()->isAdmin())
   <h4><span><a href ="{{ url('/category/create') }}" >>> Create Category</a></span></h4>
  @endif
  @if($categories->count()>0)
  @foreach($categories->chunk(2) as $r)
    <div>
        @foreach($r as $category)
        <article class="col-md-4">
              <h2 class="main-category"> {{$category->name}} </h2>
              <h2 class="sub-cat"> <a href= "/category/{{$category->id}} "><img class="img-thumbnail" src="/uploads/images/{{ $category->thumbnail}}" alt="Fotoja nuk gjendet " style="width:310px; height:310px"></a></h2>
              <div class="body">
                  <h4 class="desc-cat">{{ $category->description }}</h4>
                  <p></p>
                  @if(Auth::user()->isAdmin())  
                  <div class="row" style=" background: rgba(255, 255, 255, 0.8);">
                         <div class="col-sm-2">
                 <a href="/category/{{$category->id}}/edit" style="color:inherit" class="links-dark edits pull-left">
                    <i class="fa fa-edit"  style="font-size:35px; color : #2f6ec0 "></i>
                </a>
              </div>
            <div id="deleteThecategory" class="col-sm-2">
                <a href="#" style="color:inherit" onclick="                     
                           return confirm('Deleting this category will delete ALL its albums along with their images .  CONTINUE ??')"> 

                {!! Form::open(['method' => 'DELETE', 'route'=>['category.destroy', $category->id]]) !!}
                {!! Form::button('<i class="fa fa-trash" style="font-size:31px; color : red"></i>', ['class' => 'deletecategory','type' => 'submit']) !!}
                  </a>
                {!! Form::close() !!}
           </div>
            @endif
              </div>
        </article>
        @endforeach
    </div>
  @endforeach
 {{ $categories->links() }}
</div>
@endif
<br><br><br>
@stop