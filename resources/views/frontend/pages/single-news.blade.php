@extends('frontend.master')
@section('main')
	<main id="main"  >
	    @if(!empty($data->banner) || !empty($dataSeo->banner))
	    <section class="section__banner">
	        <div class="frame cus__frame">
	            <img class="frame--image" src="{{url('/')}}/{{ @$data->banner !='' ? @$data->banner : @$dataSeo->banner }}" alt="{{@$dataSeo->name_page}}"/>
	        </div>
	        @if(!empty(@$dataSeo->name_page))
	        <div class="container">
	            <h2 class="banner__title">{{@$dataSeo->name_page}}</h2>
	        </div>
	        @endif
	    </section>
	    @endif
	    <section class="newDetail">
	        <div class="module module__newDetail">
	            <div class="container">
	                <div class="row">
	                    <div class="col-12 col-lg-9">
	                        <div class="module__content">
	                            <div class="detail">
	                                <h3 class="title pl-0 color--red">
	                                    {{@$data->name}}
	                                </h3>
	                                {!! @$data->content !!}
	                            </div>
	                        </div>
	                    </div>
	                    @if(count($post_new) > 0)
	                    <div class="col-12 col-lg-3">
	                        <div class="module__content">
	                            <div class="sideba">
	                                <h2 class="title pl-0">Tin tưc mới nhất</h2>
	                                <ul>
	                                	@foreach($post_new as $item)
	                                    <li class="sideba__item @if($item->id == $data->id) active @endif">
	                                        <a class="sideba__item--link" href="{{route('home.news-single',['slug'=>$item->slug])}}" title="{{$item->name}}">
	                                        	{{$item->name}}
	                                        </a>
	                                    </li>
	                                   @endforeach
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                    @endif
	                </div>
	                @if(count($post_same_category))
	                <div class="detailRe">
	                    <h3 class="title color--red pl-0">Tin tức liên Quan</h3>
	                    <div class="detailRe__content">
	                        <div class="module">
	                            <div class="module__content">
	                                <div class="group__new newSlide">
		                            	@foreach($post_same_category as $item)
	                                    <div class="new__item">
	                                        <div class="new__box">
	                                            <div class="new__avata">
	                                                <a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="frame" title="{{$item->name}}">
	                                                <img
	                                                    class="frame--image"
	                                                    src="{{url('/')}}/{{$item->image}}"
	                                                    alt="{{$item->name}}"
	                                                    />
	                                                </a>
	                                            </div>
	                                            <div class="new__content">
	                                                <h3 class="new__title">{{$item->name}}</h3>
	                                                <div class="new__desc">
	                                                    {!! $item->desc !!}
	                                                </div>
	                                                <a href="{{route('home.news-single',['slug'=>$item->slug])}}" class="btn btn--view" title="Xem thêm">
	                                                Xem thêm
	                                                </a>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    @endforeach
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                @endif
	            </div>
	        </div>
	    </section>
	</main>

	@section('script')
	<script>
		$(document).ready(function () {
		    function slideNew() {
		      $(".newSlide").slick({
		        slidesToShow: 4,
		        slidesToScroll: 3,
		        dots: false,
		        autoplay: true,
		        arrows: true,
		        nextArrow:
		          "<button type='button' class='btn next__arrow'><i class='fas fa-chevron-circle-right'></i></button>",
		        prevArrow:
		          "<button type='button' class='btn prev__arrow'><i class='fas fa-chevron-circle-left'></i></button>",
		        responsive: [
		          {
		            breakpoint: 1199.98,
		            settings: {
		              slidesToShow: 3,
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
		  });
	</script>
	@endsection
@endsection