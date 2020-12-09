@extends('layouts.frontend')

@section('content')

					<!-- start banner Area -->
			<section class="banner-area relative" id="home" style="background: url('{{config('sekolah.image_banner_url')}}');">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
						<div class="banner-content col-lg-9 col-md-12">
							<h1 class="text-uppercase">
								{{config('sekolah.welcome_message')}}			
							</h1>
							<p class="pt-10 pb-10">
								{{config('sekolah.sub_welcome_message')}}
							</p>
																	
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start feature Area -->
			<section class="feature-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>{{config('sekolah.home_feature_column_1_title')}}</h4>
								</div>
								<div class="desc-wrap">
									<p>
										{{config('sekolah.home_feature_column_1_content')}}
									</p>
									<a href="{{config('sekolah.home_feature_column_1_link_url')}}">
									{{config('sekolah.home_feature_column_1_link_text')}} </a>									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>{{config('sekolah.home_feature_column_2_title')}}</h4>
								</div>
								<div class="desc-wrap">
									<p>
										{{config('sekolah.home_feature_column_2_content')}}
									</p>
									<a href="{{config('sekolah.home_feature_column_2_link_url')}}">
									{{config('sekolah.home_feature_column_2_link_text')}} </a>					
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4>{{config('sekolah.home_feature_column_3_title')}}</h4>
								</div>
								<div class="desc-wrap">
									<p>
										{{config('sekolah.home_feature_column_3_content')}}
									</p>
									<a href="{{config('sekolah.home_feature_column_3_link_url')}}">
									{{config('sekolah.home_feature_column_3_link_text')}} </a>									
								</div>
							</div>
						</div>												
					</div>
				</div>	
			</section>
			<!-- End feature Area -->
					
			<!-- Start popular-course Area -->
			

			<!-- Start blog Area -->
			<section class="blog-area section-gap" id="blog">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Berita Terbaru</h1>
							</div>
						</div>
					</div>					
					<div class="row">
						@foreach($posts as $post)
						<div class="col-lg-3 col-md-6 single-blog">
							<div class="thumb">
								<img class="img-fluid" src="{{$post->thumbnail()}}" alt="">								
							</div>
							<p class="meta">{{$post->created_at->format('D, d M Y')}}  |  oleh <a href="#">{{$post->user->name}}</a></p>
							<a href="blog-single.html">
								<h5>{{$post->title}}</h5>
							</a>
								{!! $post->content !!}
							<a href="{{route('site.single.post',$post->slug)}}" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>		
						</div>
						@endforeach						
					</div>
				</div>	
			</section>
			<!-- End blog Area -->			
			

			<!-- Start cta-two Area -->
			<section class="cta-two-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 cta-left">
							<h1>Not Yet Satisfied with our Trend?</h1>
						</div>
						<div class="col-lg-4 cta-right">
							<a class="primary-btn wh" href="#">view our blog</a>
						</div>
					</div>
				</div>	
			</section>
			<!-- End cta-two Area -->
		
@stop