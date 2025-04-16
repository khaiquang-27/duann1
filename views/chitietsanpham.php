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
                                <li class="breadcrumb-item"><a href="index.php">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi Tiết Sản Phẩm <?= $oneproduct['ten_san_pham'] ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <?php
    $anh = './uploads/' . $oneproduct['anh_san_pham'] . '';
    ?>
    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="<?= $anh ?>" alt="product-details" />
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <form action="index.php?act=addtocart" method="post">
                                        <!-- Tên nhà sản xuất -->
                                        <div class="manufacturer-name">
                                            <a href="product-details.html">HasTech</a>
                                        </div>

                                        <!-- Tên sản phẩm -->
                                        <h3 class="product-name"><?= htmlspecialchars($oneproduct['ten_san_pham']) ?></h3>

                                        <!-- Giá sản phẩm -->
                                        <div class="price-box">
                                            <span class="price-regular"><?= number_format($oneproduct['gia']) ?> đ</span>
                                        </div>

                                        <!-- Mô tả sản phẩm -->
                                        <p class="pro-desc"><?= htmlspecialchars($oneproduct['mo_ta']) ?></p>

                                        <!-- Số lượng sản phẩm -->
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="number" name="so_luong" value="1" min="1">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lựa chọn màu sắc -->
                                        <div class="pro-size">
                                            <h6 class="option-title">Màu sắc:</h6>
                                            <select class="nice-select" name="mau_sac" required>
                                                <?php
                                                $mau_sac_arr = explode(',', $oneproduct['mau_sac']);
                                                foreach ($mau_sac_arr as $mau) {
                                                    $mau = htmlspecialchars(trim($mau));
                                                    echo "<option value=\"$mau\">" . ucfirst($mau) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Các thông tin ẩn -->
                                        <input type="hidden" name="ma_san_pham" value="<?= htmlspecialchars($oneproduct['ma_san_pham']) ?>">
                                        <input type="hidden" name="ten_san_pham" value="<?= htmlspecialchars($oneproduct['ten_san_pham']) ?>">
                                        <input type="hidden" name="gia" value="<?= htmlspecialchars($oneproduct['gia']) ?>">
                                        <input type="hidden" name="anh_san_pham" value="<?= $anh ?>">


                                        <!-- Hành động thêm vào giỏ hàng -->
                                        <?php if (isset($_SESSION['user'])) { ?>
                                            <div class="action_link">
                                                <button type="submit" class="btn btn-cart2">Thêm Vào Giỏ Hàng</button>
                                            </div>
                                        <?php } else { ?>
                                            <div class="action_link">
                                                <a class="btn btn-cart2" href="index.php?act=dangnhap">Đăng Nhập Để Mua Hàng</a>
                                            </div>
                                        <?php } ?>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">Mô Tả</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_two">Thông Tin</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">Bình Luận</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p><?= $oneproduct['mo_ta'] ?></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>color</td>
                                                        <td> <?= $oneproduct['mau_sac'] ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">

                                            <h5>Bình Luận</h5>
                                            <?php
                                            foreach ($load_all_binhluan as $load_all_binhluan) {
                                                extract($load_all_binhluan);

                                                // Tạo biến chứa các sao tương ứng với giá trị danh_gia
                                                $ratingStars = '';
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $danh_gia) {
                                                        $ratingStars .= '<span class="good"><i class="fa fa-star"></i></span>';
                                                    } else {
                                                        $ratingStars .= '';
                                                    }
                                                }

                                                // Hiển thị bình luận với đánh giá sao
                                                echo '
                                                    <div class="total-reviews">
                                                        <div class="rev-avatar">
                                                            <img src="./views/assets/img/user.jpg" alt="">
                                                        </div>
                                                        <div class="review-box">
                                                            <div class="ratings">
                                                                ' . $ratingStars . '
                                                            </div>
                                                            <div class="post-author">
                                                                <p><span>' . $ten_nguoi_dung . ' -</span> ' . $ngay_binh_luan . '</p>
                                                            </div>
                                                            <p>' . $noi_dung . '</p>
                                                        </div>
                                                    </div>';
                                            }
                                            ?>


<?php
if (isset($_SESSION['user']['ma_nguoi_dung'])) {
    $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
    // Kiểm tra xem người dùng đã mua sản phẩm này hay chưa
    $check_purchase = check_user_purchase($ma_nguoi_dung, $ma_san_pham);
    // var_dump($check_purchase);
    // die();

    if ($check_purchase) {
        // Hiển thị form bình luận
        ?>
        <form action="index.php?act=add_comment" method="POST" class="review-form">
            <input type="hidden" name="ma_san_pham" value="<?= $ma_san_pham ?>">
            <input type="hidden" name="ma_nguoi_dung" value="<?= $ma_nguoi_dung ?>">
            
            <div class="form-group row">
                <div class="col">
                    <label class="col-form-label"><span class="text-danger">*</span> Bình Luận Của Bạn</label>
                    <textarea class="form-control" name="noi_dung" required></textarea>
                </div>
            </div>
            <div class="form-group row">
               
                    <label class="col-form-label"> Đánh Giá</label>
                    <div class="form-check">
                        <input type="radio"  value="1" name="danh_gia">
                        <label class="form-check-label" for="flexRadioDisabled">1 sao</label>
                    </div>
                    <div class="form-check">
                        <input type="radio"  value="2" name="danh_gia">
                    <label class="form-check-label" for="flexRadioDisabled">2 sao</label>
                    </div>
                    <div class="form-check">
                        <input type="radio"  value="3" name="danh_gia">
                    <label class="form-check-label" for="flexRadioDisabled">3 sao</label>
                    </div>
                    <div class="form-check">
                        <input type="radio"  value="4" name="danh_gia">
                    <label class="form-check-label" for="flexRadioDisabled">4 sao</label>
                    </div>
                    <div class="form-check">
                        <input type="radio"  value="5" name="danh_gia" checked>
                    <label class="form-check-label" for="flexRadioDisabled">5 sao</label>
                    </div>
            
               
            </div>
            <div class="buttons">
                <button class="btn btn-sqr" type="submit">Gửi Bình Luận</button>
            </div>
        </form>
        <?php
    } else {
        echo '<p class="text-danger">Bạn phải mua sản phẩm này trước khi bình luận.</p>';
    }
} else {
    echo '<p class="text-danger">Vui lòng đăng nhập để bình luận.</p>';
}
?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản Phẩm Cùng Loại</h2>

                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->

                        <?php
                        // var_dump($loadall_product_home);
                        foreach ($product_cung_loai as $product_new) {
                            extract($product_new);
                            $anh = "./uploads/" . $anh_san_pham;
                            $linksp = "index.php?act=chitietsanpham&ma_san_pham=" . $ma_san_pham;

                            // Chuyển đổi chuỗi màu sắc thành mảng
                            $mau_sac_arr = explode(',', $mau_sac);

                            echo '                      
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
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="' . $linksp . '">' . $ten_san_pham . '</a></p>
                                    </div>
                                    <ul class="color-categories">';

                            // Đổ danh sách màu sắc
                            foreach ($mau_sac_arr as $mau) {
                                echo '<li class="d-inline-block mx-1">
                                    <a class="color-circle" href="#" style="background-color: ' . trim($mau) . ';" title="' . ucfirst(trim($mau)) . '"></a>
                                </li>';
                            }

                            echo '</ul>
                                <h6 class="product-name">
                                    <a href="' . $linksp . '">' . $ten_san_pham . '</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">' . number_format($gia) . ' đ</span>
                                </div>
                                </div>
                            </div>';
                        }
                        ?>
                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>