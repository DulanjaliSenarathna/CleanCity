<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMCSCS | {{$title}}</title>

  <link rel="icon" type="image/png" href="icon/favicon.ico"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('Admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('Admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('Admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/skins/_all-skins.min.css')}}">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">


  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('Admin/plugins/iCheck/flat/blue.css')}}">

  <link rel="stylesheet" href="{{asset('crop/croppie.css')}}">




  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
  .avatar{
    border-radius: 50%;
    width: 25px;
    height: 25px;
    overflow: hidden;
    position: relative;
    display: inline-block;
  }
  .avatar img{
    width: 100%;
    height: auto;
  }
  .btn-file {
position: relative;
overflow: hidden;
}
.btn-file input[type=file] {
position: absolute;
top: 0;
right: 0;
min-width: 100%;
min-height: 100%;
font-size: 100px;
text-align: right;
filter: alpha(opacity=0);
opacity: 0;
outline: none;
background: white;
cursor: inherit;
display: block;
}

#img-upload{
width: 50%;
}

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">SCS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CMC</b>SCS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="{{url('messages')}}" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-commenting-o"></i>
              <span class="label label-danger">{{count($messagecount)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{count($messagecount)}} Unread messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  @foreach($message as $msg)
                  <li><!-- start message -->
                    <a href="{{url('messages')}}">
                      <div class="pull-left">
                        <img src="Admin\dist\img\msg.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {!! substr(strip_tags($msg->subject), 0, 20) !!}
                          @if (strlen(strip_tags($msg->subject)) > 20)
                               ...
                             @endif
                        <small><i class="fa fa-clock-o"></i> {{ date('H:i:d', strtotime($msg->created_at)) }}</small>
                      </h4>
                      <p>{!! substr(strip_tags($msg->message), 0, 30) !!}
                        @if (strlen(strip_tags($msg->message)) > 30)
                             ...
                           @endif</p>
                    </a>
                  </li>
                  <!-- end message -->
                  @endforeach

                </ul>
              </li>
              <li class="footer"><a href="{{url('messages')}}">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{count($notification)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{count($notification)}} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach($notification as $noti)
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> {!! substr(strip_tags($noti->message), 0, 50) !!}
                        @if (strlen(strip_tags($noti->message)) > 50)
                             ...
                           @endif
                    </a>
                  </li>
                  @endforeach

                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$profile->profile_pic}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$profile->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{$profile->profile_pic}}" class="img-circle" alt="User Image">

                <p>
                  {{$profile->name}} - {{$profile->job}}
                  <small>Member since -{{ date('d-M-Y | H:i:s', strtotime($profile->created_at)) }}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$profile->profile_pic}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$profile->name}}</p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li @if($title==='Dashboard') class="active" @endif>
          <a href="{{url('/dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li @if($title==='Members') class="active" @endif>
          <a href="{{url('members')}}">
            <i class="fa fa-users"></i> <span>Members</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li @if($title==='Add Member') class="active" @endif>
          <a href="{{url('addmembers')}}">
            <i class="fa fa-user-plus"></i> <span>Add Members</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li @if($title===($profile->name)) class="active" @endif>
          <a href="{{url('profile')}}">
            <i class="fa fa-user-circle-o"></i> <span>Profile</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li @if($title==='Post Article') class="active" @endif>
          <a href="{{url('postarticle')}}">
            <i class="fa fa-newspaper-o"></i> <span>Post Article</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li @if($title==='Add Cities') class="active" @endif>
          <a href="{{url('addcities')}}">
            <i class="fa fa-map"></i> <span>Add Cities</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>


        <li @if($title==='Inbox'||$title==='Compose Mail'||$title==='Sent Mail'||
          $title==='Draft'||$title==='Trash') class="active" @endif>
          <a href="{{url('inbox')}}">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-red">12</small>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if($title==='Inbox') class="active" @endif><a href="{{url('inbox')}}">
              <i class="fa fa-inbox"></i> Inbox</a></li>
            <li @if($title==='Compose Mail') class="active" @endif><a href="{{url('compose')}}">
              <i class="fa fa-envelope-o"></i> Compose</a></li>
            <li @if($title==='Sent Mail') class="active" @endif><a href="{{url('sentbox')}}">
              <i class="fa fa-mail-forward"></i> Sent</a></li>
            <li @if($title==='Draft') class="active" @endif><a href="{{url('draft')}}">
              <i class="fa fa-file-text-o"></i> Draft</a></li>
            <li @if($title==='Trash') class="active" @endif><a href="{{url('trash')}}">
              <i class="fa fa-trash-o"></i> Trash</a></li>
          </ul>
        </li>

        <li @if($title==='Drop Locations') class="active" @endif>
          <a href="{{url('droplocation')}}">
            <i class="fa fa-map-marker"></i> <span>Garbage Spots</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>




        <li @if($title==='Messages') class="active" @endif>
          <a href="{{url('messages')}}">
            <i class="fa fa-commenting-o"></i> <span>Messages</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">{{count($messagecount)}}</small>
            </span>
          </a>
        </li>

        <li>
          <a href="{{url('/')}}">
            <i class="fa fa-clipboard"></i> <span>Blog</span>
          </a>
        </li>




      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018-2019 <a href="www.cmcscs.lk">CMCSCS</a></strong> All rights
    reserved.
  </footer>



<!-- jQuery 3 -->
<script src="{{asset('Admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('Admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('Admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Admin/dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('Admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{asset('Admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('Admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('Admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('Admin/bower_components/chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('Admin/dist/js/pages/dashboard2.js')}}Admin/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Admin/dist/js/demo.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('Admin/plugins/iCheck/icheck.min.js')}}"></script>

<!-- CK Editor -->
<script src="{{asset('Admin/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('Admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script src="crop/croppie.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>


<script type="text/javascript">
$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
	});

</script>

<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>

<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>

<script>
$(document).ready(function(){

  $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#profile_pic').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#profile_pic').html(data);
        }
      });
    })
  });

});
</script>


</body>
</html>
