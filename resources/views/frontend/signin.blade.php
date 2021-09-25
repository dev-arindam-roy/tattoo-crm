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
                    <a class="btn-solid-sm page-scroll" href="{{route('f.signup')}}">Signup</a>
                </span>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <h1 class="text-center">Sign In</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
    <!-- end of header -->
    
    
    <!-- Basic -->
    <div class="ex-form-1 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="text-box mt-5 mb-5">
                        <p class="mb-4">Create Account? Then just <a class="blue" href="{{route('f.signup')}}">Sign Up</a></p>

                        <!-- Sign Up Form -->
                        <form id="signUpForm" action="{{route('f.signin.post')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="email" name="email" class="form-control-input notEmpty" id="email" required>
                                <label class="label-control" for="email">Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control-input notEmpty" id="password" required>
                                <label class="label-control" for="password">Password</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">Sign In</button>
                            </div>
                        </form>
                        <!-- end of sign up form -->

                    </div> <!-- end of text-box -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of ex-basic-1 -->
    <!-- end of basic -->
    @include('frontend.footer')