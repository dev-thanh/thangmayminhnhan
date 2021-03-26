@if(isset($filters))
<div class="page__category-item page__cagegory-sidebar">
    <div class="addon__filter">
        <h3 class="filter__title">
            Lọc
        </h3>
        <form>
            <div class="filter__body">
                @foreach($filters as $item)
                    <?php $content = json_decode($item->content); ?>
                    @if($item->type=='brand')
                    <h4 class="the-firm__title">
                        {{$item->name}}
                    </h4>
                        @foreach($content->filter as $n => $val)
                        <label class="theFirm" for="theFirm__{{$n+1}}">
                        <input type="radio" id="theFirm__{{$n+1}}" value="{{$val->brand_id}}" name="theFirm" class="the-firm__input filter-brand">
                        <span class="the-firm__text">
                            {{$val->name}}
                        </span>
                        </label class="theFirm">
                        @endforeach
                    @else
                    <h4 class="the-firm__title">
                        {{$item->name}}
                    </h4>
                    @foreach($content->filter as $k => $val)
                        <label class="priceFirm" for="priceFirm__{{$k+1}}">
                        <input type="radio" id="priceFirm__{{$k+1}}" name="priceFirm" class="price__firm-input filter-price" data-min="{{$val->min_value}}" data-max="{{$val->max_value}}">
                        <span class="checkRaido">
                            {{$val->name}}
                        </span>
                        </label>
                        @endforeach
                    @endif
                @endforeach
                
            </div>
            <input type="hidden" name="get_slug" value="{{@$slug}}">
            <input type="hidden" name="url_search" value="@if(request()->route()->getName() == 'home.search' ) {{request()->search}} @endif">
        </form>
    </div>
</div>
@endif