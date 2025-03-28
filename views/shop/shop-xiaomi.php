<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh Sách Huawei</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- shop main wrapper start -->
                <div class="col-lg-12">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                    <form action="index.php?act=shopxiaomi" method="post" class="header-search-box d-lg-none d-xl-block">
                                            <input type="text" name="kyw" placeholder="Search entire store hire" class="header-search-field">
                                            <button type="submit" name="timkiem" class="header-search-btn"><i class="pe-7s-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            <?php


                            foreach ($product_shop_xiaomi as $product) {
                                extract($product);
                                $anh = "./uploads/" . $anh_san_pham;
                                $linksp = "index.php?act=chitietsanpham&ma_san_pham=" . $ma_san_pham;
                                // Chuyển đổi chuỗi màu sắc thành mảng
                                $mau_sac_arr = explode(',', $mau_sac);
                                echo '
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="' . $linksp . '">
                                                <img class="pri-img" src="' . $anh . '" alt="product">
                                                <img class="sec-img" src="' . $anh . '" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                              
                                            </div>
                                           
                                          
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                             
                                            </div>
                                            <ul class="color-categories">';

                                // Đổ danh sách màu sắc
                                foreach ($mau_sac_arr as $mau) {
                                    echo '<li class="d-inline-block mx-1">
                                                        <a class="color-circle" href="#" style="background-color: ' . trim($mau) . ';" title="' . ucfirst(trim($mau)) . '"></a>
                                                    </li>';
                                }

                                echo ' </ul>
                                            <h6 class="product-name">
                                                <a href="' . $linksp . '">' . $ten_san_pham . '</a>
                                            </h6>
                                            <div class="price-box">
                                                <span class="price-regular">' . number_format($gia) . ' đ</span>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                    
                                </div>  ';
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>