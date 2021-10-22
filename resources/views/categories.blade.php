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
            margin-top: 15px;
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
            margin: 10px auto;
            box-shadow: 0 0 10px gray;
        }
        .icon{
            width: 80px;
            height: 80px;
            margin: 2px;
        }
        .icon2{
            width: 80px;
            height: 80px;
            margin: 2px;
        }
        .icon-button{
            border: 2px solid black;
            border-radius: 5px;
            outline: none;
            background: none;
            margin: 3px;
        }
        .icon-button:hover{
            background-color: lightgray;
        }
        .iconPreview{
            width: 100px;
            height: 100px;
        }
        #icon-preview{
            width: 100px;
            height: 100px;
        }
        .icon-preview{
            width: 100px;
            height: 100px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h1 style="text-align: center">Categories</h1>
    <hr class="bar-black">
    <div class="row">
        <div class="col-md-5">
            <p style="padding-top:5px;font-size:20px;">Search</p>
        

            <input type="text" class="form-control" id="search">

        </div>
        
    </div>
    <br>
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
        <div class="col-md-6">
            <ul style="list-style: none">
                @foreach ($categories as $category)
                    <form action="{{route('category.delete',$category->id)}}" id="{{$category->name}}" class="category-form" method="post">
                        @csrf
                        @method('DELETE')
                        <li class="list">
                            <div class="row">
                                <div class="col-md-8">
                                    <div style="overflow: hidden;">
                                        <a type="button" href="#edit{{$category->id}}" data-toggle="collapse" class="button-collapse">{{$category->name}}</a>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <button type="submit" class="delete-button">Delete</button>
                                </div>
                            </div>
                        </li>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('changeId',[$category->id,'categories'])}}" class="category-form" method="post">
                                @csrf
                                <input type="hidden" name="move" value="up">
                                <input type="hidden" name="ordine" value="{{$category->ordine}}">
                                <input type="submit" value="Move Down" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{route('changeId',[$category->id,'categories'])}}"  class="category-form"method="post">
                                @csrf
                                <input type="hidden" name="move" value="down">
                                <input type="hidden" name="ordine" value="{{$category->ordine}}">
                                <input type="submit" value="Move Up" class="btn btn-primary">
                            </form>
                        </div>
                    </div>    
                        <div id="edit{{$category->id}}" class="collapse">
                            <div class="collapse-sub">
                                <form action="{{route('category.edit',$category->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="name">Name:</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                            </div>
                                            <label for="description">Description:</label>
                                            <textarea name="description" id="description-edit" class="form-control" style="resize: none" rows="7">{{$category->description}}</textarea>                                        
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="margin: 0 auto;width:200px; height:220px;display:flex;flex-wrap:wrap; align-items:center;">
                                                <img src="{{asset('storage/'.$category->img_path)}}" class="img-list" alt="">                                            
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="file" name="images" class="form-control" id="inputGroupFile02">
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                              </div>
                                              <input type="checkbox" name="no_img" class="btn-check" id="btn-check-outlined{{$category->id}}" autocomplete="off">
                                              <label class="btn btn-outline-primary" for="btn-check-outlined{{$category->id}}">No Image</label><br>
                                              <label for="icon">Current Icon:</label>
                                            <br>
                                            
                                                @if ($category->icon)
                                                <img src="{{asset('storage/'.$category->icon->path)}}" id="actual-icon" alt="No Icon" class="icon" >
                                                @endif
                                                <hr>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIcons{{$category->id}}">Select an Icon</button>
                                               
                                                        
                                                        <input type="hidden" id="icon-new{{$category->id}}" name="path" value>
                                <hr>
                                                        <label for="icon">New Icon:</label>
                                                        <br>
                                                        <div id="icon-preview{{$category->id}}" class="icon-preview"></div>
                                
                                                <hr>
                                                <div id="modalIcons{{$category->id}}" class="modal fade" tabindex="-1">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title">Select an Icon</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($icons as $icon)
                                                                <button data-bs-dismiss="modal" class="icon-button"><img src="{{asset('storage/'.$icon->path)}}" id="icon{{$icon->id}}" onclick="iconSelect({{$category->id}} , {{$icon->id }})" class="icon2" alt=""></button>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                
                                                <input type="submit" value="Edit" class="btn btn-success">
                                        </div>
                                    </div>
                                            </form>
                                            <button onclick="removeIcon2({{$category->id}})"  style="margin-top:2px" id="buttonRemove" class="btn btn-warning">Remove new Icon</button>

                                        </div>
                                    </div>              
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Add a new category</h2>
            <hr class="black-bar">
            <form action="{{route('category.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name">

                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="descirption" style="resize: none" rows="7"></textarea>
                
                <label for="images">Attach an Image</label>
                <div class="input-group mb-3">
                    <input type="file" name="images" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
<hr>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIcons">Select an Icon</button>
               
                        
                        <input type="hidden" id="icon-new" name="icon" value>
<hr>
                        <label for="icon">New Icon:</label>
                        <br>
                        <div id="icon-preview"></div>

                <hr>
                <div id="modalIcons" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Select an Icon</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($icons as $icon)
                                <button data-bs-dismiss="modal" class="icon-button"><img src="{{asset('storage/'.$icon->path)}}" id="{{$icon->id}}" class="icon" alt=""></button>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>

                <input type="submit" class="btn btn-success">
            </form>
            <button onclick="removeIcon()" style="float: right" class="btn btn-warning">Remove new Icon</button>

        </div>
    </div>
    <hr class="black-bar">
    <a href="{{route('home')}}" type="button" class="btn btn-primary">Back</a>
</div>
@endsection

@section('script')
<script>
    $(document).on('click','.icon',function(){
        
        var link = $(this).attr('src');
        var id = $(this).attr('id');
        $('#icon-preview').css('background','url("'+link+'")');
        $('#icon-new').val(id);
    })
    function removeIcon(){
        $('#icon-preview').css('background','');

        $('#icon-new').val(undefined);
    }
    function iconSelect(x,icon){
        var link = $('#icon'+icon).attr('src');
        $('#icon-preview'+x).css('background','url("'+link+'")');
        $('#icon-new'+x).val(icon);
    }
    function removeIcon2(x){
        $('#icon-preview'+x).css('background','');

        $('#icon-new'+x).val(undefined);
    }
    $(document).on('input','#search',function(){
        var valore = $('#search').val().toLowerCase();
        const classes = document.querySelectorAll('.category-form');
        classes.forEach((classe)=>{
            if(classe.id.toLowerCase().includes(valore) == true){
                classe.style.display = 'block';
            } else {
                classe.style.display = 'none';
            }
        })
       if (valore == ""){
           $('.category-form').css('display','block');
       }
    })
</script>
@endsection