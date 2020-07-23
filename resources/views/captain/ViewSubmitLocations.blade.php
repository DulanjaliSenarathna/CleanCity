@extends('layouts.captain')

@section('content')
<section class="content-header">
  <h1>
    Submit Loactions
  </h1>


</section>
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">ADD LOCATION </h3>
        </div>
        <form role="form" action="{{action('VolunteerController@updateLocation')}}" method="POST" enctype="multipart/form-data" >
          @csrf

          @if (count($errors) > 0)
            <div style="padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem;
              color:#721c24;background-color:#f8d7da;border-color:#f5c6cb;">
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

          <div class="box-body">
            <div class="row">


              <div class="col-xs-4">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$profile->name}}" readonly >
              </div>

            <div class="col-xs-8">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" name="email" value="{{$profile->email}}"  readonly>
            </div>

          </div>
          <br>
            <div class="row">

              <div class="col-xs-7">
                <label for="exampleInputPassword1">Title</label>
                <input type="text" class="form-control" name="title" value="{{$location->title}}" readonly>
              </div>

            <div class="col-xs-3">
              <label for="exampleInputEmail1">City</label>
              <input type="text" class="form-control" name="city" value="{{$location->city}}" readonly>
            </div>

            <div class="col-xs-2">
              <label for="exampleInputEmail1">Level</label>
              <input class="form-control" name="level" value="{{$location->level}}" readonly>
              </select>
            </div>

          </div>
          <br>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea rows="5" class="form-control" name="description" readonly>{{$location->description}}</textarea >
            </div>
            <br>

            <div class="form-group">
              <img style="height:200px;" src="{{$location->image_url}}" alt="">
            </div>

            <div class="row">
              <div class="col-xs-3">
                <label>Latitude</label>
                <input type="text" name="lat" id="lat" class="form-control" value="{{$location->lat}}" readonly>
              </div>
            <div class="col-xs-3">
              <label for="exampleInputEmail1">Longitude</label>
              <input type="text" name="lng" id="lng" class="form-control" value="{{$location->lng}}" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Map</label>
            <div id="map" style="height: 500px; width: 100%;"></div>
          </div>
          </div>

          <!-- /.box-body -->

          <div class="box-footer">
            @if($location->job_status===1)

            @if($location->verified_status===0)
              <a  class="btn btn-danger" >Not Verified</a>
            @elseif($location->verified_status===1)
              <a  class="btn btn-success disabled">&nbsp &nbsp Verified &nbsp &nbsp</a>
            @endif</td>

            @elseif($location->job_status===0)

            @if($location->verified_status===0)
              <a href="../Verifiedlocationcaptain/{{$location->id}}" class="btn btn-danger" >Not Verified</a>
            @elseif($location->verified_status===1)
              <a href="../NotVerifiedlocationcaptain/{{$location->id}}" class="btn btn-success">&nbsp &nbsp Verified &nbsp &nbsp</a>
            @endif
            @endif

            @if($location->job_status===0)
              <a data-toggle="modal" data-target="#modal-danger" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
            @elseif($location->job_status===1)
              <a class="btn btn-danger disabled" ><i class="fa fa-trash" ></i></a>
            @endif
          </div>


          <div class="modal modal-danger fade" id="modal-danger">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Delete Location</h4>
                </div>
                <div class="modal-body">
                  <p>Are You Sure the Delete This Location?&hellip;</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                  <a href="../deletelocationcaptainRedirectAllLocation/{{$location->id}}" type="button" class="btn btn-outline">Yes I want Delete</a>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </form>

      </div>
      <!-- /.box -->

    </div>
    <!--/.col (left) -->

    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>




<script>
      var map;
      function initAutocomplete(){
          console.log(document.getElementById('map'));
          map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: {{$location->lat}}, lng: {{$location->lng}}},
              zoom: 13
          });
          var marker = new google.maps.Marker({
              position: {
                  lat: {{$location->lat}},
                  lng: {{$location->lng}}
              },
              map: map,
              draggable: false
          });
//            document.getElementById('lat').value = marker.getPosition().lat();
//            document.getElementById('lng').value = marker.getPosition().lng();
          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          google.maps.event.addListener(searchBox, 'places_changed',function(){
              var places = searchBox.getPlaces();
              var bounds = new google.maps.LatLngBounds();
              var i, place;
              for (i=0; place=places[i]; i++) {
                  bounds.extend(place.geometry.location);
                  marker.setPosition(place.geometry.location);
              }
              map.fitBounds(bounds);
              map.setZoom(15);
          });
          google.maps.event.addListener(marker, 'position_changed', function(){
              var lat = marker.getPosition().lat();
              var lng = marker.getPosition().lng();
              document.getElementById('lat').value = lat;
              document.getElementById('lng').value = lng;
          });
      }
  </script>

</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMjwyKg-mHUw2I6fNvJm3NrlxF_hBYS_M&libraries=places&callback=initAutocomplete"
          async defer></script>
@endsection
