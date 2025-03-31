<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row">
                    <div class="row formtitle mb">
                        <h1>DANH SÁCH SẢN PHẨM HÀNG</h1>
                    </div>

                    <div class="row formcontent">
                        <div class="row mb10 formdsloai">
                            <table class="table table-hover">
                                <tr>
                                    <th>Mã Sản Phẩm</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Hình</th>
                                    <th>Mã loại</th>
                                    <th>Hành động</th>
                                </tr>
                                <?php
                                // Kiểm tra xem $listsanpham có tồn tại và không rỗng
                                if (isset($listsanpham) && !empty($listsanpham)) {
                                    // Duyệt qua từng sản phẩm trong $listsanpham
                                    foreach ($listsanpham as $sanpham) {
                                        extract($sanpham);
                                        
                                        // Tìm tên danh mục phù hợp cho sản phẩm
                                        $tendanhmuc = '';
                                        if (isset($listdanhmuc) && !empty($listdanhmuc)) {
                                            foreach ($listdanhmuc as $danhmuc) {
                                                if ($ma_danh_muc == $danhmuc['ma_danh_muc']) {
                                                    $tendanhmuc = $danhmuc['ten_danh_muc'];
                                                }
                                            }
                                        }

                                        // Xử lý hình ảnh sản phẩm
                                        $img = isset($sanpham['anh_san_pham']) ? $sanpham['anh_san_pham'] : '';
                                        $anh = "../uploads/" . $img;

                                        if (is_file($anh)) {
                                            $hinh = "<img src='" . $anh . "' height='80px'>";
                                        } else {
                                            $hinh = "no photo";
                                        }

                                        // Liên kết hành động xem bình luận
                                        $suasp = "index.php?act=listdetailcomment&id=" . $ma_san_pham;

                                        echo '<tr>
                                                <td>' . $ma_san_pham . '</td>
                                                <td><a href="' . $suasp . '"> ' . $ten_san_pham . '</a></td>
                                                <td>' . $hinh . '</td>
                                                <td>' . $tendanhmuc . '</td>
                                                <td>
                                                    <a href="' . $suasp . '"><input type="button" class="btn btn-primary" value="XEM BÌNH LUẬN"></a>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    // Trường hợp không có sản phẩm nào
                                    echo '<tr>
                                            <td colspan="5" class="text-center">Không có sản phẩm nào.</td>
                                          </tr>';
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>
