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
            margin: 10px auto;
            box-shadow: 0 0 10px gray;
        }
       table{
           width: 100%;
       }
        td{
            text-align: center;
            font-size: 130%;
        }
        .img{
            max-width: 100%;
            max-height: 300px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h1 style="text-align: center">Add Products to category "{{$category->name}}"</h1>
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
        <div class="col-md-7">
                @foreach ($category->products as $product)
                <form action="{{route('product.update',$product->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <div class="input-group mb-3">                                            
                                            <input type="text" class="form-control" name="name" value="{{$product->name}}">  
                                        </div>  
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <div class="input-group mb-3">
                                            <input type="number" step=".01" class="form-control" name="price" value="{{$product->price}}">  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-select" id="category_id">
                                            <option value="">Change Category</option>
                                            @foreach ($categories as $categorySub)
                                                <option value="{{$categorySub->id}}" @if ($categorySub->id == $product->category_id)
                                                    selected
                                                @endif>{{$categorySub->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                Current Image:
                                <img src="{{asset('storage/'.$product->img_path)}}" class="img" alt="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success" value="Update"> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" style="resize: none" rows="3">{{$product->description}}</textarea>  
                                New Image:
                                <div class="input-group mb-3">
                                    <input type="file" name="images" class="form-control" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>     
                                <input type="checkbox" name="no_img" class="btn-check" id="btn-check-outlined{{$category->id}}" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btn-check-outlined{{$category->id}}">No Image</label><br>
                                <label for="message">Message for the Homepage:</label>
                                <textarea name="message" id="message" class="form-control" style="resize: none" rows="3">{{$product->message}}</textarea>       
                                <label for="homeUse">Use for the Homepage</label>
                                <select name="homeUse" class="form-select" id="homeUse">
                                    <option value="none" @if ($product->homeUse == 'none')  selected  @endif>None</option>
                                    <option value="New" @if ($product->homeUse == 'New')  selected  @endif>New</option>
                                    <option value="Offer" @if ($product->homeUse == 'Offer')  selected  @endif>Offer</option>
                                </select>   
                            </div>
                        </div>
                </form>   
                <form action="{{route('product.delete',$product->id)}}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete" style="margin:5px auto;">
                </form> 
                <hr>                
                @endforeach
        </div>
        <div class="col-md-5">
            <form action="{{route('product.store',$category->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                <label for="name">Name:</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" required>
                </div>
                <label for="name">Price:</label>
                <div class="input-group mb-3">
                    <input type="number" step=".01" class="form-control" name="price" required>
                </div>
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" style="resize: none" rows="3"></textarea>    
                <br>
                <div class="input-group mb-3">
                    <input type="file" name="images" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>   
                <label for="message">Message for the Homepage:</label>
                <textarea name="message" id="message" class="form-control" style="resize: none" rows="3"></textarea>       
                <label for="homeUse">Use for the Homepage</label>
                <select name="homeUse" class="form-select" id="homeUse">
                    <option value="none" selected>None</option>
                    <option value="New">New</option>
                    <option value="Offer">Offer</option>
                </select>            
                <br>                 
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
    <hr class="black-bar">
    <a href="{{route('products')}}" type="button" class="btn btn-primary">Back</a>
</div>
@endsection