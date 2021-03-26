<div class="item">
	<div class="avarta">
		<a title="{{ $item->name }}" href="{{ route('home.single-project', $item->slug) }}">
			<img src="{{ $item->image }}" class="img-fluid" width="100%" alt="{{ $item->name }}"></a>
		</div>
	<div class="info text-center">
		<div class="info-srv">
			<h2 class="text-uppercase">Dự án</h2>
			<h3 class="text-uppercase"><a title="{{ $item->name }}" href="{{ route('home.single-project', $item->slug) }}">{{ $item->name }}</a></h3>
			<div class="btn-read"><a title="{{ $item->name }}" href="{{ route('home.single-project', $item->slug) }}"><i class="fa fa-angle-right"></i></a></div>
		</div>
	</div>
</div>