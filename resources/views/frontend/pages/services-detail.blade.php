@extends('frontend.master')
@section('main')
<?php $content = json_decode($data->content); ?>
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
	    <section class="serviceDetail">
	        <div class="container">
	            <div class="module module__serviceDetail">
	                <div class="module__header">
	                    <h2 class="title pl-0">{{@$data->name}}</h2>
	                </div>
	                @if(!empty($content->process))
	                <div class="module__content">
	                    <div class="service">
	                        <div class="service__desc">
	                            {!! @$data->content_detail !!}
	                        </div>
	                        <div class="service__container">
	                        	@foreach($content->process as $item)
	                            <div class="service__row">
	                                <div class="service__avata">
	                                    <img src="{{url('/')}}/{{$item->image}}" alt="{{@$data->name}}" />
	                                </div>
	                                <div class="service__content">
	                                    {!! $item->content !!}
	                                </div>
	                            </div>
	                            @endforeach
	                            <div class="contact">
				                    {!! $data->content_footer !!}
				                </div>
	                        </div>
	                    </div>
	                </div>
	                @endif
	            </div>
	        </div>
	    </section>
	</main>
@endsection