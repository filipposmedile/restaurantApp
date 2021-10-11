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
    </style>
@endsection

@section('content')
<div class="container">
    <h1 style="text-align: center">Welcome to your dashboard</h1>
    <hr class="bar-black">
    <div class="row" style="margin: 100px auto">
        <div class="col-md-6 d-flex justify-content-center">
            <a href="{{route('categories')}}" type="button" class="button-text">Categories<br><br>
                <img src="{{asset('storage/images/categories.svg')}}" class="button-img" alt="">
            </a>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <a href="{{route('products')}}" type="button" class="button-text">Products<br><br>
                <img src="{{asset('storage/images/products.svg')}}" class="button-img" alt="">
            </a>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <a href="{{route('pictures')}}" type="button" class="button-text">Pictures<br><br>
                <img src="{{asset('storage/images/pictures.svg')}}" class="button-img" alt="">
            </a>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <a href="{{route('setup')}}" type="button" class="button-text">Settings<br><br>
                <img src="{{asset('storage/images/setup.svg')}}" class="button-img" alt="">
            </a>
        </div>
    </div>
    
</div>
@endsection

@section('script')
@endsection