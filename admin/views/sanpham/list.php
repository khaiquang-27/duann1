<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row">
    <div class="row formtitle mb">
        <h1>DANH SÁCH SẢN PHẨM HÀNG</h1>
        <form action="index.php?act=listsp" method="POST">
    <input type="text" name="kyw" placeholder="Tìm kiếm sản phẩm" value="<?php echo isset($kyw) ? $kyw : ''; ?>" class="form-control mb-3">
    
    <!-- Lọc theo danh mục -->
    <select name="iddm" class="form-select mb-3">
        <option value="0">Chọn danh mục</option>
        <?php
        foreach ($listdanhmuc as $danhmuc) {
            echo '<option value="' . $danhmuc['ma_danh_muc'] . '"';
            if ($iddm == $danhmuc['ma_danh_muc']) echo ' selected';
            echo '>' . $danhmuc['ten_danh_muc'] . '</option>';
        }
        ?>
    </select>

    <!-- Lọc theo giá -->
    <select name="sort_price" class="form-select mb-3">
        <option value="asc" <?php echo isset($sort_price) && $sort_price == 'asc' ? 'selected' : ''; ?>>Giá từ thấp đến cao</option>
        <option value="desc" <?php echo isset($sort_price) && $sort_price == 'desc' ? 'selected' : ''; ?>>Giá từ cao đến thấp</option>
    </select>
    
    <!-- Nút tìm kiếm -->
    <input type="submit" name="listok" value="Tìm kiếm" class="btn btn-primary">
</form>
    </div>
    <!-- <form action="index.php?act=listsp" method="post">
                <input type="text" name="kyw">
                <select name="ma_danh_muc" >
                    <option value="0" selected>Tất cả</option>
                            <?php 
                            foreach($listdanhmuc as $danhmuc){
                                extract($danhmuc);
                                echo '<option value="'.$ma_san_pham.'">'.$ten_san_pham.'</option>';
                            }
                            ?>
                            
                        </select>
                        <input type="submit" name="listok" value="GO">
            </form> -->
            <a href="index.php?act=addsp"><input class="btn btn-success" type="button" value="Thêm Sản Phẩm"></a>
    <div class="row formcontent">
        <div class="row mb10 formdsloai">
            
            <table class="table table-hover">
                <tr>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    
                    <th>Mã loại</th>
                    <th>Hành Động</th>
                </tr>
                <?php
                foreach ($listsanpham as $sanpham) {
                    extract($sanpham);
                    foreach ($listdanhmuc as $danhmuc) {
                        // var_dump($danhmuc['ma_danh_muc']);
                        if ($ma_danh_muc==$danhmuc['ma_danh_muc']) {
                            $tendanhmuc = $danhmuc['ten_danh_muc'];
                        }
                    }
                  
                    $suasp = "index.php?act=suasp&id=".$ma_san_pham;
                    $xoasp = "index.php?act=xoasp&id=".$ma_san_pham;
                    $img = isset($sanpham['anh_san_pham']) ? $sanpham['anh_san_pham'] : ''; // Gán giá trị từ cột 'anh_san_pham'
                    $anh = "../uploads/" . $img;

                    if(is_file($anh)){
                        $hinh="<img src='".$anh."' height='80px'>";
                    }else{
                        $hinh = "no photo";
                    }
                    echo '<tr>
            
                            <td>'.$ma_san_pham.'</td>
                            <td><a href="'.$suasp.'"> '.$ten_san_pham.'</a></td>
                             <td>'.$hinh.'</td>
                              <td>'.$gia.'</td>
                               <td>'.$tendanhmuc.'</td>
                               <td></td>
                            <td>
                                <a href="'.$suasp.'"><input type="button" class="btn btn-primary" value="SỬA"></a>
                                <a href="'.$xoasp.'"><input type="button" class="btn btn-danger" value="XÓA"></a>
                            </td>
                        </tr> ';
                }
                ?>
            </table>
            
        </div>
        <div class="row mb10">
            <!-- <input type="button" value="Chọn tất cả">
            <input type="button" value="Bỏ chọn tất cả">
            <input type="button" value="Xóa các mục đã chọn"> -->
        </div>
    </div>
</div>
                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>