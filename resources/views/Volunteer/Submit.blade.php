@extends('layouts.Volunteer')

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
          <h3 class="box-title">ADD LOCATION</h3>
        </div>
        <form role="form" action="{{action('VolunteerController@saveLocation')}}" method="POST" enctype="multipart/form-data" >
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
                <input type="text" class="form-control" name="title"  placeholder="Title">
              </div>

            <div class="col-xs-3">
              <label for="exampleInputEmail1">City</label>
              <input type="text" class="form-control" name="city" placeholder="City">
            </div>

            <div class="col-xs-2">
              <label for="exampleInputEmail1">Level</label>
              <select class="form-control" name="level">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>

          </div>
          <br>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea rows="5" class="form-control" name="description" placeholder="Description"></textarea >
            </div>
            <br>
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" name="image_url" id="exampleInputFile">
            </div>

            <div class="row">
              <div class="col-xs-3">
                <label>Latitude</label>
                <input type="text" name="lat" id="lat" class="form-control" value="{{ old('lat') }}" readonly>
              </div>
            <div class="col-xs-3">
              <label for="exampleInputEmail1">Longitude</label>
              <input type="text" name="lng" id="lng" class="form-control" value="{{ old('lng') }}" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Map</label>
            <div id="map" style="height: 500px; width: 100%;"></div>
          </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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
              center: {lat: 6.9271, lng: 79.8612},
              zoom: 13
          });
          var marker = new google.maps.Marker({
              position: {
                  lat: 6.9271,
                  lng: 79.8612
              },
              map: map,
              draggable: true
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
