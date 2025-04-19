<main>
    <?php
    if (isset($_SESSION['user']['ma_nguoi_dung'])):
        $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
        $donhangs = get_donhang_by_user($ma_nguoi_dung);
    ?>
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table table-responsive">
                                <h2 class="text-center mb-4">Danh sách đơn hàng của bạn</h2>

                                <?php if (!empty($donhangs)): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($donhangs as $donhang): ?>
                                                <tr>
                                                    <td><?= $donhang['ma_don_hang']; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($donhang['ngay_dat'])); ?></td>
                                                    <td><?= number_format($donhang['tong_tien'], 0, ',', '.') ?> VND</td>
                                                    <td><?= $donhang['trang_thai']; ?></td>
                                                    <td><?= $donhang['pttt'] == 0 ? 'Chuyển khoản' : 'Tiền mặt'; ?></td>
                                                    <td>
                                                        <a class="btn btn-sqr mb-1" href="index.php?act=donhang_detail&id=<?= $donhang['ma_don_hang'] ?>">Xem chi tiết</a>
                                                        <?php if (trim($donhang['trang_thai']) == 'Chờ xử lý'): ?>
                                                            <form action="index.php?act=huy_donhang" method="post" style="display:inline;">
                                                                <input type="hidden" name="ma_don_hang" value="<?= $donhang['ma_don_hang'] ?>">
                                                                <button class="btn btn-sqr mb-1" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">Hủy đơn</button>
                                                            </form>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Bạn chưa có đơn hàng nào.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Bạn cần đăng nhập để xem đơn hàng.</p>
    <?php endif; ?>
</main>
