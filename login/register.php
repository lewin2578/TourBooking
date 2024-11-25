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

// Xử lý khi người dùng nhấn nút đăng ký
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $error = false; // Thêm biến để kiểm tra lỗi

    // Kiểm tra nếu các trường bị bỏ trống
    if (empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!');
        window.location.href = 'login.php';
        </script>";
        $error = true;
    }
    // Kiểm tra định dạng email
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email không đúng định dạng!');
        window.location.href = 'login.php';
        </script>";
        $error = true;
    }
    // Kiểm tra định dạng số điện thoại
    elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo "<script>alert('Số điện thoại không hợp lệ! Vui lòng nhập 10 chữ số.');
        window.location.href = 'login.php';
        </script>";
        $error = true;
    }
    // Kiểm tra độ mạnh của mật khẩu
    elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
        echo "<script>alert('Mật khẩu không đủ độ bảo mật. Vui lòng nhập mật khẩu có ít nhất 6 ký tự, bao gồm cả chữ cái và số!');
        window.location.href = 'login.php';
        </script>";
        $error = true;
    }
    // Kiểm tra mật khẩu xác nhận
    elseif ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu và xác nhận mật khẩu không khớp!');
        window.location.href = 'login.php';
        </script>";
        $error = true;
    }

    // Chỉ thực hiện đăng ký nếu không có lỗi
    if (!$error) {
        // Kiểm tra email đã tồn tại chưa
        $check_email = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email đã được sử dụng. Vui lòng sử dụng email khác!');
            window.location.href = 'login.php';
            </script>";
        } else {
            // Mã hóa mật khẩu trước khi lưu vào database
//            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Thêm tài khoản mới vào bảng `user`
            $sql = "INSERT INTO user (email, phone, password) VALUES ('$email', '$phone', '$confirm_password')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('Đăng ký thành công! Vui lòng đăng nhập.');
                    window.location.href = 'login.php';
                </script>";
                exit();
            } else {
                echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                window.location.href = 'login.php';
                </script>";
            }
        }
    }
}

mysqli_close($conn);
?>