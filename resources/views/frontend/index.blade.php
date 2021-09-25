@include('frontend.header')
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Kora</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="{{route('f.index')}}">Tattoo Express</a> 

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{route('f.index')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="btn-solid-sm page-scroll" href="{{route('f.signup')}}">Check Your Tattoo, It's Free</a>
                </span>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header" style="padding-bottom: 0px; overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="text-container" style="margin-top: 0;">
                        <h1 class="h1-large">Ready To Get Your Tattoo Photo?</h1>
                        <p class="p-large">Just upload your face and select your tattoo and check the view with the tattoo on your face.</p>
                        <a class="btn-solid-lg" href="{{route('f.signup')}}">Just Check, It's Free</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('public/') }}/images/tattooface.jpg" alt="alternative" style="border-top-left-radius: 50%;border-top-right-radius: 50%;">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->
    @include('frontend.footer')

 