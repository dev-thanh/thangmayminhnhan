<?php 
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	$curent_page = request()->get('page') ? request()->get('page') : '1';
	$sort = request()->get('sort') ? request()->get('sort') : '';
 ?>
@extends('frontend.master')
@section('main')
	
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
	    <section class="pageProduct">
	        <div class="module module__pageProduct">
	            <div class="container">
	                <div class="row">
	                    <div class="col-12 col-md-4 col-lg-3">
	                        <div class="module__header">
	                            <h2 class="title">Danh mục sản phẩm</h2>
	                            <button class="btn sidebMobile">+</button>
	                        </div>
	                        <div class="module__content">
	                            <ul class="sideba breadcrumb-box">
	                            	@foreach($cateProducts as $item)
	                                <li class="sideba__item">
	                                    <a class="sideba__item--link" href="{{route('home.archive.product',['slug'=>$item->slug])}}"> {{@$item->name}} </a>
	                                </li>
	                                @endforeach
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-12 col-md-8 col-lg-9">
	                        <div class="module__content">
	                            <h2 class="name__product">Tất cả sản phẩm</h2>
	                            <label for="filter" class="filter">
	                                <select class="form-control" id="filter" name="sap-xep">
	                                    <option value="moi-nhat" @if($sort=='moi-nhat') selected @endif>Mới nhất</option>
										<option value="cu-nhat" @if($sort=='cu-nhat') selected @endif>Cũ nhất</option>
										<option value="a-z" @if($sort=='a-z') selected @endif>A-Z</option>
										<option value="z-a" @if($sort=='z-a') selected @endif>Z-A</option>
	                                </select>
	                            </label>
	                            <div class="product__group">
	                            	@if(count($data))
		                            	@foreach($data as $item)
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
	                                @else
	                                	<div class="product breadcrumb-box" style="padding: 50px;width: 100%">
	                                		Sản phẩm đang được cập nhập
	                                	</div>
	                                @endif
	                            </div>
	                            <nav aria-label="Page navigation example">
	                                <ul class="pagination justify-content-center">
	                                    
	                                    <li class="page-item">

						                    <a class="page-link" href="{{route('home.list.product')}}?page={{$curent_page-1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page==1) onclick="return false;" @endif" aria-label="Previous">

						                        <span aria-hidden="true">&laquo;</span>

						                    </a>

						                </li>

						                @for($i = 0; $i < $data->lastpage(); $i++)
	                                    <li class="page-item" data-page="{{$i+1}}">
	                                    	<a class="page-link" href="{{route('home.list.product')}}?page={{$i+1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page == $i+1) onclick="return false;" @endif">
	                                    		{{$i+1}}
	                                    	</a>
	                                    </li>
	                                    @endfor

	                                    <li class="page-item">

						                    <a class="page-link" aria-label="Next" href="{{route('home.list.product')}}?page={{$curent_page+1}}@if($sort !='')&sort={{$sort}}@endif" @if($curent_page==$data->lastpage()) onclick="return false;" @endif >

						                        <span aria-hidden="true">&raquo;</span>

						                    </a>

						                </li>
	                                </ul>
	                            </nav>
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

            $('li[data-page="{{$curent_page}}"]').addClass('active');

            $('select[name="sap-xep"]').change(function() {
	        	var value = $(this).val();
	        	console.log(value);
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