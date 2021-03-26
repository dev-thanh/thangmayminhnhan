<section class="slide__banner">
    <div class="slick__banner">
    	@foreach($slider as $item)
        <div class="slide__item">
            <a href="{{ $item->link }}" class="frame">
            <img class="frame--image" data-lazy="{{url('/')}}/{{ $item->image }}" />
            </a>
        </div>
        @endforeach
    </div>
</section>