<aside class="art-sidebars">
	<div class="sidebars-box">
		<div class="sidebars-content">

			<div class="sidebar-box sidebar-categories">
				<div class="title-box title-sidebar">
					<h3 class="title"><span>Danh mục sản phẩm</span></h3>
				</div>

				<div class="sidebar-content sidebar-categories-content">
					<ul>
						@foreach ($menuCategory as $item)
							@if ($item->parent_id == 0)
							<li>
								<a href="{{ route('home.category-product', ['slug' => $item->slug]) }}" title="{{ $item->name }}">
									<span>{{ $item->name }}</span>
								</a>
								@if (count($item->get_child_cate()))
									<div class="sub-menu">
										<ul>
											@foreach ($item->get_child_cate() as $value)
											<li>
												<a href="{{ route('home.category-product', ['slug' => $value->slug]) }}" title="{{ $value->name }}">
													<span>{{ $value->name }}</span>
												</a>
											</li>
											@endforeach
										</ul>
									</div>
								@endif
							</li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>

			<div class="sidebar-box sidebar-videos">
				<div class="title-box title-sidebar">
					<h3 class="title"><span>Video</span></h3>
				</div>

				<div class="sidebar-content sidebar-videos-content">
					<div class="videos">
						{!! @$site_info->iframe_video !!}
					</div>
					<div class="videos-content">
						<ul>
							@foreach (@$site_info->video as $item)
							<li>
								<a href="{{ $item->link }}" title="{{ $item->title }}">{{ $item->title }}</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
            </div>	
            
            <div class="sidebar-box sidebar-products-featured">
				<div class="title-box title-sidebar">
					<h3 class="title"><span>Sản phẩm nổi bật</span></h3>
				</div>

				<div class="sidebar-content">	
					<div class="sidebar-products-featured-content">	
                        @foreach ($product_hots_home as $item)
						<div class="item">
							<div class="product-box">
								<div class="product-image">
									<a href="{{ route('home.single-product', ['slug' => $item->slug]) }}" title="{{ $item->name }}">
										<img src="{{ $item->image }}" alt="{{ $item->name }}" style="max-width: 366px; max-height: 426px; width: 100%; height: 100%;">
									</a>
								</div>
							</div>
						</div>
                        @endforeach
					</div>
				</div>
			</div>		

			<div class="sidebar-box sidebar-blogs-featured">
				<div class="title-box title-sidebar">
					<h3 class="title"><span>Tin nổi bật</span></h3>
				</div>

				<div class="sidebar-content sidebar-blogs-featured-content">	
					@foreach ($new_hot as $item)
					<div class="item">
						<div class="post-box">
							<div class="post-image">
								<a href="{{ route('home.news-single', ['slug' => $item->slug]) }}" title="{{ $item->name }}">
									<img src="{{ url('/').$item->image }}" alt="{{ $item->name }}" style="max-width: 72px; max-height: 74px; width: 100%; height: 100%;">
								</a>
							</div>
							<div class="post-content">
								<h4 class="post-name">
									<a href="{{ route('home.news-single', ['slug' => $item->slug]) }}" title="{{ $item->name }}" class="post-link">{{ $item->name }}</span></a>
								</h4>
								<div class="post-create">
									<span>{{ $item->created_at->format('d/m/Y') }}</span>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</aside>