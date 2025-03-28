<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
            <a href="index.php?act=adddm"><input class="btn btn-success" type="button" value="Thêm Danh Mục"></a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">MÃ DANH MỤC</th>
                            <th scope="col">TÊN DANH MỤC</th>
                            <th scope="col">MÔ TẢ</th>
                            <th scope="col">HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listdanhmuc as $danhmuc) {
                            extract($danhmuc);
                            $suadm = "index.php?act=suadm&id=" . $ma_danh_muc;
                            $xoadm = "index.php?act=xoadm&id=" . $ma_danh_muc;
                            echo ' <tr>
                           
                            <td>' . $ma_danh_muc . '</td>
                            <td>' . $ten_danh_muc . '</td>
                            <td>' . $mo_ta . '</td>
                            <td>
                                <a href="' . $suadm . '"><input type="button" class="btn btn-primary" value="SỬA"></a>
                                <a href="' . $xoadm . '"><input type="button" class="btn btn-danger" value="XÓA"></a>
                            </td>
                        </tr>';
                        }
                        ?>

                    </tbody>
                </table>
                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>