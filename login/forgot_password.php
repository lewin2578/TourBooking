<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourbooking";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}

//Xử lý khi người dùng quên mật khẩu
// Bước 1: Gửi mã xác nhận đến email
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Kiểm tra email có tồn tại không
    $result = mysqli_query($conn, "SELECT id_user FROM user WHERE email = '$email'");
    if ($result && mysqli_num_rows($result) > 0) {
        $token = random_int(100000, 999999); // Tạo số ngẫu nhiên từ 100000 đến 999999
        $expires = date('Y-m-d H:i:s', strtotime('+8 hour')); // Thời hạn 1 giờ và +7 múi giờ Việt Nam

        // Cập nhật token và thời hạn trong cơ sở dữ liệu
        $sql = "UPDATE user SET reset_token = '$token', reset_expires = '$expires' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            // Gửi email chứa mã xác nhận
//            mail($email, "Đặt lại mật khẩu", "[Infinity Company] Bạn vừa yêu cầu đặt lại mật khẩu. Mã xác nhận của bạn là: [$token]. Vui lòng nhập mã này để hoàn tất quá trình.");
            echo 'Mã xác nhận đã được gửi đến email của bạn!';
        } else {
            echo 'Đã xảy ra lỗi. Vui lòng thử lại sau!';
        }
    } else {
        echo 'Email không tồn tại!';
    }
}

// Bước 2: Xác minh mã token
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'])) {
    $token = mysqli_real_escape_string($conn, $_POST['token']);

    // Kiểm tra token và thời hạn
    $result = mysqli_query($conn, "SELECT id_user FROM user WHERE reset_token = '$token' AND reset_expires > NOW()");
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['reset_token'] = $token; // Lưu token vào session để đặt lại mật khẩu
        echo 'Mã xác nhận hợp lệ! Vui lòng đặt lại mật khẩu mới.';
    } else {
        echo 'Mã xác nhận không hợp lệ hoặc đã hết hạn!';
    }
}

// Bước 3: Đặt lại mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'], $_POST['confirm_password'])) {
    // Loại bỏ khoảng trắng ở đầu và cuối
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Debug để kiểm tra giá trị thực tế
    error_log("New password: " . $new_password);
    error_log("Confirm password: " . $confirm_password);

    // So sánh chính xác hai chuỗi
    if (strcmp($new_password, $confirm_password) !== 0) {
        echo 'Mật khẩu và xác nhận mật khẩu không khớp!';
    } elseif (isset($_SESSION['reset_token'])) {
        $token = $_SESSION['reset_token'];

        // Kiểm tra token có còn hợp lệ không
        $check_token = mysqli_query($conn, "SELECT id_user FROM user WHERE reset_token = '$token' AND reset_expires > NOW()");
        if (mysqli_num_rows($check_token) > 0) {
            // Đặt lại mật khẩu và xóa token
            $sql = "UPDATE user SET password = '$new_password', reset_token = NULL, reset_expires = NULL WHERE reset_token = '$token'";
            if (mysqli_query($conn, $sql)) {
                unset($_SESSION['reset_token']);
                echo 'Đặt lại mật khẩu thành công!';
            } else {
                echo 'Đã xảy ra lỗi. Vui lòng thử lại sau!';
                error_log("MySQL Error: " . mysqli_error($conn));
            }
        } else {
            echo 'Phiên đặt lại mật khẩu đã hết hạn!';
            unset($_SESSION['reset_token']);
        }
    } else {
        echo 'Phiên đặt lại mật khẩu đã hết hạn!';
    }
}

mysqli_close($conn);
?>
