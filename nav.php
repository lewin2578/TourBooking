<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo '
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" ref="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
     <style>
body {
    font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }
        header {
    background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
            
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
        .tour-list {
    flex: 1;
    display: flex;
    flex-direction: column; /* Sắp xếp theo cột */
            align-items: center; /* Canh giữa các mục */
            padding: 20px;
        }
        .tour-item {
    border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 80%; /* Chiếm 80% chiều rộng */
            text-align: center;
        }
        




        .tour-list .card {
    border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .tour-list .card:hover {
    transform: translateY(-5px);
        }

        .tour-list .card-title {
    font-size: 1.2em;
            font-weight: bold;
        }

        .tour-list .card-text {
    font-size: 0.9em;
        }

        .tour-list .btn {
    background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Chào Mừng Đến Với Tour Du Lịch</h1>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="tour/tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="tour/tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="khachsan/hotel.php">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="thuexe/thuexe.php">Thuê xe</a></li>
';


if (isset($_SESSION['id_user'])) {
    // Đã đăng nhập, hiển thị liên kết Profile
    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="login/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/logout.php">Đăng xuất</a>
                    </li>
    ';
} else {
    // Chưa đăng nhập, hiển thị liên kết Đăng nhập
    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="login/login.php">Đăng nhập</a>
                    </li>
    ';
}

echo '
                </ul>
            </div>
        </nav>
    </div>
</header>
';
?>