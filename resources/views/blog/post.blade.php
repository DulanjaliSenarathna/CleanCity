@extends('layouts.blog')

@section('content')

        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
              @foreach($post as $post)
				<div class="container">
					<div class="banner_content text-center">
						<h2>{{$post->post_title}}</h2>
						<div class="page_link">
							<a href="{{url('/')}}">Home</a>
							<a >Post Details</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Blog Area =================-->
        <section class="blog_area p_120 single-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
       					<div class="main_blog_details">
       						<img class="img-fluid" src="{{$post->post_image}}" alt="">
       						<a href="#"><h4>{{$post->post_title}}</h4></a>
       						<div class="user_details">
       							<div class="float-left">
       								<a href="#">{{$post->category}}</a>
       							</div>
       							<div class="float-right">
       								<div class="media">
       									<div class="media-body">
       										<h5>{{$post->name}}</h5>
       										<p>{{ date('D-M-Y', strtotime($post->publish_date)) }}</p>
       									</div>
       									<div class="d-flex">
       										<img src="{{$post->profile_pic}}" style="width:40px;height:40px;"alt="">
       									</div>
       								</div>
       							</div>
       						</div>
       						<p>{!! $post->post_body !!}</p>
              @endforeach


       					</div>



        			</div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Posts">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                                    </span>
                                </div><!-- /input-group -->
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="img/blog/author.png" alt="">
                                <h4>Charlie Barber</h4>
                                <p>Senior blog writer</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Popular Posts</h3>

                                @foreach($posts as $posts)
                                <div class="media post_item">
                                    <img style="width:50px" src="{{$posts->post_image}}" alt="post">
                                    <div class="media-body">
                                        <a href="{{$posts->postid}}"><h3>{!! substr(strip_tags($posts->post_title), 0, 200) !!}
                                          @if (strlen(strip_tags($post->post_title)) > 200)
                                               ...
                                             @endif</h3></a>
                                        <p>{{ date('d-M-Y', strtotime($posts->publish_date)) }}</p>
                                    </div>
                                </div>
                                @endforeach
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget">
                                <a href="#"><img class="img-fluid" src="img/blog/add.jpg" alt=""></a>
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title">Post Catgories</h4>
                                <ul class="list cat-list">
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Recycling</p>
                                            <p>37</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Home Waste</p>
                                            <p>24</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Industrial Waste</p>
                                            <p>59</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Plastic Recycling</p>
                                            <p>29</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Recyling Technology</p>
                                            <p>15</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Other</p>
                                            <p>09</p>
                                        </a>
                                    </li>
                                </ul>
                                <div class="br"></div>
                            </aside>
                            <aside class="single-sidebar-widget tag_cloud_widget">
                                <h4 class="widget_title">Tag Clouds</h4>
                                <ul class="list">
                                    <li><a href="#">Recycling</a></li>
                                    <li><a href="#">Plastic Recycling</a></li>
                                    <li><a href="#">Recyling Technology</a></li>
                                    <li><a href="#">Industrial Waste</a></li>
                                    <li><a href="#">Other</a></li>
                                    <li><a href="#">Home Waste</a></li>
                                    <li><a href="#">Recyling Technology</a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area =================-->

@endsection
