<main>
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <!-- nhập content -->
                    <h3 class="text-center mb-3">Sản phẩm trong đơn hàng</h3>
                    <table class="table table-bordered" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Màu sắc</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                                <th>Link sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($chitiets as $item): ?>
                                <tr>
                                    <td><?= $item['ten_san_pham'] ?></td>
                                    <td><?= $item['so_luong'] ?></td>
                                    <td><?= $item['mau_sac'] ?></td>
                                    <td><?= number_format($item['gia'], 0, ',', '.') ?> VNĐ</td>
                                    <td><?= number_format($item['thanh_tien'], 0, ',', '.') ?> VNĐ</td>
                                  <td>  <a class="btn btn-sqr" href="index.php?act=chitietsanpham&ma_san_pham=<?= $item['ma_san_pham'] ?>">Xem sản phẩm</a> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a class="btn btn-sqr" href="index.php?act=donhangcuatoi">Quay Lại</a>

                    <!-- nhập content -->
                </div>
            </div>
        </div>
    </div>
</main>