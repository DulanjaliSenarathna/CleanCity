@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Colombo Municipal Council Smart Cleaning Service</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$PendintoCleane}}</h3>

              <p>Pending to Clean</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa  fa-hourglass-start"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending to Clean</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
        </div> -->
        <!-- /.col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$PendintoApprove}}</h3>

              <p>Pending to Approve</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-round"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING TO Approve</span>
              <span class="info-box-number">41,410</span>
            </div>
          </div>
        </div> -->
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$TotalCleanePoint}}</h3>

              <p>Total Clean Points</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Clean Points</span>
              <span class="info-box-number">760</span>
            </div>
          </div>
        </div> -->
        <!-- /.col -->


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$users}}</h3>

              <p>Total Members</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{url('members')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number">{{$users}}</span>
            </div>
          </div>
        </div> -->
        <!-- /.col -->
      </div>
      <!-- /.row -->






















      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pending to Cleane</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-8">
                  <div class="pad">
                    <!-- Map will be created here -->
                    <div id="map" style="height: 325px; width: 100%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-4">

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="row">



            <script>

                  var map;
                  function initAutocomplete(){
                      console.log(document.getElementById('map'));
                      map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: 6.9271, lng: 79.8612},
                          zoom: 13
                      });

                      @foreach($location as $row)





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



            <!-- /.col -->



            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($members as $row)
                    <li>
                      <img src="{{$row->profile_pic}}" alt="User Image" style="border-radius: 50%;width: 80px;height: 80px;
                      overflow: hidden;position: relative;display: inline-block;">
                      <a class="users-list-name" href="viewprofile/{{$row->id}}">{{$row->name}}</a>
                      <span class="users-list-date">{{$row->job}}</span>
                    </li>
                    @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{url('members')}}" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>




            <div class="col-md-4">
              <!-- Info Boxes Style 2 -->

              <!-- /.info-box -->

              <!-- /.info-box -->


              <!-- /.info-box -->

              <!-- /.box -->

              <!-- PRODUCT LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Recently Added Posts</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">

                    @foreach($post as $post)
                    <li class="item">
                      <div class="product-img">
                        <img src="{{$post->post_image}}" alt="Product Image">
                      </div>
                      <div class="product-info">
                        <a href="viewpost/{{$post->postid}}" class="product-title">{!! substr(strip_tags($post->post_title), 0, 40) !!}
                          @if (strlen(strip_tags($post->post_title)) > 40)</a>
                               ...
                             @endif
                        <span class="product-description">
                          {!! substr(strip_tags($post->post_body), 0, 40) !!}
                            @if (strlen(strip_tags($post->post_body)) > 40)
                                 ...
                               @endif  </p>
                            </span>
                      </div>
                    </li>
                    @endforeach
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Posts</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!-- /.box -->
            </div>

            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- /.box -->
        </div>
        <!-- /.col -->









        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  @endsection
