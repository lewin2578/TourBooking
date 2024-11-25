<?php
session_start(); // Start session to store booking data
require_once 'database_connect.php'; // Kết nối đến database

if (isset($_POST['submit'])) {
    // User submitted booking form
    $passenger_name = $_POST['passenger_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $num_tickets = (int)$_POST['num_tickets'];
    $flight_data = $_SESSION['flight_data']; // Retrieve flight data from session
    $flight_id = $flight_data['flight_id'];

    // Validate input
    if (empty($passenger_name) || empty($email) || empty($phone) || $num_tickets <= 0) {
        $error_message = "Please fill in all required fields and enter a valid number of tickets.";
    } else {
        // Save booking information to database
        $stmt = $conn->prepare("INSERT INTO booked_flight (flight_id, name, email, phone, num_tickets) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('isssi', $flight_id, $passenger_name, $email, $phone, $num_tickets);
        $stmt->execute();
        
        // Check if the booking was successful
        if ($stmt->affected_rows > 0) {
            $booking_successful = true;
            header("Location: search.php?booking=success"); // Redirect back to search page after successful booking
            exit();
        } else {
            $error_message = "There was an error processing your booking. Please try again.";
        }

        $stmt->close();
    }
}

// Check if a flight was selected from search results
if (isset($_GET['flight_id'])) {
    $flight_id = (int)$_GET['flight_id'];
    // Retrieve flight details based on flight ID
    $stmt = $conn->prepare("SELECT f.id AS flight_id, f.departure_datetime, f.arrival_datetime, f.price, d.airport AS departure_airport, a.airport AS arrival_airport 
                            FROM flight_list f 
                            JOIN airport_list d ON f.departure_airport_id = d.id 
                            JOIN airport_list a ON f.arrival_airport_id = a.id 
                            WHERE f.id = ?");
    $stmt->bind_param('i', $flight_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $flight_data = $result->fetch_assoc();
        $_SESSION['flight_data'] = $flight_data; // Store flight data in session for booking form access
    } else {
        // No flight found, redirect back to search page (optional)
        header("Location: search.php");
        exit();
    }

    $stmt->close();
} else {
    // No flight selected, redirect back to search page (optional)
    header("Location: search.php");
    exit();
}

$conn->close(); // Close the connection at the end of the script
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đặt vé - Kết quả tìm kiếm chuyến bay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
    body {
    background-image: url(s9nIMMH-airplane-wall-paper.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

/* Table Styles */
body {
    font-family: Arial, sans-serif;
}

h2 {
    font-weight: bold;
}

.table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.form-control {
    border-radius: 5px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

/* Responsive design */
@media (max-width: 768px) {
    /* Adjust layout for smaller screens */
    .table {
        font-size: 0.8em;
    }
} </style>
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($flight_data)): ?>
            <h2>Thông tin chuyến bay</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Ngày đi</th>
                        <td><?= date('d-m-Y', strtotime($flight_data['departure_datetime'])) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày về</th>
                        <td><?= date('d-m-Y', strtotime($flight_data['arrival_datetime'])) ?></td>
                    </tr>
                    <tr>
                        <th>Điểm đi</th>
                        <td><?= $flight_data['departure_airport'] ?></td>
                    </tr>
                    <tr>
                        <th>Điểm đến</th>
                        <td><?= $flight_data['arrival_airport'] ?></td>
                    </tr>
                    <tr>
                        <th>Giá vé</th>
                        <td><?= number_format($flight_data['price'], 2) ?> VND</td>
                    </tr>
                </tbody>
            </table>

            <?php if (isset($booking_successful)): ?>
                <div class="alert alert-success">
                    Đặt vé thành công! Vui lòng kiểm tra email để biết thêm chi tiết.
                </div>
            <?php elseif (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <h2>Thông tin hành khách</h2>
            <form method="post" action="">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="passenger_name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="passenger_name" name="passenger_name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" 
 id="email" name="email" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"> 
 <label for="phone" class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="num_tickets" class="form-label">Số lượng vé</label>
                <input type="number" class="form-control" id="num_tickets" name="num_tickets" required>
            </div>
        </div>
    </div>
    <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
    <button type="submit" name="submit" class="btn btn-primary">Đặt vé</button>
    <a href="search.php" class="btn btn-secondary">Quay lại</a>
</form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
