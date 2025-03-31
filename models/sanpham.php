<?php
function insert_sanpham($ten_san_pham, $hinh, $giasp, $mo_ta, $ma_danh_muc, $mau_sac, $so_luong)
{

    $sql = "INSERT INTO sanpham (ten_san_pham, anh_san_pham, gia, mo_ta, ma_danh_muc) 
            VALUES ('$ten_san_pham', '$hinh', '$giasp', '$mo_ta', '$ma_danh_muc')";

    pdo_execute($sql);
    if ($sql) {
        // Lấy thông tin sản phẩm vừa thêm vào
        $sql = "SELECT * FROM sanpham ORDER BY ma_san_pham DESC LIMIT 1";
        $a = pdo_query_one($sql);
        $ma_san_pham = $a['ma_san_pham'];

        // Kiểm tra số lượng mảng và thực hiện thêm vào ProductVariants
        if (is_array($mau_sac) && count($mau_sac) > 0) {
            foreach ($mau_sac as $color_value) {
                // Thêm biến thể sản phẩm vào bảng bienthe
                $sql_variant = "INSERT INTO bienthe (ma_san_pham, mau_sac, so_luong) 
                                VALUES ('$ma_san_pham', '$color_value', '$so_luong')";
                pdo_execute($sql_variant); // Thực hiện thêm biến thể vào bảng
            }
        } else {
            echo "Lỗi: Không có màu sắc được chọn.";
        }
    } else {
        echo "Lỗi: Không thể thêm sản phẩm.";
    }

    return $sql;
}

function insert_bienthe($ma_san_pham, $mau_sac, $so_luong)
{
    $sql = "INSERT INTO bienthe (ma_san_pham, mau_sac, so_luong) 
            VALUES ('$ma_san_pham', '$mau_sac', $so_luong)";
    pdo_execute($sql);
}
function delete_sanpham($ma_san_pham)
{
    if (is_sanpham_in_use($ma_san_pham)) {
        return false;  // Nếu sản phẩm đang được sử dụng, không xóa được
    }

    // Xóa các bản ghi trong chitietdonhang liên quan đến sản phẩm
    $sql = "DELETE FROM chitietdonhang WHERE ma_san_pham = $ma_san_pham";
    pdo_execute($sql);

    // Sau đó, xóa sản phẩm khỏi bảng sanpham
    $sql = "DELETE FROM sanpham WHERE ma_san_pham = $ma_san_pham";
    pdo_execute($sql);

    return true;  // Xóa thành công
}
function loadall_sanpham_top10()
{
    $sql = "select * from sanpham where 1 order by luotxem desc limit 0,10";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function loadall_sanpham_home()
{
    $sql = "select * from sanpham where 1 order by ma_san_pham desc limit 0,9";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function loadall_sanpham($kyw = "", $ma_danh_muc = 0)
{
    $sql = "select * from sanpham where 1 ";
    if ($kyw != "") {
        $sql .= " and ten_san_pham like '%" . $kyw . "%'";
    }
    if ($ma_danh_muc > 0) {
        $sql .= " and ma$ma_danh_muc ='" . $ma_danh_muc . "'";
    }
    $sql .= "order by ma_san_pham asc";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function load_ten_dm($ma_danh_muc)
{
    if ($ma_danh_muc > 0) {
        $sql = "select * from danhmucsanpham where ma_san_pham=" . $ma_danh_muc;
        $dm = pdo_query_one($sql);
        extract($dm);
        return $ten_san_pham;
    } else {
        return "";
    }
}
// function loadone_sanpham($ma_san_pham)
// {
//     $sql = "select * from sanpham where ma_san_pham=" . $ma_san_pham;
//     $sp = pdo_query_one($sql);
//     return $sp;
// }
function loadone_mausac($ma_san_pham)
{
    $sql_color = "SELECT mau_sac , so_luong FROM bienthe WHERE ma_san_pham = '$ma_san_pham'";
    $colors = pdo_query($sql_color);
    return $colors;
}
// function load_sanpham_cungloai($ma_san_pham,$ma_danh_muc){
//     $sql="select * from sanpham where ma_danh_muc=".$ma_danh_muc." AND ma_san_pham <> ".$ma_san_pham;
//     $listsanpham = pdo_query($sql);
//     return $listsanpham;
// }
function update_sanpham($ma_san_pham, $ten_san_pham, $hinh, $gia, $mo_ta, $so_luong, $mau_sac,$ma_danh_muc)
{
    // Nếu không có hình mới, bỏ qua trường anh_san_pham
    if (empty($hinh)) {
        $sql = "UPDATE sanpham 
                SET ten_san_pham = '$ten_san_pham', 
                    gia = '$gia', 
                    mo_ta = '$mo_ta',
                    ma_danh_muc = '$ma_danh_muc'
                WHERE ma_san_pham = '$ma_san_pham'";
    } else {
        $sql = "UPDATE sanpham 
                SET ten_san_pham = '$ten_san_pham', 
                    anh_san_pham = '$hinh', 
                    gia = '$gia', 
                    mo_ta = '$mo_ta',
                    ma_danh_muc = '$ma_danh_muc'
                WHERE ma_san_pham = '$ma_san_pham'";
    }
    pdo_execute($sql);

    // Xóa các biến thể cũ và thêm các biến thể mới vào bảng bienthe
    $sql_delete = "DELETE FROM bienthe WHERE ma_san_pham = '$ma_san_pham'";
    pdo_execute($sql_delete);

    if (is_array($mau_sac) && count($mau_sac) > 0) {
        foreach ($mau_sac as $color_value) {
            $sql_variant = "INSERT INTO bienthe (ma_san_pham, mau_sac, so_luong) 
                            VALUES ('$ma_san_pham', '$color_value', '$so_luong')";
            pdo_execute($sql_variant);
        }
    }
}

function loadall_product_home()
{
    $sql = "SELECT 
    sanpham.ma_san_pham,
    sanpham.ten_san_pham,
    sanpham.anh_san_pham,
    sanpham.gia,
    GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
FROM 
    sanpham
INNER JOIN 
    bienthe 
ON 
    sanpham.ma_san_pham = bienthe.ma_san_pham
 GROUP BY 
    sanpham.ma_san_pham
ORDER BY 
    sanpham.ma_san_pham DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
function loadall_product_iphone()
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = 1
            GROUP BY 
                sanpham.ma_san_pham
            ORDER BY 
                sanpham.ma_san_pham DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}

function loadall_product_samsung()
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = 2
            GROUP BY 
                sanpham.ma_san_pham
            ORDER BY 
                sanpham.ma_san_pham DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}

function loadall_shopiphone($kyw = "")
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = 1";

    // Nếu có từ khóa, thêm điều kiện tìm kiếm
    if ($kyw != "") {
        $sql .= " AND sanpham.ten_san_pham LIKE '%" . $kyw . "%'";
    }

    $sql .= " GROUP BY sanpham.ma_san_pham
              ORDER BY sanpham.ma_san_pham DESC";

    return pdo_query($sql);
}


function loadall_shopsamsung($kyw)
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = 2";

    // Nếu có từ khóa, thêm điều kiện tìm kiếm
    if ($kyw != "") {
        $sql .= " AND sanpham.ten_san_pham LIKE '%" . $kyw . "%'";
    }

    $sql .= " GROUP BY sanpham.ma_san_pham
              ORDER BY sanpham.ma_san_pham DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}



function loadall_shopxiaomi($kyw)
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = 3";

    // Nếu có từ khóa, thêm điều kiện tìm kiếm
    if ($kyw != "") {
        $sql .= " AND sanpham.ten_san_pham LIKE '%" . $kyw . "%'";
    }

    $sql .= " GROUP BY sanpham.ma_san_pham
              ORDER BY sanpham.ma_san_pham DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}

 function loadall_top8_product(){
    $sql = "SELECT * FROM sanpham ORDER BY gia ASC LIMIT 8" ;
    $list_top6 = pdo_query($sql);
    return$list_top6;
 }

 function loadall_top8_iphone(){
$sql="SELECT * FROM sanpham WHERE ten_san_pham LIKE '%iPhone%' ORDER BY gia ASC LIMIT 8";
$list_top6_iphone = pdo_query($sql);
return $list_top6_iphone;

 }
function loadone_sanpham($ma_san_pham)
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.mo_ta,
                sanpham.ma_danh_muc,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_san_pham = $ma_san_pham
            GROUP BY 
                sanpham.ma_san_pham
            ORDER BY 
                sanpham.ma_san_pham DESC";
    $oneproduct = pdo_query_one($sql);
    return $oneproduct;
}


function load_product_cungloai($ma_danh_muc,$current_product_id)
{
    $sql = "SELECT 
                sanpham.ma_san_pham,
                sanpham.ten_san_pham,
                sanpham.anh_san_pham,
                sanpham.gia,
                GROUP_CONCAT(bienthe.mau_sac) AS mau_sac
            FROM 
                sanpham
            INNER JOIN 
                bienthe 
            ON 
                sanpham.ma_san_pham = bienthe.ma_san_pham
            WHERE 
                sanpham.ma_danh_muc = $ma_danh_muc
                AND sanpham.ma_san_pham != $current_product_id
            GROUP BY 
                sanpham.ma_san_pham
            ORDER BY 
                sanpham.ma_san_pham DESC";
    $oneproduct = pdo_query($sql);
    return $oneproduct;
}
function is_sanpham_in_cart($sanpham_id) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if ($item['id_san_pham'] == $sanpham_id) {
                return true; // Sản phẩm tồn tại trong giỏ hàng
            }
        }
    }
    return false; // Không tìm thấy sản phẩm
}
function is_sanpham_in_use($sanpham_id) {
    // Kiểm tra trong giỏ hàng
    if (is_sanpham_in_cart($sanpham_id)) {
        return true;
    }

    // Kiểm tra trong đơn hàng (dữ liệu từ cơ sở dữ liệu)
    $sql_order = "SELECT COUNT(*) 
                  FROM chitietdonhang 
                  JOIN donhang ON chitietdonhang.ma_don_hang = donhang.ma_don_hang
                  WHERE chitietdonhang.ma_san_pham = $sanpham_id 
                  AND donhang.trang_thai != 'Hủy'"; // Kiểm tra trạng thái đơn hàng khác "Hủy"

    // Thực thi câu truy vấn với tham số $sanpham_id
    $stmt_order = pdo_query_one($sql_order);

    // Nếu có sản phẩm trong đơn hàng chưa bị hủy
    if ($stmt_order['COUNT(*)'] > 0) {
        return true;
    }

    return false; // Sản phẩm không có trong giỏ hàng và không có trong đơn hàng chưa bị hủy
}
function loadall_sanphamloc($kyw = "", $ma_danh_muc = 0, $sort_price = "asc")
{
    $sql = "SELECT * FROM sanpham WHERE 1"; // Mặc định lấy tất cả sản phẩm
    if ($kyw != "") {
        $sql .= " AND ten_san_pham LIKE '%" . $kyw . "%'"; // Lọc theo từ khóa
    }
    if ($ma_danh_muc > 0) {
        $sql .= " AND ma_danh_muc ='" . $ma_danh_muc . "'"; // Lọc theo mã danh mục
    }

    // Thêm phần sắp xếp theo giá
    if ($sort_price == 'asc') {
        $sql .= " ORDER BY gia ASC"; // Sắp xếp từ thấp đến cao
    } else {
        $sql .= " ORDER BY gia DESC"; // Sắp xếp từ cao đến thấp
    }

    $listsanpham = pdo_query($sql); // Thực thi câu truy vấn
    return $listsanpham; // Trả về danh sách sản phẩm đã lọc
}

