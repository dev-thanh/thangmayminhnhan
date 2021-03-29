<?php 
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	$sort = request()->get('sort') ? request()->get('sort') : '';
	$banner = json_decode($cate->meta_banner)->image;
 ?>
@extends('frontend.master')
@section('main')
	
	<main id="main">
	    @if(!empty($cate->meta_banner) || !empty($banner))
	    <section class="section__banner">
	        <div class="frame cus__frame">
	            <img class="frame--image" src="@if(!empty(@$banner)) {{url('/')}}/{{@$banner}} @else {{url('/')}}/{{@$dataSeo->banner}} @endif" alt="{{@$dataSeo->title}}" />
	        </div>
	        @if(!empty($cate->name))
	        <div class="container">
	            <h2 class="banner__title">{{@$cate->name}}</h2>
	        </div>
	        @endif
	    </section>
	    @endif
	    <section class="pageProduct">
	        <div class="module module__pageProduct">
	            <div class="container">
	                <div class="row">
	                    <div class="col-12 col-md-4 col-lg-3">
	                        <div class="module__header">
	                            <h2 class="title">Danh mục linh kiện</h2>
	                            <button class="btn sidebMobile">+</button>
	                        </div>
	                        <div class="module__content">
	                            <ul class="sideba">
	                            	@foreach($cateAccessories as $item)
	                                <li class="sideba__item @if($cate->id == $item->id) active @endif">
	                                    <a class="sideba__item--link" href="{{route('home.archive.accessories',['slug'=>$item->slug])}}" title="{{@$item->name}}"> {{@$item->name}} </a>
	                                </li>
	                                @endforeach
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-12 col-md-8 col-lg-9">
	                        <div class="module__content">
	                            <h2 class="name__product">{{@$cate->name}}</h2>
	                            <label for="filter" class="filter">
	                                <select class="form-control" id="filter" name="sap-xep">
	                                    <option value="moi-nhat" @if($sort=='moi-nhat') selected @endif>Mới nhất</option>
										<option value="cu-nhat" @if($sort=='cu-nhat') selected @endif>Cũ nhất</option>
										<option value="a-z" @if($sort=='a-z') selected @endif>Tên sản phẩm A-Z</option>
										<option value="z-a" @if($sort=='z-a') selected @endif>Tên sản phẩm Z-A</option>
	                                </select>
	                            </label>
	                            <div class="product__group product__accessories">
	                            	@if(count($data))
		                            	@foreach($data as $item)
		                                <div class="product">
		                                    <a href="{{route('home.single.accessories',['slug'=>$item->slug])}}" class="product__box" title="{{$item->name}}">
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
	                                @else
	                                	<div class="product" style="padding: 50px;width: 100%">
	                                		Sản phẩm đang được cập nhật
	                                	</div>
	                                @endif
	                            </div>
	                            @if(count($data))
		                            @if(@$data->lastpage() > 1)
		                            <nav aria-label="Page navigation example">
		                                <ul class="pagination justify-content-center breadcrumb-box">
		                                    
		                                    <li class="page-item">

							                    <a class="page-link" href="{{url()->current()}}?page={{$curent_page-1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page==1) onclick="return false;" @endif" aria-label="Previous">

							                        <span aria-hidden="true">&laquo;</span>

							                    </a>

							                </li>

							                @for($i = 0; $i < $data->lastpage(); $i++)
		                                    <li class="page-item" data-page="{{$i+1}}">
		                                    	<a class="page-link" href="{{url()->current()}}?page={{$i+1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page == $i+1) onclick="return false;" @endif">
		                                    		{{$i+1}}
		                                    	</a>
		                                    </li>
		                                    @endfor

		                                    <li class="page-item">

							                    <a class="page-link" aria-label="Next" href="{{url()->current()}}?page={{$curent_page+1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page==$data->lastpage()) onclick="return false;" @endif >

							                        <span aria-hidden="true">&raquo;</span>

							                    </a>

							                </li>
		                                </ul>
		                            </nav>
		                            @endif
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

        jQuery(document).ready(function($) {

	        $('[data-page="{{$curent_page}}"]').addClass('active');

	        $('select[name="sap-xep"]').change(function() {
	        	var value = $(this).val();

	        	window.location.href="{{url()->current()}}?sort="+value;
	        });

	        @if(!empty($scroll))

	        	$('html, body').animate({
                  scrollTop: ($('.breadcrumb-box').offset().top - 100)
                  }, 50);
	        @endif
	    });

    </script>
    @endsection
@endsection