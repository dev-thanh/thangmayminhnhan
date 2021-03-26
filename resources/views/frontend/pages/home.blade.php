@extends('frontend.master')
@section('main')

	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
		//dd($content);
	} ?>

	<main id="main">
		@if(!empty($contentHome->banner))
	    <section class="section__banner">
	        <div class="frame">
	            <img class="frame--image" src="{{url('/')}}/{{$contentHome->banner}}" alt="{{$contentHome->name_page}}" />
	        </div>
	    </section>
	    @endif
	    @if(!empty($content->aboutus))
	    <section class="aboutHome">
	        <div class="container">
	            <div class="module module__aboutHome">
	                <div class="module__content">
	                    <div class="row">
	                        <div class="col-12 col-md-6">
	                            <div class="frame">
	                                <img class="frame--image" src="{{$content->aboutus->iamge}}" alt="{{$content->aboutus->title}}"/>
	                            </div>
	                        </div>
	                        <div class="col-12 col-md-6">
	                            <div class="content">
	                                <h2 class="title">Giới thiệu</h2>
	                                <h3 class="info">{{$content->aboutus->title}}</h3>
	                                <div class="desc">
	                                    {!!$content->aboutus->desc!!}
	                                </div>
	                                <a class="btn btn--view" href="{{route('home.about')}}" title="Xem thêm"> Xem thêm </a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	    @if(!empty($content->services))
	    <section class="serviceHome">
	        <div class="module module__serviceHome">
	            <div class="module__content">
	                <div class="service__group">
	                    <div class="service__item">
	                        <div class="content">
	                            <h2 class="title">{{@$content->services->title}}</h2>
	                            <div class="info">
	                                {!! @$content->services->desc !!}
	                            </div>
	                            @if(!empty($content->services->content))
		                            @foreach($content->services->content as $item)
		                            <div class="settings__group">
		                                <div class="settings__icon">
		                                    <div class="settings__frame">
		                                        <img src="{{url('/')}}/{{$item->image}}" alt="{{$item->title}}"/>
		                                    </div>
		                                </div>
		                                <div class="settings__desc">
		                                    <h3 class="settings__title">
		                                        {{$item->title}}
		                                    </h3>
		                                    {!! $item->desc !!}
		                                </div>
		                            </div>
		                            @endforeach
	                            @endif
	                        </div>
	                    </div>
	                    <div class="service__item">
	                        <img class="frame--image" src="{{url('/')}}/{{@$content->services->image_right}}" alt="{{$item->title}}"/>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	    @if(count($products_show) > 0)
	    <section class="productHome">
	        <div class="container">
	            <div class="module module__productHome">
	                <div class="module__header">
	                    <div class="title">Sản phẩm</div>
	                </div>
	                <div class="module__content">
	                    <div class="product__group">
	                    	@foreach($products_show as $item)
	                        <div class="product">
	                            <a href="{{route('home.single.product',['slug'=>$item->slug])}}" class="product__box" title="{{$item->name}}">
	                                <div class="avata">
	                                    <div class="frame">
	                                        <img class="frame--image" src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}"/>
	                                    </div>
	                                </div>
	                                <h3 class="product__title">
	                                    {{$item->name}}
	                                </h3>
	                            </a>
	                        </div>
	                        @endforeach
	                    </div>
	                    <div class="text-center">
	                        <a href="{{route('home.list.product')}}" class="btn btn--more" title="Xem thêm"> Xem thêm </a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	    @if(count($blogs) > 0)
	    <section class="newHome">
	        <div class="container">
	            <div class="module module__newHome">
	                <div class="module__header">
	                    <h2 class="title">Tin tức</h2>
	                </div>
	                <div class="module__content">
	                    <div class="group__new newSlide">
	                    	@foreach($blogs as $item)
	                        <div class="new__item">
	                            <div class="new__box">
	                                <div class="new__avata">
	                                    <a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
	                                    	<img class="frame--image" src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}"/>
	                                    </a>
	                                </div>
	                                <div class="new__content">
	                                    <h3 class="new__title">{{$item->name}}</h3>
	                                    <div class="new__desc">
	                                        {{$item->sort_desc}}
	                                    </div>
	                                    <a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="btn btn--view" title="Xem thêm"> Xem thêm </a>
	                                </div>
	                            </div>
	                        </div>
	                        @endforeach
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	    @if(!empty(@$content->partner))
	    <section class="partnerHome">
	        <div class="container">
	            <div class="module module__partnerHome">
	                <div class="module__header">
	                    <h2 class="title">{{@$content->partner->title}}</h2>
	                </div>
	                <div class="module__content">
	                    <div class="partnerSlide">
	                    	@foreach(@$content->partner->content as $item)
	                        <div class="item">
	                            <div class="image">
	                                <img src="{{url('/')}}/{{$item->image}}" alt="{{$item->title}}" />
	                            </div>
	                        </div>
	                        @endforeach
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	</main>
	@section('script')
	<script>

        $(document).ready(function () {
		    function slideNew() {
		      $(".newSlide").slick({
		        slidesToShow: 3,
		        slidesToScroll: 2,
		        dots: false,
		        autoplay: true,
		        arrows: true,
		        nextArrow:
		          "<button type='button' class='btn next__arrow'><i class='fas fa-chevron-circle-right'></i></button>",
		        prevArrow:
		          "<button type='button' class='btn prev__arrow'><i class='fas fa-chevron-circle-left'></i></button>",
		        responsive: [
		          {
		            breakpoint: 991.98,
		            settings: {
		              slidesToShow: 2,
		              slidesToScroll: 2,
		            },
		          },
		          {
		            breakpoint: 600,
		            settings: {
		              slidesToShow: 2,
		              slidesToScroll: 2,
		            },
		          },
		          {
		            breakpoint: 500,
		            settings: {
		              slidesToShow: 1,
		              slidesToScroll: 1,
		            },
		          },
		        ],
		      });
		    }
		    slideNew();
		    function partnerSlide() {
		      $(".partnerSlide").slick({
		        slidesToShow: 6,
		        slidesToScroll: 5,
		        dots: false,
		        autoplay: true,
		        arrows: false,
		        responsive: [
		          {
		            breakpoint: 600,
		            settings: {
		              slidesToShow: 4,
		              slidesToScroll: 2,
		            },
		          },
		          {
		            breakpoint: 480,
		            settings: {
		              slidesToShow: 3,
		              slidesToScroll: 1,
		            },
		          },
		        ],
		      });
		    }
		    partnerSlide();
		});

    </script>
    @endsection
@endsection