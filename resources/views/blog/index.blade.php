@extends('layouts.blog')

@section('content')

        <!--================Post Slider Area =================-->
        <section class="post_slider_area">
			<div class="post_slider_inner owl-carousel">

        @foreach($slider as $slider)
				<div class="item">
					<div class="post_s_item">
						<div class="post_img" style="width:900px;height:500px;">
							<img src="{{$slider->post_image}}" alt="">
						</div>
						<div class="post_text">
							<a class="cat" href="#">{{$slider->category}}</a>
							<a href="viewpost/{{$slider->postid}}"><h4>{!! substr(strip_tags($slider->post_title), 0, 50) !!}
                @if (strlen(strip_tags($slider->post_title)) > 50)
                     ...
                   @endif</h4></a>
							<p>{!! substr(strip_tags($slider->post_body), 0, 100) !!}
                @if (strlen(strip_tags($slider->post_body)) > 100)
                     ...
                   @endif</p>
							<div class="date">
								<a ><i class="fa fa-calendar" aria-hidden="true"></i>{{ date('d-M-Y', strtotime($slider->publish_date)) }}</a>

							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
        </section>
        <!--================End Post Slider Area =================-->

        <!--================Blog Area =================-->
        <section class="blog_area p_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog_left_sidebar">


                          @foreach($posts as $post)
                            <article class="blog_style1">
                            	<div class="blog_img">
                            		<img class="img-fluid" src="{{$post->post_image}}" alt="">
                            	</div>
                            	<div class="blog_text">
									<div class="blog_text_inner">
										<a class="cat" href="#">{{$post->category}}</a>
										<a href="viewpost/{{$post->postid}}"><h4>{{$post->post_title}}</h4></a>
										<p>{!! substr(strip_tags($post->post_body), 0, 200) !!}
                      @if (strlen(strip_tags($post->post_body)) > 200)
                           ...
                         @endif</p>
										<div class="date">
											<a><i class="fa fa-calendar" aria-hidden="true"></i>{{ date('d-M-Y', strtotime($post->publish_date)) }}</a>

										</div>
									</div>
                      </div>
                            </article>

                            @endforeach

                            <nav class="blog-pagination justify-content-center d-flex">
		                        <ul class="pagination">
		                            {!! $posts->links(); !!}
		                        </ul>
		                    </nav>
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
                                <img class="author_img rounded-circle" src="blog\img\profile.jpg" style="width:100px;height:100px;" alt="">
                                <h4>About Us</h4>
                                <p>Colombo Municipal Council Smart <br>  Cleaning Service</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                                <p>Colombo Municipal Council is planning to launch a web site to optimize garbage collection and
                                  they provide some spots to the people and people can check that spots via the web
                                  site and they can keep their garbages in there. The CMC post articles
                                  related to the garbage problems and every people can see that post via
                                  the web site. CMC allow people to join with them as volunteers and they
                                  can report about thrown away garbage to the CMC and CMC collect them.</p>
                                <div class="br"></div>
                            </aside>

                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Recent Posts</h3>
                                @foreach($posts as $posts)
                                <div class="media post_item">
                                    <img style="width:50px" src="{{$posts->post_image}}" alt="post">
                                    <div class="media-body">
                                        <a href="viewpost/{{$posts->postid}}"><h3>{!! substr(strip_tags($posts->post_title), 0, 200) !!}
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
