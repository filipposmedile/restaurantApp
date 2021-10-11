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
    </style>
@endsection

@section('content')
<div class="container">
    <h1 style="text-align: center">Categories</h1>
    <hr class="bar-black">
    <ul style="list-style: none">
        @foreach ($categories as $category)
            <li class="list" >
                <div class="row">
                    <div class="col-md-9">
                        <div style="overflow: hidden;text-align:center">
                            <a type="button" href="#products{{$category->id}}" data-toggle="collapse" class="button-collapse">{{$category->name}}</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('product.add',$category)}}" type="button" class="btn btn-success">Manage Products</a>
                    </div>
                </div>
                
            </li>
            <div class="collapse" id="products{{$category->id}}">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </ul>
    <hr class="black-bar">
    <a href="{{route('home')}}" type="button" class="btn btn-primary">Back</a>
</div>


@endsection
