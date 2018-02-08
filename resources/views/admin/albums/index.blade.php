@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<style>
 .main-album{
	 text-align: center;
 }
 
 .img-thumbnail{
	 border : 0px;
	 background : none;
	 padding : 0px;
 }
 
 .sub-album{
	 background: rgba(0,0,0,0.2);
     text-align: center;
	 margin: 0px;
     padding: 10px;
 }
 
 .desc-album{
	text-align: center;
 }
 
 .deletecategory{
	     border: 0px;
    background: none;
 }
</style>
<div class="container">
@include('errors')
@if (session('album_created'))
    <div class="alert alert-success"> 
                  {{ Session::get('album_created')  }}  </div>
     {{ Session::forget('album_updated') }}
                        
   @endif
 @if (session('album_updated'))
    <div class="alert alert-success"> 
                  {{ Session::get('album_updated')  }}  </div>
     {{ Session::forget('album_updated') }}
                        
   @endif
    @if (session('album_deleted'))
    <div class="alert alert-success"> 
                  {{ Session::get('album_deleted')  }}  </div>
     {{ Session::forget('album_deleted') }}
                        
   @endif
@if(Auth::user()->isAdmin())
   <h4><span><a href ="{{ url('/album/create') }}" >>> Create Album</a></span></h4>
@endif

  @foreach(array_chunk($albums->getCollection()->all(),3) as $a)
  <div class="row">
    @foreach($a as $album)
        <article class="col-md-4">
              <h2 class="main-album"> {{$album->name}} </h2>
                
              <h2 class="sub-album"><a href= "/album/{{$album->id}} "><img src="/uploads/images/{{ $album->thumbnail}}" alt="Fotoja nuk gjendet " style="width:250px; height:250px" class="img-thumbnail"></a></h2>
              <h4 class="desc-album">{{ $album->description }}</h4>

     @if(Auth::user()->isAdmin())
            <a href="/album/{{$album->id}}/edit" class="links-dark edits pull-left" style="color:inherit">
                <i class="fa fa-edit" style="font-size:35px;color : #2f6ec0"></i>
            </a>
            <a href="#" style="color:inherit" onclick="                     
                           return confirm('Deleting this album will delete ALL its IMAGES .  CONTINUE ??')"> 

                {!! Form::open(['method' => 'DELETE', 'route'=>['album.destroy', $album->id]]) !!}
                {!! Form::button('<i class="fa fa-trash" style="font-size:31px; color : red"></i>', ['class' => 'deletecategory','type' => 'submit']) !!}
                {!! Form::close() !!}  
            </a>                
     @endif
            <br>
            <div id = "divform" style="width: 570px;">
              <button value="{{ $album->id }}" class="btn btn-primary btn-xm upload"><i class="fa fa-file-photo-o"></i> Upload Image</button>
              <!-- <div class="col-xs-3">
                <button type="button" class="btn btn-success btn-sl">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                </button>
              </div> -->
                <center>
                <div class="modal fade" id="modal">
                  <div class="modal-content" style=" position:absolute;top:10% !important;margin:auto 35%;width:40%;height:50%;">
                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Image Upload</h4>
                    </div>
                        <form class="form" action="#" enctype="multipart/form-data">

                         <input type="hidden" name="_token" value="{{ csrf_token() }}">                                              
                            <div class="form-group">
                             <label for="name" id="lab">Name</label>
                             
                             <input type="text" style="width:300px;" class="form-control name"  name="name"> 
                                         
                            
                            <label for="path">Image:</label>
                         <input type="file" name="path" class="btn btn-default btn-file path"  id="path" />

                           </div>
                          <button type="button" value="{{ $album->id }}" name="album" id="submit" class="btn btn-danger btn-xm submit">Submit</button>
                         
                          </form>
                         
                        </div>                
                    </div></center>
                    </div>
               </article>  
              @endforeach
         </div>         
  @endforeach

  {{ $albums->links() }}
</div>
  <script type="text/javascript"> 
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});   

  $(document).ready(function()
  {
           
  $('.upload').on('click', function() {
    var nr_al = document.getElementsByClassName("form").length;
    var imgAlbum = $(this).val();
    /*alert(imgAlbum);
    return false;*/
    var token = $('input[name=_token]').val();
    var al = 0;
    $('#modal').modal({show:true});

      $('.submit').on('click', function() {  
              
             /* alert($(this).closest("form").attr('id'));
              return false;*/

              var imgName = '';
              var imgPath ='';
                $("#divform .name").each(function() {   
                                
                     if($(this).val()!= ''){
                      imgName = $(this).val();
                      return false;

                    }                   
               });
           
                $("#divform .path").each(function() {
                        if($(this).val()!= ''){
                        imgPath =  $(this).val();
                        }
                    });

                if(imgName=='' || imgPath=='')
                {
                  alert('Name and File are required !');
                }else 
                { 
                  var ext = imgPath.split('.').pop().toLowerCase();
                      if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                          alert('invalid Image Type!');
                        }
                        else{
                      
                   /* imgPath = imgPath.replace("C:\\fakepath\\","");                             
                    var ds = "name=" +imgName+ "&album_id="+imgAlbum+ "&path="+imgPath+'&_token='+token;*/
                         var dis = new FormData($(".form")[0]);
                         dis.append('album_id', imgAlbum);
                      $.ajax({
                                  url:'image',         
                                  data:dis, 
                                  async:true,
                                  type:'post',
                                  processData: false,
                                  contentType: false,
                                  success:function(response){
                                    console.log(response);
                                    window.location.reload();
                                     alert("Image has been sucssessfully uploaded !");

                                  },
                                  error:function(response){
                                    console.log(response);
                                    window.location.reload();
                                     alert("Image couldn't get uploaded");

                                  },
                              });
                       
                       $('#modal').modal('hide');
                              
                    }
                }
    });

  });
});
   
  </script>
@stop