<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title>404</title>
	{!! SEO::generate() !!}
	<meta name='revisit-after' content='1 days' />
	<meta name="copyright" content="GCO" />
	<meta http-equiv="content-language" content="vi" />
	<meta name="geo.region" content="VN" />
    <meta name="geo.position" content="10.764338, 106.69208" />
    <meta name="geo.placename" content="Hà Nội" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
 	<meta name="_token" content="{{csrf_token()}}" />
 	<link rel="canonical" href="{{ \Request::fullUrl() }}">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-b/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-animate/animate.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-b/jquery-ui.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-icon/all.min.css">
	
	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-slide/owl.carousel.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style-animate/aos.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/style.css">

	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/custom.css">
	
	<link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/skins/toastr.min.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

</head> 
	<body class="page-body home-body">

		<div class="page-404" style="background: url('{{url('/').'/public/frontend/images/bg-404.jpg'}}')">
            <div class="container">
                <div class="box_content">
                    <h1 class="h1-title">404</h1>
                    <h2 class="h2-title">Không tìm thấy trang</h2>
                    <h3 class="h3-title">Trang đã bị xóa hoặc địa chỉ URL không đúng</h3>
                    <div class="link-index">
                        <a href="{{route('home.index')}}" class="btn btn_index">Quay về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>

	</body>
</html>