<div class="item-product">
	<div class="product-image">
		<img src="{{ @$item->image }}" alt="{{ @$item->name }}" title="{{ @$item->name }}">
		@if (@$item->is_sale == 1)
			<div class="product-lable">
				<span class="lable lable-sale">-{{ $item->sale }}%</span>
			</div>
		@elseif($item->is_new == 1)
			<div class="product-lable">
				<span class="lable lable-new">New</span>
			</div>
		@endif
	</div>
	<div class="product-content">
		<div class="product-name">
			<a href="{{ route('home.single-product', ['slug' => $item->slug]) }}" class="product-link" title="{{ $item->name }}">{{ $item->name }}</a>
		</div>
		@if ($item->is_sale == 1 && !is_null($item->sale_price))
			<div class="product-price">
				<span class="price">Giá: </span>
				<del>{{ number_format($item->price, 0, '.', '.') }} VNĐ</del>
				<span class="price price-new">{{ number_format($item->sale_price, 0, '.', '.') }} VNĐ</span>
			</div>
		@else
			<div class="product-price">
				<span class="price price-new">Giá: {{ $item->price != 0 ? number_format($item->price, 0, '.', '.').' VNĐ' : 'Liên hệ' }}</span>
			</div>
		@endif
		<div class="product-button">
			<a href="{{ route('home.single-product', ['slug' => $item->slug]) }}" class="btn product-btn read-more-btn" title="{{ $item->name }}">Chi tiết</a>
		</div>
	</div> <!--product-content-->
</div>