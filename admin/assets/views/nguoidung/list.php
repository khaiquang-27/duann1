<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row">
                    <div class="row formtitle mb">
                        <h1>DANH SÁCH NGƯỜI DÙNG</h1>
                    </div>

                    <div class="row formcontent">
                        <div class="row mb10 formdsloai">

                            <table class="table table-hover">
                                <tr>
                                    <th>Mã người dùng</th>
                                    <th>Tên người dùng</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Loại người dùng</th>
                                    <th>Trạng thái</th>
                                </tr>
                                <?php
                                foreach ($list_account as $list_account) {
                                    extract($list_account);

                                    // Xử lý ảnh đại diện
                                    $img = isset($list_account['anh_dai_dien']) ? $list_account['anh_dai_dien'] : '';
                                    $anh = "../uploads/" . $img;

                                    if (is_file($anh)) {
                                        $hinh = "<img src='" . $anh . "' height='80px'>";
                                    } else {
                                        $hinh = "no photo";
                                    }

                                    // Xử lý trạng thái
                                    $checked = ($trang_thai == '1') ? 'checked' : '';

                                    echo '
        <tr>
            <td>' . $ma_nguoi_dung . '</td>
            <td>' . $ten . '</td>
            <td>' . $hinh . '</td>
            <td>' . $email . '</td>
            <td>' . $so_dien_thoai . '</td>
            <td>' . $loai_nguoi_dung . '</td>
            <td style="text-align: center;">
                 <form action="index.php?act=updatetrangthai" method="post">
                <div class="form-switch">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="switch_' . $ma_nguoi_dung . '" 
                        name="status" 
                        value="1" '  // Giá trị khi checkbox được tick
                        . $checked . ' 
                        onchange="this.form.submit()">  <!-- Khi thay đổi, form tự submit -->
                    <input type="hidden" name="user_id" value="' . $ma_nguoi_dung . '"> <!-- Lưu ID người dùng -->
                </div>
            </form>
            </td>
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