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
                                <li class="breadcrumb-item active" aria-current="page">Cập Nhật Tài Khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <?php
                    if (isset($thongbao)) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo:</strong> ' . $thongbao . '
          </div>';
                    }
                    ?>
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">Cập nhật tài khoản</h5>
                            <form action="index.php?act=update_account" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="ho_ten" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="<?= htmlspecialchars($user['ten']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="anh_dai_dien" class="form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="anh_dai_dien" />
                                    <img src="./uploads/<?= ($user['anh_dai_dien']) ?>" alt="" width="100px" height="100px">
                                </div>
                                <div class="mb-3">
                                    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?= htmlspecialchars($user['so_dien_thoai']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="dia_chi" class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" id="dia_chi" name="dia_chi" required><?= htmlspecialchars($user['dia_chi']) ?></textarea>
                                </div>
                            <input type="hidden" name="anh_dai_dien_cu" value="<?php echo $user['anh_dai_dien']; ?>">
                                <button type="submit" class="btn btn-sqr">Cập nhật</button>

                            </form>

                        </div>
                    </div>
                    <!-- Login Content End -->


                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>