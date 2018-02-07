@extends('layouts.app')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
	.img-thumbnail{
	 border : 0px;
	 background : none;
	 padding : 0px;
 }
 .deletecategory{
	     border: 0px;
    background: none;
 }
 
 .main-img {
	 text-align : center;
 }
 .img-design {
	 width: 320px;
    height: 320px;
    background: rgba(0,0,0,0.2);
    text-align: center;
    margin: 0px;
    padding: 10px;
 }
 
</style>
<div class="container">
@include('errors')
 @if (session('image_updated'))
    <div class="alert alert-success"> 
                  {{ Session::get('image_updated')  }}  </div>
     {{ Session::forget('album_updated') }}
                        
   @endif
    @if (session('image_deleted'))
    <div class="alert alert-success"> 
                  {{ Session::get('image_deleted')  }}  </div>
     {{ Session::forget('image_deleted') }}
                        
   @endif
  @foreach(array_chunk($images->getCollection()->all(),3) as $r)
    <div class="row">
        @foreach($r as $image)
        <article class="col-md-4">
              <h2 class="main-img"> {{$image->name}} </h2>
              <div class="col-xs-1">
                  {!! Form::open(['method' => 'get', 'route'=>['image.addImageToCart', $image]]) !!}
                  {!! Form::label('price','$ '. $image->price ) !!}
                  {!! Form::button('<i class="glyphicon glyphicon-shopping-cart"  style="font-size:20px;"> </i>',
                  ['style'=>'color:inherit','class'=>'btn-link ', 'type' => 'submit']) !!}
                  {{ csrf_field() }}
                  {!! Form::close() !!}
              </div>
            @if(Auth::user()->isAdmin())
         <a href= "/image/{{$image->id}}"><img src="/uploads/images/{{ $image->path}}" alt="Fotoja nuk gjendet " class = " img-thumbnail img-design">
         </a>   
         @else
         <a href= "/uploads/images/{{ $image->path}}"><img src="/uploads/images/{{ $image->path}}" alt="Fotoja nuk gjendet " class = " img-thumbnail" style="width:200px; height:200px">
         </a>
         @endif

           <br><br>
              <div class="body">
            
            @if(Auth::user()->isAdmin() || $image->editImage() )  
              
              <a href="/image/{{$image->id}}/edit"  style="color:inherit" class="links-dark edits pull-left">
                <i class="fa fa-edit" style="font-size:35px; color : #2f6ec0"></i>
            </a>
              {!! Form::open(['method' => 'DELETE', 'route'=>['image.destroy', $image->id]]) !!}
                  {!! Form::button('<i class="fa fa-trash" style="font-size:31px; color : red"></i>', ['class' => 'deletecategory','type' => 'submit']) !!}
                  </a>
                   {{ csrf_field() }}
                  {!! Form::close() !!}
            @endif 
             </div>
        </article>
        @endforeach
    </div>
  @endforeach

  {{ $images->links() }}
</div><br>
<div class="container">
 
</div>
@stop