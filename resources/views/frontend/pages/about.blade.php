@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
	} ?>

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
	    @if(!empty($content->process))
	    <section class="pageAbout">
	        <div class="container">
	            <div class="module module__pageAbout">
	                <div class="module__content">
	                    <div class="about">
	                        <div class="about__container">
	                        	@foreach($content->process as $item)
	                            <div class="about__row">
	                                <div class="about__avata">
	                                    <img src="{{url('/')}}/{{$item->image}}" alt="{{$dataSeo->name_page}}" />
	                                </div>
	                                <div class="about__content">
	                                    {!! $item->content !!}
	                                </div>
	                            </div>
	                            @endforeach
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    @endif
	</main>
@endsection