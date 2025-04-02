<?php 
function insert_danhmuc($tendanhmuc,$mota){
    $sql="insert into danhmucsanpham(ten_danh_muc,mo_ta) values('$tendanhmuc','$mota')";
    pdo_execute($sql);
}
function delete_danhmuc($id){
    $sql="delete from danhmucsanpham where ma_danh_muc=".$id;
    pdo_execute($sql);
}
function loadall_danhmuc(){
    $sql="select * from danhmucsanpham ";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
function loadone_danhmuc($id){
    $sql="select * from danhmucsanpham where ma_danh_muc=".$id;
    $dm = pdo_query_one($sql);
    return $dm;
}
function update_danhmuc($madanhmuc, $tendanhmuc,$mota){
    $sql="update danhmucsanpham set ten_danh_muc='".$tendanhmuc."' ,mo_ta='".$mota."'  where ma_danh_muc=".$madanhmuc;
    pdo_execute($sql);
}

function is_danhmuc_in_order_details($danhmuc_id) {
    $sql = "SELECT COUNT(*) 
            FROM chitietdonhang 
            JOIN sanpham ON chitietdonhang.ma_san_pham = sanpham.ma_san_pham
            JOIN donhang ON chitietdonhang.ma_don_hang = donhang.ma_don_hang
            WHERE sanpham.ma_danh_muc = $danhmuc_id 
            AND donhang.trang_thai != 'Hủy'"; // Kiểm tra trạng thái đơn hàng không phải 'hủy'
    
    // Thực thi truy vấn với tham số là ID danh mục
    $result = pdo_query_one($sql);
    
    return $result['COUNT(*)'] > 0; // Có sản phẩm thuộc danh mục này trong đơn hàng và đơn hàng không bị hủy
}

function is_danhmuc_in_use($danhmuc_id) {

    // Kiểm tra trong chi tiết đơn hàng
    if (is_danhmuc_in_order_details($danhmuc_id)) {
        return true;
    }

    return false; // Không có sản phẩm nào liên quan
}
?>