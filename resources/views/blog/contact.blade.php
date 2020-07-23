@extends('layouts.blog')

@section('content')

        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h2>Contact Us</h2>
						<div class="page_link">
							<a href="{{url('/')}}">Home</a>
							<a >Contact</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Contact Area =================-->
        <section class="contact_area p_120">
            <div class="container">

                <div class="mapBox">

                  <div style="height:100%;" id="map"></div>

    <script>
      function initMap() {
        var myLatLng = {lat: 6.915729, lng: 79.863579};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Colombo Municipal Council, Dr C.W.W Kannangara Mawatha, Colombo 07'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMjwyKg-mHUw2I6fNvJm3NrlxF_hBYS_M&callback=initMap">
    </script>

                </div>




                <div class="row">
                    <div class="col-lg-3">
                        <div class="contact_info">
                            <div class="info_item">
                                <i class="lnr lnr-home"></i>
                                <h6>Colombo Municipal Council</h6>
                                <p>Dr C.W.W Kannangara Mawatha,Colombo 07</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-phone-handset"></i>
                                <h6><a>(011) 2684290 </a></h6>
                                <p>Mon to Fri 9am to 5 pm</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-envelope"></i>
                                <h6><a>cmcscs@cmb.lk</a></h6>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                      @if (count($errors) > 0)
                        <div class="alert alert-danger" >
                        <strong>Whoops!</strong> There were some problems with your input.<br>
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      @if (session('status'))
                        <div class="alert alert-success">
                          {{ session('status') }}
                        </div>
                      @endif

                        <form class="row contact_form" action="{{action('ContactController@contactSave')}}" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="name" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control"  name="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="subject" placeholder="Enter Subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message"  rows="1" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" value="submit" class="btn submit_btn">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!--================Contact Area =================-->

        @endsection
