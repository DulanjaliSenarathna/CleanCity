@extends('layouts.blog')

@section('content')

        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h2>Garbage Spots</h2>
						<div class="page_link">
							<a href="{{url('/')}}">Home</a>
							<a >Garbage Spots</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Contact Area =================-->
        <section style="width:100%;" class="contact_area p_120">
            <div class="container">

                <div class="mapBox">

                  <div style="height:100%; width:100%;" id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: 6.915729, lng: 79.863579};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: myLatLng
        });
        @foreach($location as $row)
        var marker{{$row->id}} = new google.maps.Marker({
            position: {
                lat: {{$row->lat}},
                lng: {{$row->lng}}
            },
            map: map,
            draggable: false,
            title: 'Garbage Spot :{{$row->id}} '
        });
        @endforeach
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMjwyKg-mHUw2I6fNvJm3NrlxF_hBYS_M&callback=initMap">
    </script>

                </div>





            </div>
        </section>

        <!--================Contact Area =================-->

        @endsection
