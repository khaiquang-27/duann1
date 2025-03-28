<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row formtitle"><h1>THÊM MỚI LOẠI HÀNG HÓA</h1></div>
            <div class="row formcontent">
                <form action="index.php?act=adddm" method="post">
                    <div class="row mb10">
                    <label for="exampleFormControlInput1" class="form-label">Tên Danh Mục</label>
                        <input type="text" class="form-control" name="ten_danh_muc">
                    </div>
                    <div class="row mb10">
                    <label for="exampleFormControlInput1" class="form-label">Mô Tả</label>
                        <input type="text" class="form-control" name="mo_ta">
                    </div>
                    <div class="flex mt-2 gap-2">
                        <input class="btn btn-success" type="submit" name="themmoi" value="Thêm mới" style="width: auto;">
                        <input type="reset" class="btn btn-warning" value="Nhập lại" style="width: auto;">
                        <a  href="index.php?act=lisdm"><input class="btn btn-primary" type="button" value="danhsach"></a>
                    </div>
                    <?php 
                    if(isset($thongbao)&&($thongbao!="")) echo $thongbao; 
                    ?>
                </form>
            </div>
        </div>
                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>
<script>
    // Hàm kiểm tra form
    function validateForm() {
        // Lấy giá trị từ các trường trong form
        var tenDanhMuc = document.querySelector('input[name="ten_danh_muc"]').value;
        var moTa = document.querySelector('input[name="mo_ta"]').value;

        // Kiểm tra trường "Tên Danh Mục"
        if (tenDanhMuc.trim() === "") {
            alert("Tên danh mục không được để trống.");
            return false;
        }

        // Kiểm tra trường "Mô Tả"
        if (moTa.trim() === "") {
            alert("Mô tả không được để trống.");
            return false;
        }

        // Nếu tất cả các trường hợp kiểm tra hợp lệ, cho phép gửi form
        return true;
    }

    // Gắn sự kiện submit cho form
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Ngừng việc gửi form nếu kiểm tra không hợp lệ
        }
    });
</script>
