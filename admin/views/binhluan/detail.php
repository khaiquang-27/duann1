<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
            <?php
            // Giả sử biến $listcomments được lấy từ cơ sở dữ liệu hoặc được truyền vào
            // Dưới đây là ví dụ dữ liệu (bạn sẽ thay bằng dữ liệu thực tế từ DB)
            // $listcomments = [
            //     [
            //         'ten' => 'Người dùng 1',
            //         'noi_dung' => 'Sản phẩm rất tốt!',
            //         'danh_gia' => 5,
            //         'ngay_binh_luan' => '2023-03-21',
            //         'ten_san_pham' => 'Sản phẩm A',
            //         'ma_san_pham' => 1,
            //         'ma_binh_luan' => 101,
            //     ],
            //     // Thêm các bình luận khác nếu có...
            // ];

            // Kiểm tra xem biến $listcomments đã được khởi tạo chưa và có dữ liệu hay không
            if (isset($listcomments) && !empty($listcomments)) {
                // Lấy tên sản phẩm từ phần tử đầu tiên trong mảng bình luận
                $ten_san_pham = $listcomments[0]['ten_san_pham'];
            ?>
                <!-- Tiêu đề danh sách bình luận -->
                <div class="row formtitle mb">
                    <h1>DANH SÁCH BÌNH LUẬN CỦA SẢN PHẨM <?= strtoupper(htmlspecialchars($ten_san_pham)) ?></h1>
                </div>

                <!-- Bảng hiển thị bình luận -->
                <table class="table" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Số Thứ Tự</th>
                            <th>Tên Người Dùng</th>
                            <th>Nội Dung</th>
                            <th>Đánh Giá</th>
                            <th>Ngày Bình Luận</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Duyệt qua tất cả các bình luận
                        foreach ($listcomments as $index => $comment) {
                            echo '<tr>';
                            echo '<td>' . ($index + 1) . '</td>'; // Số thứ tự bắt đầu từ 1
                            echo '<td>' . htmlspecialchars($comment['ten']) . '</td>'; // Tên người dùng
                            echo '<td>' . htmlspecialchars($comment['noi_dung']) . '</td>'; // Nội dung bình luận
                            echo '<td>';
                        
                            // Hiển thị sao dựa trên đánh giá
                            $danh_gia = $comment['danh_gia'];
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $danh_gia) {
                                    // Sao đầy (ri-star-fill)
                                    echo '<i class="ri-star-fill"></i>';
                                } else {
                                    // Sao rỗng (ri-star-line)
                                    echo '<i class="ri-star-line"></i>';
                                }
                            }
                            echo '</td>'; 
                            echo '<td>' . htmlspecialchars($comment['ngay_binh_luan']) . '</td>'; // Ngày bình luận
                            echo '<td><a class="btn btn-danger" href="index.php?act=xoa_binhluan&ma_san_pham=' . $comment['ma_san_pham'] . '&id=' . $comment['ma_binh_luan'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bình luận này?\')">Xóa</a></td>'; // Hành động
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <!-- Hiển thị khi không có bình luận -->
                <div class="row formtitle mb">
                    <h1>Không có bình luận cho sản phẩm này.</h1>
                </div>

                <!-- Bảng hiển thị với thông báo không có bình luận -->
                <table class="table" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Số Thứ Tự</th>
                            <th>Tên Người Dùng</th>
                            <th>Nội Dung</th>
                            <th>Đánh Giá</th>
                            <th>Ngày Bình Luận</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center">Không có bình luận.</td>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
            ?>
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->

</body>
</html>