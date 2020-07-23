<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="blog/img/favicon.png" type="image/png">
        <title>CMCSCS | {{$title}}</title>
        <!-- Bootstrap CSS -->
        <link rel="icon" type="image/png" href="icon/favicon.ico"/>
        <link rel="stylesheet" href="{{asset('blog/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/linericon/style.css')}}">
        <link rel="stylesheet" href="{{asset('blog/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/lightbox/simpleLightbox.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/nice-select/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/animate-css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('blog/vendors/jquery-ui/jquery-ui.css')}}">
        <!-- main css -->
        <link rel="stylesheet" href="{{asset('blog/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('blog/css/responsive.css')}}">
    </head>
    <body>

        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="logo_part">
            	<div class="container">
            		<a class="logo" href="#"><img src="blog/img/logo2.png" alt=""></a>
            	</div>
            </div>
			<div class="main_menu">
				<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="index.html"><img src="blog/img/logo2.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav">
								<li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
								<li class="nav-item"><a class="nav-link" href="{{url('contact')}}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('spots')}}">Garbage Spots</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item"><a class="navbar-right nav-link" href="{{url('/login')}}">login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/register')}}">Signup</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
        </header>
        <!--================Header Menu Area =================-->

        @yield('content')

        <!--================ start footer Area  =================-->
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">About Us</h6>
                            <p>Colombo Municipal Council is planning to launch a web site to optimize garbage collection and
                              they provide some spots to the people and people can check that spots via the web
                              site and they can keep their garbages in there.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Newsletter</h6>
                            <p>Stay updated with our latest trends</p>

                                <form action="{{action('BlogController@Newsletter')}}" method="post" class="subscribe_form relative" enctype="multipart/form-data">
                                  @csrf
                                    <div class="input-group d-flex flex-row">
                                        <input name="email" placeholder="Email Address" required type="email">
                                        <button type="submit" class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                    <!-- <div class="mt-10 info"></div> -->

                                    @if (count($errors) > 0)
                                      <div style="color:white;" class="mt-10 danger">
                                      <strong>Whoops!</strong> There were some problems with your input.<br>
                                        <ul>
                                          @foreach ($errors->all() as $error)
                                            <li style="color:white;">{{ $error }}</li>
                                          @endforeach
                                        </ul>
                                      </div>
                                    @endif

                                    @if (session('status'))
                                      <div style="color:white;" class="mt-10 info">
                                        {{ session('status') }}
                                      </div>
                                    @endif
                                </form>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h6 class="footer_title">Recent Posts</h6>

                            <ul class="list instafeed d-flex flex-wrap">

                                @foreach($footer as $footer)
                                <li> <img style="width:58px;height:58px;" src="{{$footer->post_image}}"> </li>
                                @endforeach

                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget f_social_wd">
                            <h6 class="footer_title">Follow Us</h6>
                            <p>Let us be social</p>
                            <div class="f_social">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-12 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy; 2018-2019 <a href="www.cmcscs.lk">CMCSCS</a> All rights reserved
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </footer>
    <!--================ End footer Area  =================-->




        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('blog/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('blog/js/popper.js')}}"></script>
        <script src="{{asset('blog/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('blog/js/stellar.js')}}"></script>
        <script src="{{asset('blog/vendors/lightbox/simpleLightbox.min.js')}}"></script>
        <script src="{{asset('blog/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{asset('blog/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{asset('blog/vendors/isotope/isotope-min.js')}}"></script>
        <script src="{{asset('blog/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('blog/vendors/jquery-ui/jquery-ui.js')}}"></script>
        <script src="{{asset('blog/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('blog/js/mail-script.js')}}"></script>
        <script src="{{asset('blog/js/theme.js')}}"></script>



    </body>
</html>
