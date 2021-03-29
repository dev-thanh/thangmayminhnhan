<?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
@extends('frontend.master')
@section('main')
	<main id="main">
		@if(!empty($dataSeo->banner))
	    <section class="section__banner">
	        <div class="frame cus__frame">
	            <img class="frame--image" src="{{url('/')}}/{{$dataSeo->banner}}" alt="{{$dataSeo->name_page}}" />
	        </div>
	        <div class="container">
	            <h2 class="banner__title">{{$dataSeo->name_page}}</h2>
	        </div>
	    </section>
	    @endif
	    <section class="newHome">
	        <div class="container">
	            <div class="module module__newHome">
	                <div class="module__header">
	                    <h2 class="title">Tin tức</h2>
	                </div>
	                <div class="module__content">
	                    <div class="group__new newSlide">
	                    	@foreach($data as $item)
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
	</main>
	@section('script')
	<script>

        jQuery(document).ready(function($) {

            $('[data-page="{{$curent_page}}"]').addClass('active');

        });

    </script>
    @endsection
@endsection