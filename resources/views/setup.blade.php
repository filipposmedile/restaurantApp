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
    <h1 style="text-align: center">Settings</h1>
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
        <form action="{{route('setup.save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="header">Header:</label>
                    <input type="text" class="form-control" name="header" value="@isset($setup->header){{$setup->header}} @endisset" >    
                </div>
                <div class="col-md-6">                    
                    <label for="logo_path">Logo:</label>
                    <div class="input-group mb-3">
                        <input type="file" name="logoUrl" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                        @isset($setup->logoUrl)
                            <p>
                                Actual Logo:
                            </p>
                            <img src="{{asset('storage/'.$setup->logoUrl)}}" style="width: 300px;height:auto;" alt="logo">
                        @endisset
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="telephone">Sub Header:</label>
                    <input type="text" class="form-control" name="subHeader" value="@isset($setup->subHeader){{$setup->subHeader}}@endisset">
                </div>
                <div class="col-md-6">
                    <label for="backgroundUrl">Background:</label>
                    <div class="input-group mb-3">
                        <input type="file" name="backgroundUrl" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                        <br>
                        @isset($setup->backgroundUrl)
                            <p>
                                Actual Background:
                            </p>
                            <img src="{{asset('storage/'.$setup->backgroundUrl)}}" style="width: 300px;height:auto" alt="logo">
                        @endisset
                        <br>
                        <label for="css" class="label-text">CSS (only for webmaster):</label>
                        <hr>
                        <textarea name="css"  class="form-control" id="terms" cols="50" rows="3" style="resize: none">@isset($setup->css){{$setup->css}}@endisset</textarea>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="websiteUrl">Website URL:</label>
                    <input type="text" class="form-control" name="websiteUrl" value="@isset($setup->websiteUrl){{$setup->websiteUrl}}@endisset" required>        
                </div>
                <div class="col-md-2">
                    <label for="dCurrency">Columns (between 1-3):</label>
                    <input type="number" step="1" min="1" max="3" class="form-control" name="columns" value="@isset($setup->columns){{$setup->columns}}@endisset">        
                </div>
                <div class="col-md-6">
                    <label for="font">Font CSS (only for webmaster):</label>
                    <hr>
                    <textarea name="font"  class="form-control" id="font" cols="50" rows="3" style="resize: none">@isset($setup->font){{$setup->font}}@endisset</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type="submit" style="margin-top: 5px" class="btn btn-success" value="Save">
                </div>
            </div>
        </form>     
        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <form action="{{route('setup.deleteLogoBackground')}}" method="post">
                    @csrf
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="logo" type="checkbox" id="flexSwitchCheckChecked2">
                            <label class="form-check-label" for="flexSwitchCheckChecked2">Delete Logo</label>
                        </div>    
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="background" type="checkbox" id="flexSwitchCheckChecked2">
                            <label class="form-check-label" for="flexSwitchCheckChecked2">Delete Background</label>
                        </div>    
                        <input type="submit" style="margin-top: 5px" class="btn btn-success" value="Submit">
                </form> 
            </div>
        </div>
        <hr>
        <a href="{{route('home')}}" type="button" class="btn btn-primary">Back</a>
</div>
@endsection