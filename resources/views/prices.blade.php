<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Scialaj</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel = "icon" href ="{{asset('storage/'.$setup->logoUrl)}}" type = "image/x-icon"> 

        <!-- Styles -->
        <style type="text/css">
        
            @font-face { 
            font-family: Fressia; src: url('fonts/Fressia.ttf');
         }
         @font-face { 
            font-family: HappyMarker; src: url('fonts/HappyMarker.ttf');
         }  
         @font-face { 
		font-family: 'comic sans MS'; src: url('../fonts/ComicSansMS.ttf');
	}  
    .text-style{
        font-size: 20px;
    }
            #main-logo{
                width: 300px;
                min-height: auto;
                text-align: center;
            }
            .img-logo-container{
                padding: 70px 0;
                width: 100%;
                text-align: center;
            }
            .bar-colored{
                height: 1px;
                background-color: gray;
            }
            
            .categoria{
                text-align: left;
            }
            .bordo{

                border-bottom:3px solid gray;
            }
            .category-img{
                max-width: 100px;
                min-width: 50px;
                min-height: 50px;
            }
            .img-box{
                width: 100%;
                height: 150px;
                border-top: 2px solid black;
                background-size: cover;
                background-position: center;
            }
            .colored-button{
                background-color: white;
                border: 3px solid black;
                padding: 10px 20px;
                color: black;
                border-radius: 10px;
            }
            .colored-button:hover{
                background-color: gray;
                text-decoration: none;
                color: black;
            }
            .bottom-div{
                width: 100%;
                padding: 50px;
                display: flex;
                justify-content: center;
                align-content: center;
                align-items: center;
            }
            .text-description{
                font-style: italic;
                color: black;
                margin-top: -10px;
                margin-left:20px;
                margin-right:20px;
            }
            table{
                color: black !important;
            }
            .block-title{
                margin-bottom:15px;
                border: 2px solid black;
                box-shadow: 0 0 15px rgb(145, 145, 145);
            }
            .title-category{
                color: black;
                font-size: 24px;
                margin:20px;
            }
            .title-category:hover{
                text-decoration: none;
                color: rgb(77, 77, 77);
            }
            .button-category{
                color: black;
                border: 2px solid black;
                font-size: 24px;
            }
            .button-category:hover{
                text-decoration: none;
                color: black;
                background-color: lightgray;
            }
            .masonry{
                    column-count: 2;
                }
            @media(max-width:768px){
                .masonry{
                    column-count: 1;
                }
            }
            </style>
    </head>
    <body style="background-image: url('{{asset('storage/'.$setup->backgroundUrl)}}');{{$setup->css.$setup->font}}">
        <div class="container">
            <div class="img-logo-container">
                <img src="{{asset('storage/'.$setup->logoUrl)}}" id="main-logo">
                @if ($setup->header)
                    <h1>{{$setup->header}}</h1>
                @endif
                @if ($setup->subHeader)
                    <h2>{{$setup->subHeader}}</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <h1 style="text-align: center">Menú</h2>
                        <br>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>

        
    
        <div>
            <div class="masonry" style="column-gap:25px">
                
            @foreach ($categories as $category)
                <div style="display:inline-block;width:100%;">
                    <div class="block-title">

                    
                        <div class="row">
                            <div class="col-md-12">
                                <a type="button" href="#edit{{$category->id}}" data-toggle="collapse" class="button-collapse title-category">{{$category->name}}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($category->description)
                                <p class="text-description">
                                    {{$category->description}}
                                </p>
                                @endif
                            
                            </div>
                        </div>
                        @if ($category->img_path)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="img-box" style="background-image: url('{{asset('storage/'.$category->img_path)}}')">

                                    </div>                                
                                </div>
                            </div>
                        @endif
                    </div>
                        <div id="edit{{$category->id}}" class="collapse" style="margin-bottom: 15px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col" style="text-align: right">Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->products as $product)
                                    <tr>
                                        <td class="text-style">{{$product->name}} <br>
                                            <span style="font-size: 14px;font-style:italic;">{{$product->description}}</span></td>
                                        <td style="font-weight: bold; width:30%;text-align:right">€ {{$product->price}}</td>
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <a type="button" href="#edit{{$category->id}}" data-toggle="collapse" class="button-collapse button-category" style="width:100%;text-align:center;">Chiudi</a>
                    </div>
            </div>
            
            @endforeach
            </div> 
        </div>
    </div> 
        
                        <div class="bottom-div">
                            <a target="_blank" href="{{'http://'.$setup->websiteUrl}}" type="button" class="colored-button">Pagina Principale</a>

                        </div>
                    
        
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $("tr.prodotto:odd").css({"background-color":"#FF80AE", "color":"gray"});
        </script>
    </body>
</html>
