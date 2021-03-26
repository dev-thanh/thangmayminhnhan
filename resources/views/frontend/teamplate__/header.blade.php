<?php 

    $route = request()->route()->getName() ? request()->route()->getName() : '';
    $routename = request()->path();
    $search = request()->search !='' ? request()->search : '';
   //dd($site_info);
?>
<header id="header">
    <div class="header__top">
        <div class="container">
            <div class="top__group">
                <div class="top__item top--policy">
                    <div class="policy__group">
                        @if(!empty(@$site_info->social_header))
                            @foreach(@$site_info->social_header as $item)
                            <a href="{{@$item->link}}" class="policy__item" title="{{@$item->title1}} {{$item->title2}}">
                                <div class="policy__icon">
                                    <img src="{{url('/')}}/{{@$item->image}}" alt="{{@$item->title1}} {{$item->title2}}">
                                </div>
                                <div class="policy__content">
                                    <h3 class="policy__title">
                                        {{@$item->title1}} <br />
                                        {{$item->title2}}
                                    </h3>
                                </div>
                            </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="top__item top__contact">
                    <span class="top__text">
                    {{@$site_info->support}}
                    </span>
                    <span class="top__text">
                    <span class="top__icon">
                    <img src="{{url('/')}}/public/frontend/images/icons/icon__phone--top.png" alt="icon__phone--top.png">
                    </span>
                    <span class="text">
                    {{@$site_info->hot_line_header}}
                    </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="header__banner">
        <div class="container">
            <div class="header__banner-group">
                <h1 class="addon__logo">
                    <a href="{{route('home.index')}}" class="logo" title="Trang chủ">
                    <img class="logo__link" src="{{url('/')}}/{{@$site_info->logo}}" alt="Logo">
                    </a>
                </h1>
                <form class="banner__search" action="{{route('home.search')}}" method="GET">
                    <input type="text" class="form-control search__input" name="search" value="{{@$search}}">
                    <button class="btn btn__search">
                    <img class="img__search" src="{{url('/')}}/public/frontend/images/icons/icon__search.png" alt="icon__search.png">
                    </button>
                </form>
                <a href="{{route('home.cart')}}" class="banner__cart" title="Giỏ hàng">
                    <span class="cart__icon count-cart">
                    {{ Cart::count() }}
                    </span>
                    <div class="icon">
                        <img class="img__cart" src="{{url('/')}}/public/frontend/images/icons/icon__cart.png" alt="Giỏ hàng">
                    </div>
                </a>
                <!-- mobile -->
                <div class="mobile">
                    <div class="mobile__group">
                        <div class="search">
                            <form class="form__search" action="{{route('home.search')}}" method="GET">
                                <input type="search" class="form-control form__input" name="search" value="{{@$search}}" placeholder="Tìm kiếm">
                                <button class="btn btn__search" type="submit">
                                &#9906;
                                </button>
                            </form>
                            <button class="btn btn__search btn__toggle--search">
                            &#9906;
                            </button>
                        </div>
                        <button class="btn btn__menu"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__scroll">
        <div class="container">
            <div class="header__group">
                <div class="addon-menu">
                    <div class="addon-menu__container">
                        <ul class="menu">
                            @foreach($menuHeader as $k =>$item)
                                @if ($item->parent_id == null)
                                <li class="menu__list @if($item->url=='/'.$routename) active @elseif($item->url=='/' && $routename=='/') active @endif" data-id="{{$item->id}}">
                                    <a href="{{url('/').$item->url}}" class="menu__item"> {{$item->title}} </a>
                                    @if (count($item->get_child_cate()))
                                    <ul>
                                        @foreach ($item->get_child_cate() as $value)
                                        <li>
                                            <a href="{{url('/').$value->url}}" data-parent="{{$item->id}}"> {{$value->title}} </a>
                                            @if (count($value->get_child_cate()))
                                            <ul>
                                                @foreach ($value->get_child_cate() as $val)
                                                <li>
                                                    <a href="{{url('/').$val->url}}" data-parent="{{$item->id}}"> {{$val->title}} </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>