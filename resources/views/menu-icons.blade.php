<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$setup->name}}</title>
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
                width: 100%;
                height: 150px;
                background-position: center;
                background-size: cover;
                border-bottom: 1px solid lightgray;
                margin-bottom:20px;
            }
            
            .colored-button{
                border: 3px solid black;
                padding: 10px 20px;
                color: black;
                border-radius: 10px;
                transition: 0.4s;
                box-shadow: 0 0 10px #FF0063;
            }
            .colored-button:hover{
                background-color: #FF0063;
                text-decoration: none;
                color: white;
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
                margin-top:20px;
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
                .tableProducts{
                    width: 100%;
                }
                tr:nth-child(even){
                    background-color: #ff00622f;
                }
                .productCell{
                    width: 90%;
                }
                .productName{
                    margin-left: 20px;
                    font-size: 1rem;
                    font-weight: bold;
                }
                .productDescription{
                    padding-top: 0;
                    margin: 20px;
                    margin-top:-15px;
                    font-size: 16px;
                    font-style: italic;
                }
                .productPrice{
                    font-weight: bold;
                    margin: 20px;
                }
                .iconBox{
                    margin:15px;
                    width: 130px;
                    min-height: 160px;
                    box-shadow: 0px 0px 15px #FF0063;
                    border: 2px solid black;
                    border-radius: 10px;
                    transition: 0.5s;
                    color: black;
                }
                .iconBox:hover{
                    transform: translateY(-20px);
                }
                .img-box{
                min-width: 100%;
                min-height: 100%;
                filter: invert(13%) sepia(69%) saturate(7489%) hue-rotate(331deg) brightness(101%) contrast(104%);
            }
            .buttonIcon{
                width: 130px;
                height: 130px;
                padding: 10px;
            }
            .categoryName{
                width: 100%;
                text-align: center;
                font-weight: bold;
            }
            .flexBox{
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
            .modal-content{
                background: linear-gradient(to right, lightgray, #c0c0c0);
            }
            .modal-body{
                padding: 0 !important;
            }
            .modal-title{
                font-weight: bold;
                text-align: center;
            }
            @media(max-width:500px){
                .masonry{
                    column-count: 1;
                }
                .iconBox{
                width: 100px;
                min-height: 130px;
            }
            .buttonIcon{
                width: 100px;
                height: 100px;
            }
            .categoryName{
                font-size: 14px;
            }
            }
            tr{
                vertical-align: center;
            }
            
            </style>
    </head>
    <body style="background-image: url('{{asset('storage/'.$setup->backgroundUrl)}}');{{$setup->css.$setup->font}};color:#FF0063;">
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
                    <h1 style="text-align: center; font-family:Fressia;font-size:48px;">Menú</h2>
                        <br>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>

        
    
        <div>
        <div class="container flexBox">
            @foreach ($categories as $category)
                    <div class="iconBox">
                        <a type="button" class="buttonIcon" data-toggle="modal" data-target="#modalIcons{{$category->id}}">
                            @if ($category->icon_id)
                                <img class="img-box" src="{{asset('storage/'.$category->icon->path)}}">
                                
                            @endif
                            <p class="categoryName">{{$category->name}}</p>
                        </a>
                        
                                     
                    </div> 
                        <div id="modalIcons{{$category->id}}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                   
                                            <h5 class="modal-title">{{$category->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                <div class="modal-body">
                                    @if ($category->img_path)
                                    <div class="category-img" style="background-image: url({{asset('storage/'.$category->img_path)}}"></div>
                                    @endif
                                    <table class="tableProducts">
                                        <tr class="productRow">
                                            <th>
                                                <p style="margin-left:20px;">
                                                    Name
                                                </p>
                                            </th>
                                            <th>
                                                <p>Price</p>
                                            </th>
                                        </tr>
                                        @foreach ($category->products as $product)
                                        <tr>
                                            <td class="prductCell">
                                                <p class="productName" @if ($product->description)
                                                    style="margin-top:20px;"
                                                @endif>{{$product->name}}</p>
                                                <p class="productDescription">{{$product->description}}</p>
                                            </td>
                                            <td>
                                                <p class="productPrice">{{$product->price}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    
                                
                               </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
        
                        
                          <div class="bottom-div">
                            <a target="_blank" href="{{'http://'.$setup->websiteUrl}}" type="button" class="colored-button">Pagina Principale</a>

                        </div>
                
               
        </div>       
        
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $("tr.prodotto:odd").css({"background-color":"#FF80AE", "color":"gray"});
        </script>
    </body>
</html>
