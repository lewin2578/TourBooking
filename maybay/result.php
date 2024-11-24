<?php
require_once 'database_connect.php';

$flights = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departureDate = $_POST['departureDate'];
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';

    // Fetch airport names
    $airport_names = [];
    $airport_query = $conn->query("SELECT id, airport, location FROM airport_list");
    while ($row = $airport_query->fetch_assoc()) {
        $airport_names[$row['id']] = ucwords($row['airport'] . ', ' . $row['location']);
    }

    // Query for all flights
    $all_flights_query = "SELECT * FROM flight_list WHERE (DATE(departure_datetime) = ? AND departure_airport_id = ? AND arrival_airport_id = ?) OR (DATE(departure_datetime) = ? AND departure_airport_id = ? AND arrival_airport_id = ?) ORDER BY RAND()";
    $stmt = $conn->prepare($all_flights_query);
    $formatted_departure_date = date('Y-m-d', strtotime($departureDate));
    $formatted_return_date = !empty($returnDate) ? date('Y-m-d', strtotime($returnDate)) : $formatted_departure_date;
    $stmt->bind_param('ssssss', $formatted_departure_date, $departure_airport_id, $arrival_airport_id, $formatted_return_date, $arrival_airport_id, $departure_airport_id);
    $stmt->execute();
    $all_flights = $stmt->get_result();
    while ($row = $all_flights->fetch_assoc()) {
        $flights[] = $row;
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kết quả tìm kiếm chuyến bay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .table-bordered {
            border: 1px solid #ffffff;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ffffff;
        }
        .table thead th {
            color: #ffffff;
        }
        .table tbody td {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($flights)): ?>
            <h3>Kết quả tìm kiếm chuyến bay</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ngày đi</th>
                        <th>Ngày về</th>
                        <th>Thời gian đi</th>
                        <th>Điểm đi</th>
                        <th>Điểm đến</th>
                        <th>Giá</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flights as $row): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($row['departure_datetime'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($row['arrival_datetime'])) ?></td>
                            <td><?= date('h:i A', strtotime($row['departure_datetime'])) ?></td>
                            <td><?= $airport_names[$row['departure_airport_id']] ?></td>
                            <td><?= $airport_names[$row['arrival_airport_id']] ?></td>
                            <td><?= number_format($row['price'], 2) ?> VND</td>
                            <td><button class="btn btn-primary" onclick="location.href='booking.php?flight_id=<?= $row['id'] ?>'">Đặt vé</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="row align-items-center">
                <h5 class="text-center"><b>Không tìm thấy chuyến bay nào.</b></h5>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
