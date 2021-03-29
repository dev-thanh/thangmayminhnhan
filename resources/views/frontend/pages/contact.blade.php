@extends('frontend.master')
@section('main')
	<?php 
		if(!empty($dataSeo)){
		$content = json_decode($dataSeo->content);
		//dd($content);
	} ?>
	<main id="main">
		@if(!empty($dataSeo->banner))
	    <section class="section__banner">
	        <div class="frame cus__frame">
	            <img class="frame--image" src="{{url('/')}}/{{@$dataSeo->banner}}" alt="{{@$dataSeo->name_page}}" />
	        </div>
	        @if(!empty($dataSeo->name_page))
	        <div class="container">
	            <h2 class="banner__title">{{@$dataSeo->name_page}}</h2>
	        </div>
	        @endif
	    </section>
	    @endif
	    <section class="pageContact">
	        <div class="container">
	            <div class="module module__pageContact">
	                <div class="module__header">
	                    <h2 class="title pl-0">
	                        {{$content->title_header}}
	                    </h2>
	                    <div class="info">
	                        {!! $content->meta_description !!}
	                    </div>
	                </div>
	                <div class="module__content">
	                    <div class="contact__group">
	                    	@foreach($content->top as $item)
	                        <div class="contact__item">
	                            <span class="icon">
	                            	{!!$item->html_icon!!}
	                            </span>
	                            <div class="contact__text">
	                                {!! $item->desc !!}
	                            </div>
	                        </div>
	                        @endforeach
	                    </div>
	                    <div class="contact__form-map">
	                        <div class="row align-initial">
	                            <div class="col-12 col-md-5">
	                                <form id="frm_contact" action="{{route('home.post-contact')}}" method="POST">
	                                	@csrf
	                                    <div class="form-group">
	                                        <input type="text" class="form-control" placeholder="Họ và Tên" name="name"/>
	                                        <span class="color--red fr-error" id="error_name"></span>
	                                    </div>
	                                    <div class="form-group">
	                                        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone" />
	                                        <span class="color--red fr-error" id="error_phone"></span>
	                                    </div>
	                                   <div class="form-group">
	                                        <input type="text" class="form-control" placeholder="Email" name="email" />
	                                        <span class="color--red fr-error" id="error_email"></span>
	                                    </div>
	                                    <div class="form-group">
	                                        <textarea class="form-control" placeholder="Nội dung" name="content"></textarea>
	                                        <span class="color--red fr-error" id="error_content"></span>
	                                    </div>
	                                    <button class="btn btn--send btn-send-contact">Gửi</button>
	                                </form>
	                            </div>
	                            <div class="col-12 col-md-7">
	                                {!! @$site_info->google_maps !!}
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	</main>

@endsection