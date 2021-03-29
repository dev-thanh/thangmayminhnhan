<?php 
    $route = request()->route()->getName() ? request()->route()->getName() : '';
    $routename = request()->path();
    //dd($site_info);
?>
<header id="header">
    <div class="header__top">
        <div class="container">
            <div class="header__group">
                @if(!empty(@$site_info->email_header))
                    <a href="mailto:{{@$site_info->email_header}}" class="header__link">
                    <span class="link__icon">
                    <i class="fas fa-envelope"></i>
                    </span>
                    <span class="link__name"> {{@$site_info->email_header}} </span>
                    </a>
                @endif
                @if(!empty(@$site_info->hot_line_header))
                    <a href="tel:{{@$site_info->hot_line_header}}" class="header__link">
                    <span class="link__icon">
                    <i class="fas fa-phone"></i>
                    </span>
                    <span class="link__name"> {{@$site_info->hot_line_header}} </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="header__body">
        <div class="container">
            <div class="header__banner">
                <h1 class="logo">
                    <a href="{{route('home.index')}}" class="Trang chủ">
                    <img src="{{url('/')}}/{{@$site_info->logo}}" alt="Logo" />
                    </a>
                </h1>
                <div class="tool__menu">
                    <div class="tool__menu-container">
                        <ul class="menu">
                            @foreach($menuHeader as $k =>$item)
                            @if ($item->parent_id == null)
                            <li class="menu__item @if($item->url=='/'.$routename) active @elseif($item->url=='/' && $routename=='/') active @endif" data-id="{{$item->id}}">
                                <a href="{{url('/').$item->url}}" class="menu__item--link">{{$item->title}}</a>
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
                <button class="toggleMenu"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>
</header>