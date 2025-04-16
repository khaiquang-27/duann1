<?php
// Kiểm tra xem session đã được khởi tạo hay chưa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize total cart value
$tong_tien_gio_hang = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
        $tong_tien = $item['gia'] * $item['so_luong'];
        $tong_tien_gio_hang += $tong_tien;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            cursor: pointer;
        }
        .quantity-control input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<main>
    <?php if (!empty($_SESSION['cart'])) { ?>
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Ảnh Sản Phẩm</th>
                                        <th>Màu</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['cart'] as $index => $item) {
                                        $tong_tien = $item['gia'] * $item['so_luong'];
                                    ?>
                                    <tr data-id="<?php echo $index; ?>">
                                        <td><?php echo htmlspecialchars($item['ten']); ?></td>
                                        <td><img src="<?php echo htmlspecialchars($item['anh_san_pham']); ?>" alt="" width="220px" height="150px"></td>
                                        <td><?php echo htmlspecialchars($item['mau_sac']); ?></td>
                                        <td class="price"><?php echo number_format($item['gia']); ?> đ</td>
                                        <td>
                                            <div class="quantity-control">
                                                <button class="qty-decrease">-</button>
                                                <input type="number" class="qty-input" value="<?php echo $item['so_luong']; ?>" min="1">
                                                <button class="qty-increase">+</button>
                                            </div>
                                        </td>
                                        <td class="subtotal"><?php echo number_format($tong_tien); ?> đ</td>
                                        <td class="pro-remove">
                                            <a href="index.php?act=removefromcart&id=<?php echo $item['id']; ?>&color=<?php echo urlencode($item['mau_sac']); ?>">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-5 ml-auto">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng Tiền Giỏ Hàng</td>
                                            <td id="cart-subtotal"><?php echo number_format($tong_tien_gio_hang); ?> đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí Vận Chuyển</td>
                                            <td id="shipping-fee">30,000 đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng</td>
                                            <td class="total-amount" id="cart-total"><?php echo number_format($tong_tien_gio_hang + 30000); ?> đ</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="index.php?act=checkout" class="btn btn-sqr d-block">Thanh Toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Ảnh Sản Phẩm</th>
                                            <th>Màu</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center"><p>Chưa có sản phẩm trong giỏ hàng</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</main>

<script>
// Format number to Vietnamese currency
function formatCurrency(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ";
}

// Update subtotal for a row
function updateSubtotal(row) {
    const priceText = row.querySelector('.price').textContent.replace(/[^0-9]/g, '');
    const price = parseInt(priceText);
    const quantity = parseInt(row.querySelector('.qty-input').value);
    const subtotal = price * quantity;
    row.querySelector('.subtotal').textContent = formatCurrency(subtotal);
    return subtotal;
}

// Update cart totals
function updateCartTotals() {
    let cartSubtotal = 0;
    document.querySelectorAll('tbody tr').forEach(row => {
        cartSubtotal += updateSubtotal(row);
    });
    
    const shippingFee = 30000;
    const cartTotal = cartSubtotal + shippingFee;
    
    document.getElementById('cart-subtotal').textContent = formatCurrency(cartSubtotal);
    document.getElementById('cart-total').textContent = formatCurrency(cartTotal);
}

// Handle quantity changes
document.querySelectorAll('.quantity-control').forEach(control => {
    const decreaseBtn = control.querySelector('.qty-decrease');
    const increaseBtn = control.querySelector('.qty-increase');
    const input = control.querySelector('.qty-input');
    
    decreaseBtn.addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateCartTotals();
            updateCartSession(control.closest('tr').dataset.id, input.value);
        }
    });
    
    increaseBtn.addEventListener('click', () => {
        input.value = parseInt(input.value) + 1;
        updateCartTotals();
        updateCartSession(control.closest('tr').dataset.id, input.value);
    });
    
    input.addEventListener('change', () => {
        if (parseInt(input.value) < 1 || isNaN(parseInt(input.value))) {
            input.value = 1;
        }
        updateCartTotals();
        updateCartSession(control.closest('tr').dataset.id, input.value);
    });
});

// AJAX function to update cart session
function updateCartSession(index, quantity) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `index=${encodeURIComponent(index)}&quantity=${encodeURIComponent(quantity)}`
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Failed to update cart:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>
