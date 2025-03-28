<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
            <?php
// Kiểm tra xem có bình luận nào không
if ($listcomments) {
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
    <table class="table">
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
            <td colspan="6">Không có bình luận</td>
        </tbody>
    </table>
<?php
}
?>



                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>