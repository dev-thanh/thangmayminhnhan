<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__logo">
                    <img src="{{url('/')}}/{{@$site_info->logo_footer}}" alt="Logo">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h3 class="footer__header">
                    XE ĐẠP ĐIỆN PHONG LÝ
                </h3>
                <ul>
                    <li>
                        Địa chỉ
                    </li>
                    @foreach($site_info->address->list as $item)
                    <li>
                        {{@$item->title}}
                    </li>
                    @endforeach
                    <li>
                        <a href="https://www.facebook.com/xedienphongly" title="{{@$site_info->link_facebook}}">
                        <img src="{{url('/')}}/public/frontend/images/icons/icon__facebook.png" alt="{{@$site_info->link_facebook}}">
                        <span>
                        {{@$site_info->link_facebook}}
                        </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <h3 class="footer__header">
                    CHÍNH SÁCH QUY ĐỊNH
                </h3>
                <ul>
                    @if (count($policy) > 0)
                        @foreach ($policy as $item)
                            @if($item->type==1)
                                <li>
                                    <a href="{{route('home.policy',['slug' => $item->slug])}}" title="{{ @$item->name }}">
                                    {{ @$item->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="footer__content">
                    <h3 class="footer__header">
                        NHẬN BẢN TIN KHUYẾN MÃI
                    </h3>
                    <form class="from__email" id="form-send-sale" action="{{route('home.send-sale')}}" method="POST">
                    @csrf
                        <input type="text" class="form-control email__input" placeholder="Email" name="email">
                        <buton type="button" class="btn btn__email btn-send-sale">
                            Đăng ký
                        </buton>
                    </form>
                    @if(!empty(@$site_info->payment_methods))
                    <h3 class="footer__header">
                        PHƯƠNG THỨC<br />
                        THANH TOÁN
                    </h3>
                    <div class="payment__methods">
                        @foreach(@$site_info->payment_methods as $item)
                        <div class="item">
                            <img src="{{url('/')}}/{{@$item->image}}" alt="{{@$item->title}}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="footer__map">
                    {!! @$site_info->google_maps !!}
                </div>
            </div>
        </div>
    </div>
</footer>
<button class="back-top">
    <i class="fas fa-arrow-up"></i>
</button>
<div id="addon__society">
    <div class="addon__item">
        @if (!empty(@$site_info->social))
            @foreach ($site_info->social as $item)
            <a href="{{ $item->link }}" class="addon__icon" title="{{ $item->name }}">
                <img src="{{ url('/').$item->icon }}" alt="{{ $item->name }}">
            </a>
            @endforeach
        @endif
    </div>
</div>