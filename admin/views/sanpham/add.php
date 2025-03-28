<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row"></div>
                <div class="row formtitle">
                    <h1>THÊM MỚI SẢN PHẨM</h1>
                </div>
                <div class="row formcontent">
                    <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">
                        <div class=" mb-3  ">
                        <label for="exampleFormControlInput1" class="form-label">Danh Mục</label>
                            <select name="ma_danh_muc" class="form-select">
                                <?php
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $ma_danh_muc . '" style="width: auto;">' . $ten_danh_muc . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" name="ten_san_pham" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Giá Sản Phẩm</label>
                            <input type="number" name="gia" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Hình Sản Phẩm</label>
                            <input class="form-control" type="file" name="anh_san_pham">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="" rows="3" name="mo_ta"></textarea>
                        </div>
                        <!-- <div class="row mb10 input-group mb-3">
                            TÊN SẢN PHẨM <br>
                            <input type="text" name="ten_san_pham">
                        </div> -->
                        <!-- 
                        <div class="row mb10 input-group mb-3">
                            GIÁ <br>
                            <input type="text" name="gia">
                        </div> -->
                        <!-- <div class="row mb10 input-group mb-3">
                            HÌNH <br>
                            <input type="file" name="anh_san_pham">
                        </div> -->
                       
                        <!-- <div class="row mb10 input-group mb-3">
                            MÔ TẢ<br>
                            <textarea name="mo_ta" id=""></textarea>
                        </div> -->
                        <div id="variations">
                            <!-- Vùng này sẽ chứa các biến thể -->
                            <div class="row mb10 input-group mb-3">
                            <label for="" class="form-label">Màu Sắc</label>
                                <label><input class="form-check-input"  type="checkbox" name="mau_sac[]" value="black"> Đen</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="white"> Trắng</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="yellow"> Vàng</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="blue"> Xanh</label><br>
                            </div>

                            <div class="mb-3">
                            <label for="" class="form-label">Số Lượng</label>
                                <input type="text" class="form-control" name="so_luong">
                            </div>

                            <div class="flex mt-3">
                                <input class="btn btn-success" type="submit" name="themmoi" value="Thêm mới" style="width: auto;">
                                <input class="btn btn-warning" type="reset" value="Nhập lại" style="width: auto;">
                                <a href="index.php?act=listsp"><input  class="btn btn-primary" type="button" value="danhsach"></a>
                            </div>
                            <?php
                            if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
                            ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- nhập content -->
    </div>
</div>
</div>
</div>
<script>
    // Function to validate the form
    function validateForm() {
        // Get form values
        var tenSanPham = document.querySelector('input[name="ten_san_pham"]').value;
        var gia = document.querySelector('input[name="gia"]').value;
        var soLuong = document.querySelector('input[name="so_luong"]').value;
        var mauSac = document.querySelectorAll('input[name="mau_sac[]"]:checked');
        
        // Validate product name
        if (tenSanPham.trim() === "") {
            alert("Tên sản phẩm không được để trống.");
            return false;
        }

        // Validate price (ensure it's a number)
        if (gia.trim() === "" || isNaN(gia) || gia <= 0) {
            alert("Vui lòng nhập giá sản phẩm hợp lệ.");
            return false;
        }

        // Validate quantity (ensure it's a number)
        if (soLuong.trim() === "" || isNaN(soLuong) || soLuong <= 0) {
            alert("Vui lòng nhập số lượng sản phẩm hợp lệ.");
            return false;
        }

        // Validate that at least one color is selected
        if (mauSac.length === 0) {
            alert("Vui lòng chọn ít nhất một màu sắc.");
            return false;
        }

        // If all checks pass, allow form submission
        return true;
    }

    // Attach validation to the form's submit event
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
</script>
