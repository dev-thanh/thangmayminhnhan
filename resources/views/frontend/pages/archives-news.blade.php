<?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
@extends('frontend.master')
@section('main')

	<main id="main" class="main-category">
	    <section class="category__banner">
	        <img class="category__banner--img" src="{{url('/')}}/{{$dataSeo->banner}}" alt="{{@$dataSeo->name_page}}">
	        <h2 class="category__banner--title">
	            {{@$dataSeo->name_page}}
	        </h2>
	    </section>
	    <section class="page__category">
	        <div class="container">
	            <div class="module module-page__categroy">
	                <div class="module__content">
	                    <div class="page__category-group">
	                        @include('frontend.teamplate.category-sidebar')
	                        <div class="page__category-item page__category-main">
	                            <div class="page__new">
	                                <div class="module__header">
	                                    <h3 class="title">
	                                        {{@$dataSeo->name_page}}
	                                    </h3>
	                                </div>
	                                <div class="module__content">
	                                	@foreach($data as $item)
	                                    <div class="item">
	                                        <div class="content-box groups-box">
	                                            <div class="content-image">
	                                                <div class="image">
	                                                    <a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="Image">
	                                                    <img src="{{url('/')}}/{{@$item->image}}" alt="{{@$item->name}}">
	                                                    </a>
	                                                </div>
	                                            </div>
	                                            <div class="content">
	                                                <div class="content-header">
	                                                    <h4 class="content-name">
	                                                        <a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="DỊCH VỤ THAY BÌNH ẮC QUY XE ĐẠP ĐIỆN, XE MÁY ĐIỆN GIÁ RẺ">{{@$item->name}}</a>
	                                                    </h4>
	                                                    <div class="content-excerpt">
	                                                        {!! @$item->desc !!}
	                                                    </div>
	                                                    <div class="content-date">
	                                                        <p>{{format_datetime($item->created_at,'d/m/Y')}}</p>
	                                                    </div>
	                                                </div>
	                                                <div class="content-footer">
	                                                    <div class="content-button">
	                                                        <a href="{{route('home.news-single',['slug'=>$item->slug])}}" title="Xem thêm">Xem thêm</a>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    @endforeach
	                                </div>
	                            </div>
	                            <div class="text__right">
	                                <ul class="pagination">
	                                    <li class="prev">
	                                    	<a href="{{route('home.news')}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif"><span>&#10140;</span></a>
	                                    </li>
	                                    @for($i = 0; $i < $data->lastpage(); $i++)
	                                    <li class="" data-page="{{$i+1}}">
	                                    	<a href="{{route('home.news')}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif">{{$i+1}}</a>
	                                    </li>
	                                    @endfor
	                                    <li class="next"><a href="{{route('home.news')}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif"><span>&#10140;</span></a></li>
	                                </ul>
	                            </div>
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