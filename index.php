<?php

if (!isset($_SESSION)) {
    session_start();
}
ob_start(); // Bắt đầu bộ đệm đầu ra


include './models/pdo.php';
include './views/header.php';

include './models/nguoidung.php';
include './models/binhluan.php';
include './models/sanpham.php';
include './models/danhmuc.php';
include './models/donhang.php';

if (isset($_SESSION['thongbao'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo:</strong> ' . $_SESSION['thongbao'] . '
          </div>';
    unset($_SESSION['thongbao']);
}


$product_new = loadall_product_home();
$product_iphone = loadall_product_iphone();
$product_samsung = loadall_product_samsung();
$product_top8_sale = loadall_top8_product();
$product_iphone_top8 =loadall_top8_iphone();
// $product_new2 = loadall_product_home2();
if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'dangky':

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ten = $_POST['ten'];
                $email = $_POST['email'];
                $so_dien_thoai = $_POST['so_dien_thoai'];
                $dia_chi = $_POST['dia_chi'];
                $mat_khau = password_hash($_POST['mat_khau'], PASSWORD_BCRYPT);
                $hinh = isset($_FILES['anh_dai_dien']['name']) ? $_FILES['anh_dai_dien']['name'] : '';
                $target_dir = "./uploads/";
                $target_file = $target_dir . basename($hinh);
                if (!empty($hinh) && move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"], $target_file)) {
                } else {
                    $hinh = '';
                }
                if (emailExists($email)) {
                    // var_dump(emailExists($email));
                    // die();
                    $thongbao = "Email này đã được sử dụng!";
                    require './views/account/dangky.php';
                    return;
                }
                insert_user($ten, $email, $mat_khau, $hinh, $so_dien_thoai, $dia_chi);
                header('Location:index.php?act=dangnhap');
                exit();
            }

            include './views/account/dangky.php';
            break;

        case 'dangnhap':

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = findByEmail($email);
                if ($user && password_verify($password, $user['mat_khau'])) {
                    $_SESSION['user'] = $user;
                    //  var_dump($_SESSION['user']['loai_nguoi_dung']);
                    //  die();

                    if ($_SESSION['user']['trang_thai'] == '0') {
                        $thongbao = "Tài khoản đã bị khóa.";
                        unset($_SESSION['user']);
                    } else {
                        if ($_SESSION['user']['loai_nguoi_dung'] == 'KhachHang') {
                            header('Location:index.php');
                        } else {
                            header('Location:./admin/index.php');
                        }
                    }
                } else {
                    $thongbao = "Email hoặc mật khẩu không đúng!";
                    require './views/account/dangnhap.php';
                }
            }

            include './views/account/dangnhap.php';
            break;

        case 'dangxuat';
            session_start();
            session_destroy();
            header('Location:index.php');
            break;

        case 'shopiphone':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_iphone = loadall_shopiphone($kyw);
            include './views/shop/shop-iphone.php';
            break;

        case 'shopsamsung':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_samsung = loadall_shopsamsung($kyw);
            include './views/shop/shop-samsung.php';
            break;

        case 'shopxiaomi':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_xiaomi = loadall_shopxiaomi($kyw);
            include './views/shop/shop-xiaomi.php';
            break;

        case 'chitietsanpham':
            if (isset($_GET['ma_san_pham']) && ($_GET['ma_san_pham'] > 0)) {
                $ma_san_pham = $_GET['ma_san_pham'];
                $oneproduct = loadone_sanpham($ma_san_pham);
                extract($oneproduct);
                $product_cung_loai = load_product_cungloai($ma_danh_muc, $ma_san_pham);
                $load_all_binhluan = load_all_binhluan($ma_san_pham);
                // var_dump($product_cung_loai);

                // $list_variant = load_product_variant($product_id);

                // if (isset($_SESSION['username'])) {
                //     $list_img_cart = list_img_cart($_SESSION['username']['user_id']);
                // }
                include './views/chitietsanpham.php';
            } else {
                include './views/home.php';
            }
            break;
        case 'chinhsach':

            include './views/chinhsach.php';
            break;
        case 'vechungtoi':

            include './views/vechungtoi.php';
            break;

        case 'addtocart':
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_GET['act']) && $_GET['act'] === 'addtocart' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_san_pham = $_POST['ma_san_pham'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $gia = $_POST['gia'];
                $so_luong = (int)$_POST['so_luong'];
                $mau_sac = $_POST['mau_sac'];
                $anh_san_pham = $_POST['anh_san_pham'];


                // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] === $id_san_pham && $item['mau_sac'] === $mau_sac) {
                        $item['so_luong'] += $so_luong; // Cộng dồn số lượng
                        $found = true;
                        break;
                    }
                }

                // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
                if (!$found) {
                    $_SESSION['cart'][] = [
                        'id' => $id_san_pham,
                        'ten' => $ten_san_pham,
                        'anh_san_pham' => $anh_san_pham,
                        'gia' => $gia,
                        'so_luong' => $so_luong,
                        'mau_sac' => $mau_sac,
                    ];
                }

                // Điều hướng về trang giỏ hàng hoặc sản phẩm
                header('Location:index.php?act=cart');
                exit();
            }

            break;
        case 'cart':


            include './views/giohang.php';
            break;

        case 'removefromcart':

            if (isset($_GET['act']) && $_GET['act'] === 'removefromcart' && isset($_GET['id']) && isset($_GET['color'])) {
                $id = $_GET['id'];
                $color = urldecode($_GET['color']);

                // Tìm và xóa sản phẩm
                foreach ($_SESSION['cart'] as $index => $item) {
                    if ($item['id'] == $id && $item['mau_sac'] === $color) {
                        unset($_SESSION['cart'][$index]);
                        break;
                    }
                }

                // Cập nhật lại giỏ hàng
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header('Location:index.php?act=cart');
                exit();
            }
            break;

        case 'checkout':
            if (!isset($_SESSION['user'])) {
                // Nếu chưa đăng nhập, yêu cầu đăng nhập trước
                header('Location: index.php?act=dangnhap');
                exit();
            }

            if (!empty($_SESSION['cart'])) {
                // Tính tổng tiền để hiển thị trên trang thanh toán
                $tong_tien_gio_hang = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $tong_tien_gio_hang += $item['gia'] * $item['so_luong'];
                }
            } else {
                // Nếu giỏ hàng trống, quay về trang giỏ hàng
                header('Location: index.php?act=cart');
                exit();
            }


            include './views/thanhtoan.php';
            break;
            case 'confirmcheckout':
                if (isset($_POST['ho_ten']) && isset($_POST['so_dien_thoai']) && isset($_POST['dia_chi']) && isset($_POST['pttt'])) {
                    // Lấy thông tin người dùng từ session
                    $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
                  
                    $tong_tien = $_POST['tong_tien']; // Lấy tổng tiền từ form
                    $pttt = $_POST['pttt'];
                    // Lưu vào bảng `donhang`
                    // var_dump($ma_nguoi_dung, $tong_tien);
                    $ma_don_hang = insert_donhang($ma_nguoi_dung, $tong_tien, $pttt);
                    
                    // var_dump($ma_don_hang);
                    // Lưu chi tiết sản phẩm vào bảng `chitietdonhang`
                    foreach ($_SESSION['cart'] as $item) {
                        insert_chitietdonhang($ma_don_hang, $item);
                    }
            
                    // Xóa giỏ hàng sau khi đã đặt hàng
                    unset($_SESSION['cart']);
            
                    // Lưu thông báo vào session
                    $_SESSION['thongbao'] = "Đặt hàng thành công!";
            
                    // Chuyển hướng về trang chủ
                    header('Location: index.php');
                    exit();
                }
                break;
            
                case 'donhangcuatoi':
                    if (isset($_SESSION['user']['ma_nguoi_dung'])) {
                        $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];  // Lấy mã người dùng từ session
                        $donhangs = get_donhang_by_user($ma_nguoi_dung);  // Lấy danh sách đơn hàng của người dùng
                    } else {
                        $donhangs = [];  // Nếu người dùng chưa đăng nhập, trả về mảng rỗng
                    }
                    include './views/donhangcuatoi.php';  // Gọi view và truyền dữ liệu vào
                    break;

                    case 'donhang_detail':
                        $id = $_GET['id'];
                        $donhang = get_donhang_by_id($id); // Lấy thông tin đơn hàng
                        $chitiets = get_chitiet_donhang_by_donhang($id); // Lấy chi tiết đơn hàng
                        include 'views/chitietdonhang.php';
                        break;

                    case 'update_account':

                        $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
                        // var_dump($ma_nguoi_dung);
                        // die();
                        $user = get_user_by_id($ma_nguoi_dung);


                        if (isset($_POST['ho_ten'], $_POST['email'], $_POST['so_dien_thoai'], $_POST['dia_chi'])) {
                            $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
                            $ho_ten = $_POST['ho_ten'];
                            $email = $_POST['email'];
                            $so_dien_thoai = $_POST['so_dien_thoai'];
                            $dia_chi = $_POST['dia_chi'];
                            $hinh = $_FILES['anh_dai_dien']['name'];
                           
                            // Xử lý upload hình ảnh
                            if (!empty($hinh)) {
                                $target_dir = "./uploads/";
                                $target_file = $target_dir . basename($hinh);
                                if (move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"], $target_file)) {
                                    // Hình ảnh đã được tải lên thành công
                                } else {
                                    echo "Lỗi: Không thể tải hình ảnh lên.";
                                    $hinh = ''; // Giữ lại hình ảnh cũ nếu không tải lên được
                                }
                            } else {
                                $hinh = $_POST['anh_dai_dien_cu']; // Giữ lại hình ảnh cũ nếu không chọn file mới
                            }
                            update_user($ma_nguoi_dung, $ho_ten, $email, $so_dien_thoai, $dia_chi,$hinh);
                    
                            // Cập nhật thông tin session
                            $_SESSION['user']['ten'] = $ho_ten;
                            $_SESSION['user']['email'] = $email;
                            $_SESSION['user']['so_dien_thoai'] = $so_dien_thoai;
                            $_SESSION['user']['dia_chi'] = $dia_chi;
                            $_SESSION['user']['anh_dai_dien'] = $hinh;
                    
                            $_SESSION['thongbao'] = "Cập nhật tài khoản thành công!";
                            header("Location: index.php?act=update_account");
                            exit();
                        }
                    include './views/account/capnhattaikhoan.php';  

                        break;
                    case 'add_comment':

                        if (isset($_POST['noi_dung']) && isset($_POST['danh_gia'])) {
                            $ma_nguoi_dung = $_POST['ma_nguoi_dung'];
                            $ma_san_pham = $_POST['ma_san_pham'];
                            $noi_dung = $_POST['noi_dung'];
                            $danh_gia = $_POST['danh_gia'];
                            $ngay_binh_luan = date('Y-m-d H:i:s');
                        
                            add_comment($ma_nguoi_dung, $ma_san_pham, $noi_dung, $danh_gia, $ngay_binh_luan);
                            header("Location: index.php?act=chitietsanpham&ma_san_pham=$ma_san_pham");
                            exit();
                        }
                        
                        break;



        default:
            include './views/home.php';
            break;
    }
} else {
    include './views/home.php';
}
include './views/footer.php';


ob_end_flush();
