<?php $routeName = request()->route()->getName(); ?>

<li class="header">TRANG QUẢN TRỊ</li>

<li class="{{ Request::segment(2) == 'home' ? 'active' : null  }}">
    <a href="{{ route('backend.home') }}">
        <i class="fa fa-home"></i> <span>Trang chủ</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'users' ? 'active' : null  }}">
    <a href="{{ route('users.index') }}">
        <i class="fa fa-user"></i> <span>Tài khoản</span>
    </a>
</li>

<li class="treeview {{ Request::segment(2) === 'category' || Request::segment(2) === 'products' ||  Request::segment(2) === 'product-attributes' || Request::segment(2) === 'brand' || Request::segment(2) === 'category-filter' || Request::segment(2) === 'filter' ? 'active' : null }}">

    <a href="#">

        <i class="fa fa-tags" aria-hidden="true"></i> <span>Sản phẩm</span>

        <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

        </span>

    </a>

    <ul class="treeview-menu">



        <li class="{{ Request::segment(2) === 'products' ? 'active' : null }}">

            <a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a>

        </li>



        <li class="{{ Request::segment(2) === 'category' ? 'active' : null }}">

            <a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a>

        </li>

    </ul>

</li>

<li class="treeview {{ Request::segment(2) === 'category_accessories' || Request::segment(2) === 'accessories' ? 'active' : null }}">

    <a href="#">

        <i class="fa fa-tags" aria-hidden="true"></i> <span>Linh kiện</span>

        <span class="pull-right-container">

        <i class="fa fa-angle-left pull-right"></i>

        </span>

    </a>

    <ul class="treeview-menu">



        <li class="{{ Request::segment(2) === 'accessories' ? 'active' : null }}">

            <a href="{{ route('accessories.index') }}"><i class="fa fa-circle-o"></i> Danh sách linh kiện</a>

        </li>



        <li class="{{ Request::segment(2) === 'category_accessories' ? 'active' : null }}">

            <a href="{{ route('category_accessories.index') }}"><i class="fa fa-circle-o"></i> Danh mục linh kiện</a>

        </li>

    </ul>

</li>

<li class="{{ Request::segment(2) == 'services' ? 'active' : null  }}">
    <a href="{{ route('services.index') }}">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Dịch vụ</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'posts' ? 'active' : null  }}">
    <a href="{{ route('posts.index') }}?type=blog">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Tin tức</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'pages' ? 'active' : null  }}">
    <a href="{{ route('pages.list') }}">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Cài đặt trang</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'contact' ? 'active' : null  }}">
    <?php $number = \App\Models\Contact::where('status', 0)->count() ?>
    <a href="{{ route('get.list.contact') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Liên hệ ({{ $number }})
        </span>
    </a>
</li>

<li class="header">Cấu hình hệ thống</li>
<li class="treeview {{ Request::segment(2) === 'options' || Request::segment(2) === 'menu' || Request::segment(2) === 'policy' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Cấu hình</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

         <li class="{{ Request::segment(3) === 'general' ? 'active' : null }}">
            <a href="{{ route('backend.options.general') }}"><i class="fa fa-circle-o"></i> Cấu hình chung</a>
        </li>

        <li class="{{ Request::segment(2) === 'menu' ? 'active' : null }}">
            <a href="{{ route('setting.menu') }}"><i class="fa fa-circle-o"></i> Menu</a>
        </li>
        
        <li class="{{ $routeName =='policy.list' || $routeName =='policy.add' || $routeName =='policy.edit' ? 'active' : null }}">

            <a href="{{ route('policy.list') }}"><i class="fa fa-circle-o"></i>Chính sách quy định(footer)</a>

        </li>

    </ul>
</li>

<div style="display: none;">
	<li class="header">Cấu hình hệ thống</li>
	<li class="treeview {{ Request::segment(2) == 'options' ? 'active' : null  }}">
		<a href="#">
			<i class="fa fa-folder"></i> <span>Setting (Developer)</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ Request::segment(3) == 'developer-config' ? 'active' : null  }}">
				<a href="{{ route('backend.options.developer-config') }}"><i class="fa fa-circle-o"></i> Developer - Config</a>
			</li>
		</ul>
	</li>
</div>