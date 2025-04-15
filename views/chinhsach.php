
<main>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính Sách</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css (cho hiệu ứng) -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css/animate.min.css" rel="stylesheet">
    <!-- AOS (Animate On Scroll) cho hiệu ứng cuộn trang -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        /* General body and layout */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f1f1f1, #ffffff);
            margin: 0;
            padding: 0;
        }

        /* Main content area styling */
        main {
            background-color: #fff;
            padding: 40px 20px;
            border-radius: 15px;
            margin: 40px auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
        }

        h1 {
            font-size: 42px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
/* Loại bỏ gạch chân cho liên kết trong phần header */
header a {
    text-decoration: none;
}

/* Loại bỏ gạch chân cho tiêu đề nếu có */
h1, h2 {
    text-decoration: none;
}

        h2 {
            font-size: 28px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
            position: relative;
            padding-left: 20px;
        }

        /* Create a blue bar under h2 */
        h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 10px;
            height: 40%;
            background-color: #007bff;
            border-radius: 5px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        section {
            margin-bottom: 40px;
        }

        /* Hover effect on paragraph */
        p:hover {
            color: #007bff;
            transition: 0.3s;
        }

        /* Add subtle hover effect on each section */
        section:hover {
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
            padding-left: 15px;
        }

        /* AOS fade-in effect on each section */
        .section-content {
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .aos-animate .section-content {
            opacity: 1;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <main class="container">
        <h1 class="animate__animated animate__fadeIn" data-aos="fade-up">Chính Sách Của Chúng Tôi</h1>

        <!-- Policy Sections -->
        <section data-aos="fade-up">
            <h2 class="animate__animated animate__fadeInUp">Chính Sách Bảo Mật</h2>
            <p class="section-content">
                Chúng tôi cam kết bảo vệ thông tin cá nhân của khách hàng. Mọi thông tin sẽ được lưu trữ và bảo mật một cách tuyệt đối. Chúng tôi không chia sẻ thông tin của bạn với bên thứ ba mà không có sự đồng ý của bạn.
            </p>
        </section>

        <section data-aos="fade-up">
            <h2 class="animate__animated animate__fadeInUp">Chính Sách Giao Hàng</h2>
            <p class="section-content">
                Chúng tôi cung cấp dịch vụ giao hàng nhanh chóng, đảm bảo sản phẩm được giao đúng hẹn. Thời gian giao hàng tùy thuộc vào địa điểm và phương thức vận chuyển bạn chọn. Chúng tôi luôn cam kết giao hàng đúng hẹn.
            </p>
        </section>

        <section data-aos="fade-up">
            <h2 class="animate__animated animate__fadeInUp">Chính Sách Đổi Trả</h2>
            <p class="section-content">
                Nếu sản phẩm không như mong đợi hoặc bị lỗi, bạn có thể yêu cầu đổi trả trong vòng 7 ngày kể từ ngày nhận hàng. Điều kiện đổi trả được chi tiết trong phần điều kiện và hướng dẫn đổi trả.
            </p>
        </section>

        <section data-aos="fade-up">
            <h2 class="animate__animated animate__fadeInUp">Chính Sách Bảo Hành</h2>
            <p class="section-content">
                Sản phẩm của chúng tôi có chế độ bảo hành từ 6 tháng đến 1 năm tùy vào từng loại sản phẩm. Nếu sản phẩm gặp phải lỗi kỹ thuật trong thời gian bảo hành, chúng tôi sẽ hỗ trợ sửa chữa hoặc thay thế.
            </p>
        </section>

        <section data-aos="fade-up">
            <h2 class="animate__animated animate__fadeInUp">Liên Hệ</h2>
            <p class="section-content">
                Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ về chính sách, vui lòng liên hệ với chúng tôi qua email: mobileshop.com hoặc gọi số hotline: 0123456789.
            </p>
        </section>
    </main>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-out-back'
        });
    </script>
</body>
</html>

</main>