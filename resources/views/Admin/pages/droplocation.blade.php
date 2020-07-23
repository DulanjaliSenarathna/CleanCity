@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Drop Locations
        <small>All Location That You have Put Rubbish</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Drop Locations</li>
        <li class="active">Add Drop Location</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Locations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>

        </div>
        <div class="box-body" style="height: 100%;">

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

          <form role="form" action="{{action('AdminController@savespot')}}" method="POST" enctype="multipart/form-data" >
            @csrf


            <div class="box-body">
              <div class="row">
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


          <!-- <div id="message">Location saved</div> -->
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



        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    @endsection
