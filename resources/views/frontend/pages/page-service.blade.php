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
	    <section class="pageService">
	        <div class="container">
	            <div class="module module__pageService">
	                <div class="module__content">
	                    <div class="service">
	                        <div class="service__container">
	                        	@foreach($data as $item)
	                            <div class="service__row">
	                                <a href="{{route('home.services-detail',['slug'=>$item->slug])}}" class="service__avata" title="{{$item->name}}">
	                                <img src="{{url('/')}}/{{$item->image}}" alt="{{$item->name}}" />
	                                </a>
	                                <div class="service__content">
	                                    <h3 class="service__title">
	                                        {{$item->name}}
	                                    </h3>
	                                    <div class="desc">
	                                        {!! $item->desc !!}
	                                    </div>
	                                    <a class="btn btn--view" href="{{route('home.services-detail',['slug'=>$item->slug])}}" title="Xem thêm">
	                                    Xem thêm
	                                    </a>
	                                </div>
	                            </div>
	                            @endforeach
	                        </div>
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