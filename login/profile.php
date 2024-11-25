<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login/login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourbooking";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Lấy thông tin người dùng
$id_user = $_SESSION['id_user'];
$sql = "SELECT name, email, phone, address, password  FROM user WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy thông tin người dùng!');</script>";
    exit();
}

// Xử lý cập nhật thông tin người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Cập nhật thông tin
    $sql_update = "UPDATE user SET name = ?, phone = ?, address = ? WHERE id_user = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('sssi', $name, $phone, $address, $id_user);

    if ($stmt_update->execute()) {
        echo "<script>alert('Cập nhật thông tin thành công!');</script>";
        // Cập nhật lại thông tin trong session
        $_SESSION['name'] = $name;
        // Lấy lại thông tin người dùng sau khi cập nhật
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc(); // Cập nhật thông tin người dùng
    } else {
        echo "<script>alert('Cập nhật thông tin thất bại! Vui lòng thử lại.');</script>";
    }
}

// Xử lý thay đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = trim($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu cũ
    if ($current_password !== $user['password']) { // So sánh mật khẩu cũ
        echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không đúng!']);
        exit;
    } elseif ($new_password !== $confirm_password) { // Kiểm tra mật khẩu mới
        echo json_encode(['success' => false, 'message' => 'Mật khẩu mới và xác nhận không khớp!']);
        exit;
    } else {
        // Cập nhật mật khẩu
        $sql_password_update = "UPDATE user SET password = ? WHERE id_user = ?";
        $stmt_password_update = $conn->prepare($sql_password_update);
        $stmt_password_update->bind_param('si', $new_password, $id_user); // Không mã hóa

        if ($stmt_password_update->execute()) {
            echo json_encode(['success' => true, 'message' => 'Thay đổi mật khẩu thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Thay đổi mật khẩu thất bại!']);
        }
        exit;
    }
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
        }

        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
            width: 100%; /* Đảm bảo header chiếm toàn bộ chiều rộng */
        }

        .navbar-nav {
            margin: auto;
        }

        .nav-link {
            color: #ffffff !important;
        }

        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<header>
    <div class="container-fluid"> <!-- Đổi thành container-fluid -->
        <h1><a class="nav-link" href="../home.php">Chào Mừng Đến Với Tour Du Lịch</a></h1>
        <nav class="navbar navbar-expand-lg w-100"> <!-- Thêm w-100 -->
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="../tour/tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="../tour/tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="../khachsan/hotel.php">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="../thuexe/thuexe.php">Thuê xe</a></li>
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/logout.php">Đăng xuất</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<body>
<div class="profile-container">
    <h2>Thông Tin Cá Nhân</h2>
    <form method="POST" action="profile.php">
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="update_profile">Cập Nhật Thông Tin</button>
    </form>
</div>
<div class="profile-container">
    <h2>Thay Đổi Mật Khẩu</h2>
    <form id="change-password-form">
        <div class="form-group">
            <label for="current_password">Mật khẩu cũ:</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu mới:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="change_password">Thay Đổi Mật Khẩu</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#change-password-form').on('submit', function(event) {
            event.preventDefault(); // Ngăn chặn việc gửi form bình thường

            $.ajax({
                url: 'profile.php', // Tệp xử lý
                type: 'POST',
                data: $(this).serialize() + '&change_password=true', // Gửi dữ liệu
                dataType: 'json',
                success: function(response) {
                    alert(response.message); // Hiển thị thông báo
                    if (response.success) {
                        location.reload(); // Tải lại trang nếu thành công
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi trong quá trình thay đổi mật khẩu!');
                }
            });
        });
    });
</script>
</body>
</html>