<?php
function loadone_binhluan($id)
{
    $sql = "SELECT 
    binhluan.ma_binh_luan, 
    sanpham.ten_san_pham,
    sanpham.ma_san_pham,
    nguoidung.ten,
    binhluan.noi_dung,
    binhluan.danh_gia,
    binhluan.ngay_binh_luan
FROM 
    binhluan
INNER JOIN 
    sanpham 
ON 
    binhluan.ma_san_pham = sanpham.ma_san_pham
INNER JOIN 
    nguoidung 
ON 
    binhluan.ma_nguoi_dung = nguoidung.ma_nguoi_dung
WHERE 
    binhluan.ma_san_pham = " . $id;
    $listcomments = pdo_query($sql);
    return $listcomments;
}



function load_all_binhluan($id)
{
    $sql = "SELECT 
    nguoidung.ten AS ten_nguoi_dung,
    binhluan.noi_dung,
    binhluan.danh_gia,
    binhluan.ngay_binh_luan
FROM 
    binhluan
INNER JOIN 
    nguoidung 
ON 
    binhluan.ma_nguoi_dung = nguoidung.ma_nguoi_dung
WHERE 
    binhluan.ma_san_pham =". $id;
    $listcomments = pdo_query($sql);
    return $listcomments;
}

function check_user_purchase($ma_nguoi_dung, $ma_san_pham) {
    $sql = "SELECT COUNT(*) FROM donhang d
            JOIN chitietdonhang c ON d.ma_don_hang = c.ma_don_hang
            WHERE d.ma_nguoi_dung = $ma_nguoi_dung AND c.ma_san_pham = $ma_san_pham AND d.trang_thai = 3"; // 3 là trạng thái hoàn thành
    return pdo_query_value($sql) > 0;
}
function add_comment($ma_nguoi_dung, $ma_san_pham, $noi_dung, $danh_gia, $ngay_binh_luan) {
    $sql = "INSERT INTO binhluan (ma_nguoi_dung, ma_san_pham, noi_dung, danh_gia, ngay_binh_luan) 
            VALUES ('$ma_nguoi_dung', '$ma_san_pham','$noi_dung','$danh_gia','$ngay_binh_luan')";
    pdo_execute($sql);
}


// function delete_danhmuc($id){
//     $sql="delete from danhmucsanpham where ma_danh_muc=".$id;
//     pdo_execute($sql);
// }
// function loadall_danhmuc(){
//     $sql="select * from danhmucsanpham ";
//     $listdanhmuc = pdo_query($sql);
//     return $listdanhmuc;
// }
// function loadone_danhmuc($id){
//     $sql="select * from danhmucsanpham where ma_danh_muc=".$id;
//     $dm = pdo_query_one($sql);
//     return $dm;
// }
// function update_danhmuc($madanhmuc, $tendanhmuc,$mota){
//     $sql="update danhmucsanpham set ten_danh_muc='".$tendanhmuc."' ,mo_ta='".$mota."'  where ma_danh_muc=".$madanhmuc;
//     pdo_execute($sql);
// }
// Hàm xóa bình luận theo ID
function delete_binhluan($id)
{
    // Câu lệnh SQL để xóa bình luận theo ID
    $sql = "DELETE FROM binhluan WHERE ma_binh_luan = " . $id;
    pdo_execute($sql); // Sử dụng hàm pdo_execute để thực thi câu lệnh SQL
}
