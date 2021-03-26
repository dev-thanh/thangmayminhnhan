@extends('frontend.master')
@section('main')

	<?php if(!empty($contentHome)){
		$content = json_decode($contentHome->content);
	} ?>

	<main id="main" class=" ">
	    <section class="page__category">
	        <div class="container">
	            <div class="module module-page__categroy">
	                <div class="module__content">
	                    <div class="page__category-group">
	                        <div class="page__category-item page__category-main">
	                            <div class="post__detail">
	                                <h2 class="post__title">
	                                    {{$data->name}}
	                                </h2>
	                                
	                                {!! @$data->content !!}
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    
	</main>
	
@endsection