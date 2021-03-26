@extends('frontend.master')
@section('main')

	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>

	<main id="main">
	    @if(!empty($data->banner) || !empty($dataSeo->banner))
	    <section class="section__banner">
	        <div class="frame cus__frame">
	            <img class="frame--image" src="{{url('/')}}/{{ @$data->banner !='' ? @$data->banner : @$dataSeo->banner }}" alt="{{@$dataSeo->name_page}}"/>
	        </div>
	        <div class="container">
	            <h2 class="banner__title">{{@$dataSeo->name_page}}</h2>
	        </div>
	    </section>
	    @endif
	    </section>
	    <section class="pageProduct">
	        <div class="module module__pageProduct">
	            <div class="container">
	                <div class="row">
	                    <div class="col-12 col-lg-3">
	                        <div class="module__header">
	                            <h2 class="title">Danh mục linh kiện</h2>
	                            <button class="btn sidebMobile">+</button>
	                        </div>
	                        <div class="module__content">
	                            <ul class="sideba">
	                                @foreach($cateAccessories as $item)
	                                <li class="sideba__item @if(in_array(@$item->id,$list_category)) active @endif">
	                                    <a class="sideba__item--link" href="{{route('home.archive.accessories',['slug'=>$item->slug])}}"> {{@$item->name}} </a>
	                                </li>
	                                @endforeach
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-12 col-lg-9">
	                        <div class="module__content">
	                        	@foreach($cateAccessories as $item)
		                        	@if(in_array(@$item->id,$list_category))
		                            <h2 class="name__product">{{$item->name}}</h2>
		                            @endif
	                            @endforeach
	                            <div class="product__detail">
	                                <div class="product__album accessories__album">
	                                	@if(!empty($data->more_image))
                                    		<?php $images = json_decode(@$data->more_image); ?>
		                                    <div class="slider-for">
		                                    		@foreach(@$images as $item)
			                                        <div class="item">
			                                            <div class="frame">
			                                                <img class="frame--image" src="{{url('/')}}/{{$item}}" alt="{{@$data->name}}"/>
			                                            </div>
			                                        </div>
			                                        @endforeach
		                                    </div>
		                                    <div class="product__list">
		                                        <div class="slider-nav">
		                                        	@foreach(@$images as $item)
		                                            <div class="item">
		                                                <div class="box">
		                                                    <img src="{{url('/')}}/{{$item}}" alt="{{@$data->name}}" />
		                                                </div>
		                                            </div>
		                                            @endforeach
		                                        </div>
		                                    </div>
	                                    @endif
	                                </div>
	                                <div class="product__info">
	                                    <h2 class="info__title">
	                                        {{@$data->name}}
	                                    </h2>
	                                    <div class="info__desc">
	                                        {!! @$data->content !!}
	                                    </div>
	                                </div>
	                            </div>
	                            @if(count($accessories_same_category))
	                            <div class="related__products">
	                                <h2 class="related__products--title">Những linh kiện liên quan</h2>
	                                <div class="related__content">
	                                    <div class="product__group product__accessories">
	                                    	@foreach($accessories_same_category as $item)
	                                        <div class="product">
	                                            <a href="{{route('home.single.accessories',['slug'=>$item->slug])}}" class="product__box">
	                                                <div class="avata">
	                                                    <div class="frame">
	                                                        <img class="frame--image" src="{{url('/')}}/{{$item->image}}" alt="{{@$item->name}}" />
	                                                    </div>
	                                                </div>
	                                                <h3 class="product__title">
	                                                    {{$item->name}}
	                                                </h3>
	                                            </a>
	                                        </div>
	                                        @endforeach
	                                    </div>
	                                </div>
	                            </div>
	                            @endif
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	</main>
	@section('script')
		<script>
		    $(document).ready(function () {
			    $(".slider-for").slick({
			      slidesToShow: 1,
			      slidesToScroll: 1,
			      arrows: false,
			      fade: true,
			      asNavFor: ".slider-nav",
			    });
			    $(".slider-nav").slick({
			      slidesToShow: 4,
			      slidesToScroll: 1,
			      asNavFor: ".slider-for",
			      dots: false,
			      focusOnSelect: true,
			    });
			    $('a[href="{{request()->root()}}/linh-kien"]').parents('li').addClass('active');
			});
		</script>
	@endsection
@endsection