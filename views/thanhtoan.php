<main>
    <div class="checkout-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Thông Tin Thanh Toán</h5>  
                        <div class="billing-form-wrap">
                            <form action="index.php?act=confirmcheckout" method="post">
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <div class="single-input-item">
                                        <label for="ho_ten" class="required">Họ và Tên</label>
                                        <input type="text" id="ho_ten" name="ho_ten" value="<?= htmlspecialchars($_SESSION['user']['ten']) ?>" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="so_dien_thoai" class="required">Số điện thoại</label>
                                        <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="<?= htmlspecialchars($_SESSION['user']['so_dien_thoai']) ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="dia_chi" class="required">Địa chỉ</label>
                                        <input type="text" id="dia_chi" name="dia_chi" value="<?= htmlspecialchars($_SESSION['user']['dia_chi']) ?>" required />
                                    </div>

                                    <div class="form-check mt-3">
                                        <input type="radio" id="tienmat" class="form-check-input" name="pttt" value="1" checked>
                                        <label for="tienmat" class="form-check-label">Thanh toán tiền mặt</label><br>
                                        <input type="radio" id="chuyenkhoan" class="form-check-input" name="pttt" value="0">
                                        <label for="chuyenkhoan" class="form-check-label">Thanh toán bằng chuyển khoản</label><br>
                                    </div>

                                    <!-- Hidden inputs for cart items -->
                                    <?php
                                    $tong_tien_gio_hang = 0;
                                    $valid_cart = !empty($_SESSION['cart']);
                                    if ($valid_cart) {
                                        foreach ($_SESSION['cart'] as $index => $item) {
                                            $so_luong = max(1, intval($item['so_luong']));
                                            $tong_tien = $item['gia'] * $so_luong;
                                            $tong_tien_gio_hang += $tong_tien;
                                            echo '<input type="hidden" name="cart[' . htmlspecialchars($index) . '][id]" value="' . htmlspecialchars($item['id']) . '" />'; 
                                            echo '<input type="hidden" name="cart[' . htmlspecialchars($index) . '][ten]" value="' . htmlspecialchars($item['ten']) . '" />'; 
                                            echo '<input type="hidden" name="cart[' . htmlspecialchars($index) . '][mau_sac]" value="' . htmlspecialchars($item['mau_sac']) . '" />'; 
                                            echo '<input type="hidden" name="cart[' . htmlspecialchars($index) . '][gia]" value="' . $item['gia'] . '" />'; 
                                            echo '<input type="hidden" name="cart[' . htmlspecialchars($index) . '][so_luong]" value="' . $item['so_luong'] . '" />'; 
                                        }
                                    }
                                    ?>
                                <?php } else { ?>
                                    <p>Vui lòng <a href="index.php?act=dangnhap">đăng nhập</a> để tiếp tục thanh toán.</p>
                                <?php } ?>

                                <input type="hidden" name="tong_tien" value="<?= $valid_cart ? $tong_tien_gio_hang + 30000 : 30000 ?>" />
                                <button type="submit" class="btn btn-sqr mt-3" <?= !$valid_cart ? 'disabled' : '' ?>>Xác Nhận Đặt Hàng</button>
                                <?php if (!$valid_cart && !empty($_SESSION['cart'])) { ?>
                                    <p class="text-danger mt-2">Giỏ hàng chứa dữ liệu không hợp lệ. Vui lòng kiểm tra lại giỏ hàng.</p>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Thông Tin Đơn Hàng</h5>
                        <div class="order-summary-content">
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($valid_cart) {
                                        // Tính tổng tiền giỏ hàng
                                        $tong_tien_gio_hang = 0;

                                        foreach ($_SESSION['cart'] as $index => $item) {
                                            // Lấy số lượng và tính thành tiền
                                            $so_luong = max(1, intval($item['so_luong']));
                                            $tong_tien = $item['gia'] * $so_luong;
                                            $tong_tien_gio_hang += $tong_tien;

                                            // Hiển thị thông tin sản phẩm
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($item['ten']) . ' (' . htmlspecialchars($item['mau_sac']) . ')</td>';
                                            echo '<td>' . $so_luong . '</td>';
                                            echo '<td>' . number_format($tong_tien) . ' đ</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="3">Giỏ hàng trống hoặc không hợp lệ</td></tr>';
                                    }
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Phí vận chuyển</td>
                                            <td><strong>30,000 đ</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Tổng tiền</td>
                                            <td><strong><?= number_format($tong_tien_gio_hang  + 30000) ?> đ</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
