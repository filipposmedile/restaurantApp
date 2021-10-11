@extends('layouts.app')

@section('style')
    <style type="text/css">
        .button-img{
            width: 200px;
        }
        .button-text{
            padding: 20px;
            color: black;
            font-size: 150%;
            border: 3px solid black;
            border-radius: 10px;
            text-align: center;
            background-color: white;
            box-shadow: 0 0 10px gray;
        }
        .button-text:hover{
            text-decoration: none;
            color: black;
            background-color: lightgray;
        }
        .bar-black{
            height: 3px;
            background-color: black;
        }
        .button-collapse{
            font-size: 120%;
            color: black;
            padding-top: 10px;
            padding-left:10px;
        }
        .button-collapse:hover{
            color: gray;
            text-decoration: none;
        }
        .list{
            padding: 5px;
            border: 1px solid black;
            margin-bottom: 15px;
        }
        .delete-button{
            color: white;
            background-color: red;
            border-radius: 10px;
            margin: auto;
            border: 2px solid rgb(255, 116, 116);
            padding:10px;
        }
        .delete-button:hover{
            background-color: rgb(255, 71, 71);
        }
        .collapse-sub{
            border: 1px solid black;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .img-list{
            max-width: 200px;
            max-height: 200px;
            margin: 10px;
            box-shadow: 0 0 10px gray;
        }
        .img-box{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .icon{
            width: 100px;
            height: 100px;
            margin: 5px auto;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h1 style="text-align: center">Pictures</h1>
    <hr class="bar-black">
    @if (session('green-message'))
        <div class="alert alert-success" id="images-uploaded"  role="alert">
            {{session('green-message')}}
        </div>
    @endif
    @if (session('red-message'))
        <div class="alert alert-danger" id="images-uploaded"  role="alert">
            {{session('red-message')}}
        </div>
    @endif




    <div class="row">
        <div class="col-md-8">
            
            {{$images->links()}}
            @foreach ($images as $image)
            <input type="hidden" value="{{$loop->count}}" id="count">
                @if ($loop->odd)
                    <div class="row">    
                        <div class="col-md-6">
                            <a href="#edit-image{{$image->id}}" data-toggle="collapse"><img src="{{asset('storage/'.$image->path)}}" class="img-list" alt=""></a>
                            <div class="collapse" id="edit-image{{$image->id}}">
                                <form action="{{route('pictures.update',$image->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" name="images" class="form-control" id="inputGroupFile01">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="{{$image->name}}" name="name" placeholder="Name">  
                                    </div> 
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="descirption" style="resize: none" rows="7">{{$image->description}}</textarea>
                                    <input type="hidden" value="{{$image->purpose}}" id="select{{$loop->index}}">
                                    <select name="purpose" id="purpose{{$loop->index}}" class="form-select" >
                                        <option value="no-purpose">No Purpose</option>
                                        <option value="homepage">Homepage</option>
                                        <option value="xBackground">Background X</option>
                                    </select>
                                    <hr>
                                    <div id="gallery-edit"></div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </form>
                                <form action="{{route('pictures.delete',$image->id)}}" method="post" style="margin: 10px 0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>                
                @endif
                @if ($loop->even)
                        <div class="col-md-6">
                            <a href="#edit-image{{$image->id}}" data-toggle="collapse"><img src="{{asset('storage/'.$image->path)}}" class="img-list" alt=""></a>
                            <div class="collapse" id="edit-image{{$image->id}}">
                                <form action="{{route('pictures.update',$image->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" name="images" class="form-control" id="inputGroupFile01">
                                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="{{$image->name}}" name="name" placeholder="Name">  
                                    </div> 
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="descirption" style="resize: none" rows="7">{{$image->description}}</textarea>
                                    <input type="hidden" value="{{$image->purpose}}" id="select{{$loop->index}}">
                                    <select name="purpose" id="purpose{{$loop->index}}" class="form-select" >
                                        <option value="no-purpose">No Purpose</option>
                                        <option value="homepage">Homepage</option>
                                        <option value="xBackground">Background X</option>
                                    </select>
                                    <hr>
                                    <div id="gallery-edit"></div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </form>
                                <form action="{{route('pictures.delete',$image->id)}}" method="post" style="margin: 10px 0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                
                @if ($loop->odd)
                    @if ($loop->last)
                        </div>
                    @endif
                @endif
            @endforeach
            {{$images->links()}}

    </div>


        <div class="col-md-4">
            <h2>
                Add new Images
            </h2>
            <hr>
            <form action="{{route('pictures.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="file" name="images" required class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name">  
                </div> 
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="descirption" style="resize: none" rows="7"></textarea>
                <label for="purpose">Purpose</label>
                <select name="purpose" id="purpose" class="form-select" >
                    <option value="no-purpose">No Purpose</option>
                    <option value="homepage">Homepage</option>
                    <option value="xBackground">Background X</option>
                </select>
                <hr>
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
            <hr>
            <div id="gallery">

            </div>
        </div>
    </div>
    <hr>
    <h1 style="text-align: center">
        Icons
    </h1>
    <div class="row">
        <div class="col-md-6">  
                    @foreach ($icons as $icon)
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalIcons{{$icon->id}}">
                        <img src="{{asset('storage/'.$icon->path)}}" class="icon" alt="{{$icon->path}}">
                    </button>
                    

                    <div id="modalIcons{{$icon->id}}" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit or Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('icons.update',$icon->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{asset('storage/'.$icon->path)}}" class="icon" alt="{{$icon->path}}">
                                            <div class="input-group mb-3">
                                                <input type="file" name="path" class="form-control" id="inputGroupFile02">
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <label for="name">Name:</label>
                                                    <input type="text" name="name"class="form-control" value="{{$icon->name}}" required>
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug"class="form-control" value="{{$icon->slug}}" required>
                                                <hr>
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <div class="row">
                                <form action="{{route('icons.delete',$icon->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                           </div>   
                            <div class="modal-footer">
                            </div>
                          </div>
                        </div>
                      </div>
                                                     
                    @endforeach
        </div>
        <div class="col-md-6">
            <form action="{{route('icons.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="file" name="path" required class="form-control" id="inputGroupFile03">
                    <label class="input-group-text" for="inputGroupFile03">Upload</label>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" required>  
                </div> 
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="slug" placeholder="Slug" required>  
                </div> 
                <hr>
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
    <hr>
    <a href="{{route('home')}}" type="button" class="btn btn-primary">Back</a>
</div>

@endsection

@section('script')
    <script>
$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        $('div#gallery').empty();
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).css('max-width','100%');
                    
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#inputGroupFile02').on('change', function() {
        imagesPreview(this, 'div#gallery');
        
    });
});

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        $('div#gallery-edit').empty();
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).css('max-width','100%');
                    
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#inputGroupFile01').on('change', function() {
        imagesPreview(this, 'div#gallery-edit');
        
    });
});
$(document).ready(function(){
    var count = $('#count').val();
    for(i=0;i < count; i++){
        var value = $('#select' + i).val();
        $('.collapse #purpose' + i + ' option[value="'+value+'"]').attr('selected',true);
    }
})
    </script>
@endsection