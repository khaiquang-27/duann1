<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row">
    <div class="row formtitle mb">
        <h1>DANH SÁCH SẢN PHẨM HÀNG</h1>
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
                foreach ($listsanpham as $sanpham) {
                    extract($sanpham);
                    foreach ($listdanhmuc as $danhmuc) {
                        // var_dump($danhmuc['ma_danh_muc']);
                        if ($ma_danh_muc==$danhmuc['ma_danh_muc']) {
                            $tendanhmuc = $danhmuc['ten_danh_muc'];
                        }
                    }
                  
                    $suasp = "index.php?act=listdetailcomment&id=".$ma_san_pham;
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
                               <td>'.$tendanhmuc.'</td>
                               
                            <td>
                                <a href="'.$suasp.'"><input type="button" class="btn btn-primary" value="XEM BÌNH LUẬN"></a>
                               
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