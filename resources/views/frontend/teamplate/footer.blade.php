<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="footer__content">
                    <h3 class="footer__title border__bottom--none cus-pm">
                        CÔNG TY TNHH <br />
                        THANG MÁY MINH NHÂN
                    </h3>
                    <ul class="list">
                        @if (!empty($site_info->address->list))
                        <li class="list__item">
                            <span class="list__icon">
                            <img src="{{url('/')}}/images/icon__map.png" alt="icon__map.png" />
                            </span>
                            @foreach($site_info->address->list as $item)
                                <span class="list__text">
                                    {{$item->title}}
                                </span>
                            @endforeach
                        </li>
                        @endif
                        @if (!empty($site_info->phone->list))
                        <li class="list__item">
                            <span class="list__icon">
                            <img src="{{url('/')}}/images/icon__phone.png" alt="icon__phone.png" />
                            </span>
                            @foreach($site_info->phone->list as $item)
                            <span class="list__text">{{$item->title}}</span>
                            @endforeach
                        </li>
                        @endif
                        @if (!empty($site_info->email->list))
                        <li class="list__item">
                            <span class="list__icon">
                            <img src="{{url('/')}}/images/icon__email.png" alt="icon__email.png" />
                            </span>
                            <span class="list__text">
                                @foreach($site_info->email->list as $item)
                                    <a href="mailto:{{$item->title}}">{{$item->title}}</a>
                                @endforeach
                            </span>
                        </li>
                        @endif
                        @if (!empty($site_info->website->list))
                        <li class="list__item">
                            <span class="list__icon">
                            <img src="{{url('/')}}/images/icon__inter.png" alt="icon__inter.png" />
                            </span>
                            <span class="list__text">
                                @foreach($site_info->website->list as $item)
                                    <a href="{{$item->title}}" target="_blank">{{$item->title}}</a>
                                @endforeach
                            </span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            @if (count($policy) > 0)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="footer__content w-cus">
                    <h3 class="footer__title">Chính sách</h3>
                    <ul class="list">
                        @foreach ($policy as $item)
                            @if($item->type==1)
                            <li class="list__item">
                                <a href="{{route('home.policy',['slug' => $item->slug])}}" title="{{ @$item->name }}" class="list__item--link">
                                {{ @$item->name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            @if (!empty(@$site_info->social))
            <div class="col-12 col-md-4">
                <div class="footer__content w-cus__212">
                    <h3 class="footer__title text-center">Theo dõi chúng tôi</h3>
                    <div class="footer__society">
                        @foreach ($site_info->social as $item)
                        <a href="{{ $item->link }}" class="society__link" title="{{ $item->name }}" target="_blank">
                        <img src="{{ url('/').$item->icon }}" alt="{{ $item->name }}" />
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</footer>