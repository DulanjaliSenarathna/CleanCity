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

        <div  class="form-group">
          <div id="map" style="height: 550px; width: 100%;"></div>
        </div>



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

          @foreach($location as $row)

          var con{{$row->id}}=  '<div>'+
                                '<div><img style="height:100px;" src="{{$row->image_url}}"></div>'+
                                '<div><h4>{!! substr(strip_tags($row->title), 0, 20) !!}'+
                                '@if (strlen(strip_tags($row->title)) > 20)...@endif</h4></div>'+
                                '<h5>{!! substr(strip_tags($row->description), 0, 50) !!}'+
                                  '@if (strlen(strip_tags($row->description)) > 50)...@endif</h5>'+
                                  '<br>'+
                                '  @if($row->verified_status===0)'+
                                    '<a  class="btn btn-danger" >Not Verified</a>'+
                                  '@elseif($row->verified_status===1)'+
                                    '<a  class="btn btn-success">&nbsp &nbsp Verified &nbsp &nbsp</a>'+
                                '  @endif</td>'+
                                '&nbsp'+
                                '@if($row->level==='low')'+
                                  '<a  class="btn btn-info" >&nbsp &nbsp Low &nbsp &nbsp</a>'+
                                '@elseif($row->level==='medium')'+
                                  '<a  class="btn btn-primary">Medium</a>'+
                                '@elseif($row->level==='high')'+
                                  '<a  class="btn btn-warning">&nbsp &nbsp High  &nbsp</a>'+
                                '@endif</td>'+
                                '&nbsp'+
                                '@if($row->job_status===0)'+
                                  '<a  class="btn btn-warning" >NOT COMPLETED</a>'+
                                '@elseif($row->job_status===1)'+
                                  '<a  class="btn btn-success">&nbsp &nbsp COMPLETED &nbsp &nbsp &nbsp</a>'+
                                '@endif'+
                                '&nbsp'+
                                '@if($row->verified_status===0)'+
                                '<a href="deletelocation/{{$row->id}}" class="btn btn-danger" ><i class="fa fa-trash"></i></a>'+
                                '@endif'+
                                '</div>'

          var infowindow{{$row->id}} = new google.maps.InfoWindow({
            content: con{{$row->id}}
          });

          var marker{{$row->id}} = new google.maps.Marker({
              position: {
                  lat: {{$row->lat}},
                  lng: {{$row->lng}}
              },
              map: map,
              draggable: false,
          });


          @if($row->level=='law')
            marker{{$row->id}}.setIcon('http://maps.google.com/mapfiles/ms/icons/yellow-dot.png')
          @elseif($row->level=='medium')
            marker{{$row->id}}.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png')
          @elseif($row->level=='high')
              marker{{$row->id}}.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png')
            @else
            marker{{$row->id}}.setIcon('http://maps.google.com/mapfiles/ms/icons/yellow-dot.png')
            @endif

          marker{{$row->id}}.addListener('click', function() {
          infowindow{{$row->id}}.open(map, marker{{$row->id}});
        });

  @endforeach

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
      }

  </script>


</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMjwyKg-mHUw2I6fNvJm3NrlxF_hBYS_M&libraries=places&callback=initAutocomplete"
          async defer></script>
@endsection
