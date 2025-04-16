<main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
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
                                <h5 class="text-center">Đăng Nhập</h5>
                                <form method="post">
    <div class="single-input-item">
        <input type="email" name="email" placeholder="Nhập Email" required />
    </div>
    <div class="single-input-item">
        <input type="password" name="password" placeholder="Nhập Mật Khẩu" required />
    </div>
    <div class="single-input-item d-flex justify-content-between text-warning">
        <a href="index.php?act=dangky" class=" text-warning">Chưa có tài khoản?</a>
        <a href="index.php?act=quenmatkhau" class="text-danger">Quên mật khẩu?</a>
    </div>
    <div class="single-input-item">
        <button class="btn btn-sqr">Đăng Nhập</button>
    </div>
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