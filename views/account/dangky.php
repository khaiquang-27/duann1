<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng Ký</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-register-wrapper section-padding">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $ten = $_POST['ten'];
                        $email = $_POST['email'];
                        $mat_khau = $_POST['mat_khau'];
                        $re_mat_khau = $_POST['re_mat_khau'];
                        $so_dien_thoai = $_POST['so_dien_thoai'];
                        $dia_chi = $_POST['dia_chi'];
                        $hinh = "";

                        if ($_FILES['anh_dai_dien']['error'] === 0) {
                            $hinh = $_FILES['anh_dai_dien']['name'];
                            move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], "uploads/" . $hinh);
                        }

                        if ($mat_khau !== $re_mat_khau) {
                            $thongbao = "⚠️ Mật khẩu không khớp. Vui lòng nhập lại.";
                        } else {
                            $hashed_password = password_hash($mat_khau, PASSWORD_BCRYPT);
                            try {
                                insert_user($ten, $email, $hashed_password, $hinh, $so_dien_thoai, $dia_chi);
                                $thongbao = "✅ Đăng ký thành công!";
                            } catch (Exception $e) {
                                $thongbao = "❌ " . $e->getMessage();
                            }
                        }
                    }

                    if (isset($thongbao)) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Thông báo:</strong> ' . $thongbao . '
                              </div>';
                    }
                    ?>

                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5 class="text-center">Đăng Ký</h5>
                            <form method="POST" enctype="multipart/form-data">
    <div class="single-input-item">
        <input type="text" name="ten" placeholder="Tên" required />
    </div>
    <div class="single-input-item">
        <input type="email" name="email" placeholder="Email" required />
    </div>
    <div class="single-input-item">
        <label>Ảnh đại diện</label>
        <input type="file" name="anh_dai_dien" />
    </div>
    <div class="single-input-item">
        <input type="number" name="so_dien_thoai" placeholder="Số điện thoại" required />
    </div>
    <div class="single-input-item">
        <input type="text" name="dia_chi" placeholder="Địa chỉ" required />
    </div>
    <div class="single-input-item">
        <input type="password" name="mat_khau" placeholder="Mật khẩu" required />
    </div>
    <div class="single-input-item">
        <input type="password" name="re_mat_khau" placeholder="Nhập lại mật khẩu" required />
    </div>
    <div class="single-input-item">
        <button type="submit" class="btn btn-sqr">Đăng ký</button>
    </div>
    <?php if (isset($thongbao)) : ?>
        <div class="alert alert-warning mt-2"><?= $thongbao ?></div>
    <?php endif; ?>
</form>

                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
</main>
