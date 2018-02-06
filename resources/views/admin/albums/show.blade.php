@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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