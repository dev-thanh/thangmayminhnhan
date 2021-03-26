<article class="art-products art-products-featured art-margin-top">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="products-box">
                    <div class="title-box title-products">
                        <h3 class="title"><span>Sản phẩm nổi bật</span></h3>
                    </div>

                    <div class="products-content">
                        <div class="slick-slider slick-products-featured">
                            @foreach ($product_hots as $item)
                            <div class="item">
                                <div class="product-box">
                                    <div class="product-image">
                                        <a href="{{ route('home.single-product', ['slug' => $item->slug]) }}" title="{{ $item->name }}">
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" style="max-width: 374px; max-height: 270px; width: 100%; height: 100%;">
                                        </a>
                                    </div>
                                    <!-- <div class="product-content">
                                        <div class="product-button">
                                            <a href="product-details.php" title="Xem chi tiết">
                                                <span>Xem chi tiết</span>
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            @endforeach
                        </div>								
                    </div>
                </div>
            </div>
        </div>
    </div>
</article> <!-- art-products -->