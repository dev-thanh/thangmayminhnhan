<div class="item">
	<div class="avarta">
		<a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">
			<img src="{{ $item->image }}" class="img-fluid" width="100%" alt="{{ $item->name }}">
		</a>
	</div>
	<div class="info">
		<h3><a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}">{{ $item->name }}</a></h3>
		<div class="time">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}  - {{ @$item->Author->name }}</div>
		<div class="desc">
			{{ $item->desc	 }}
		</div>
		<div class="link-more">
			<a title="{{ $item->name }}" href="{{ route('home.post.single', $item->slug) }}" class="text-uppercase">Chi tiết</a>
		</div>
	</div>
</div>