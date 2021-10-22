<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$setup->name}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel = "icon" href ="{{asset('storage/'.$setup->logoUrl)}}" type = "image/x-icon"> 
        <link rel="stylesheet" href="{{asset('css/mobile.css')}}">
        <link rel="stylesheet" href="{{asset('css/tablet.css')}}">
        <link rel="stylesheet" href="{{asset('css/desktop.css')}}">

        <!-- Styles -->
        <style type="text/css">
      
        </style>
    </head>
    <body>
        <header>
            <div class="header-div" style="float: left">
                <p class="header-a-link">
                    Ritrovo Smedile
                </p>
            </div>            
            <div class="header-div" style="float: right">
                <a href="https://www.instagram.com/ritrovosmedile/?hl=en" class="header-a-link">
                    <img src="{{asset('storage/images/instagram.svg')}}" class="header-img-icon" alt="instagram">
                </a>
                <a href="tel:‎+39 339 156 7044" class="header-a-link">
                    <img src="{{asset('storage/images/Icons/Catering/phone.svg')}}" class="header-img-icon" alt="phone">
                </a>
            </div>
        </header>

    <div class="div-desktop-container">
        <div class="div-desktop">

        
         <!-- LOGO & ICONS BLOCK -->  
        <div class="div-main">
            <img src="{{asset('storage/'.$setup->logoUrl)}}" class="img-logo" alt="">
        </div>
        <div class="div-text">
            <img src="{{asset('storage/images/Icons/icecream.svg')}}" class="img-icon" alt="">
            <img src="{{asset('storage/images/Icons/hotdog.svg')}}" class="img-icon" alt="">
            <img src="{{asset('storage/images/Icons/coffee.svg')}}" class="img-icon" alt="">
        </div>

         <!-- MENU BLOCK -->   
        <div class="div-color-1" id="menu">
            <a href="{{route('menu')}}" class="a-menu">
                <span class="span-menu">MENU</span>
            </a>
        </div>

         
        <!-- IMAGES CAROUSEL and GRID -->
        @if (count($images) > 0)    
        <div class="container">
            <div class="div-no-color">
                <h1 class="h1-text">Galleria</h1>
            </div>
            <div id="images-grid">
                @foreach ($images as $image)
                    @if ($image->purpose == 'homepage')
                        <a type="button" onclick="grid({{$image->id}})" class="a-grid">
                            <img src="{{asset('storage/'.$image->path)}}" alt="{{$image->name}}" class="img-grid img-thumbnail">
                        </a>
                        <div class="image-show" onclick="imageDisappear()" id="div-img-{{$image->id}}">
                            <img src="{{asset('storage/'.$image->path)}}" alt="{{$image->name}}" class="img-full">
                        </div>
                    @endif
                @endforeach
            </div>
        </div> 
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($images as $image)
                        @if ($image->purpose == 'homepage')
                        <div class="carousel-item @if($loop->first) active @endif">
                            <img src="{{asset('storage/'.$image->path)}}" class="d-block w-100 carousel-img" alt="{{$image->name}}">
                          </div>
                        @endif
                    @endforeach
                </div>
            </div>  
        @endif

        <!-- GOOGLE MAP -->
        <div class="container">
            <div class="div-no-color">
                <h1 class="h1-text">Indirizzo</h1>
            </div>
            <div id="div-google-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3134.714420423606!2d15.552089615601902!3d38.21652639439282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13144db66dc9c89d%3A0x113df2b68af0fcbb!2sChiosco%20Bar%20Ritrovo%20Smedile!5e0!3m2!1sit!2suk!4v1634742971808!5m2!1sit!2suk"
                id="googleMap" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>  

        <!-- OPENING TIME-->

        @if ($setup->openingTime)
            <div class="div-no-color">
                <h1 class="h1-text">
                    Orari di Apertura
                </h1>
                <div class="container">
                    <div class="text2" style="white-space: pre-line">
                        {{$setup->openingTime}}
                    </div>
                </div>
            </div>
        @endif
        
        </div>
    
        <!-- FOOTER -->
        <div class="div-color-2b">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h1 class="text">
                            Ritrovo Smedile
                        </h1>
                    </div>
                    <div class="col-md-4">
                        <ul style="list-style: none; margin-left:-30px;" class="text2">
                            <li>Gelati</li>
                            <li>Granite</li>
                            <li>Panini</li>
                            <li>Caffetteria</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul style="list-style: none; margin-left:-30px;" class="text2">
                            <li>Piazza XXV Aprile, 98168 Messina ME, Italia</li>
                            <li><a href="tel:‎+39 339 156 7044" class="footer-a">‎+39 339 156 7044</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>   
    </div>
        

        <!--LOADER-->
        <div id="page-loader">
            <div id="div-loader">

            </div>
        </div>
        <div id="page-loader-2">
            <div id="div-loader-logo" style="background-image: url({{asset('storage/'.$setup->logoUrl)}})">
                
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="{{asset('js/mobile.js')}}" defer></script>
        <script type="text/javascript">
        </script>
    </body>
</html>
