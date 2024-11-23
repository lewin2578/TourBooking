<?php
require_once 'database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departureDate = $_POST['departureDate'];
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
    $tripType = $_POST['tripType'];

    // Fetch airport names
    $airport_names = [];
    $airport_query = $conn->query("SELECT id, airport, location FROM airport_list");
    while ($row = $airport_query->fetch_assoc()) {
        $airport_names[$row['id']] = ucwords($row['airport'] . ', ' . $row['location']);
    }

    // Query for one-way flights
    if ($tripType == 'oneWay' && !empty($departureDate)) {
        $one_way_query = "SELECT * FROM flight_list WHERE DATE(departure_datetime) = ? AND departure_airport_id = ? AND arrival_airport_id = ? ORDER BY RAND()";
        $stmt = $conn->prepare($one_way_query);
        $formatted_date = date('Y-m-d', strtotime($departureDate));
        $stmt->bind_param('sss', $formatted_date, $departure_airport_id, $arrival_airport_id);
        $stmt->execute();
        $one_way_flights = $stmt->get_result();
    }

    // Query for round-trip flights
    if ($tripType == 'roundTrip' && !empty($returnDate)) {
        $round_trip_query = "SELECT * FROM flight_list WHERE DATE(departure_datetime) = ? AND departure_airport_id = ? AND arrival_airport_id = ? ORDER BY RAND()";
        $stmt = $conn->prepare($round_trip_query);
        $formatted_date = date('Y-m-d', strtotime($returnDate));
        $stmt->bind_param('sss', $formatted_date, $departure_airport_id, $arrival_airport_id);
        $stmt->execute();
        $round_trip_flights = $stmt->get_result();
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Flight Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styleKQTK.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($one_way_flights) && $one_way_flights->num_rows > 0): ?>
            <h3>Thông tin các v</h3>
            <table class="table table-bordered" >
                <thead >
                    <tr style="color:white">
                        <th>Ngày đi</th>
                        <th>Thời gian đi</th>
                        <th>Điểm đi</th>
                        <th>Điểm đến</th>
                        <th>Giá</th>
                        <th>Đặt vé</th>
                    </tr>
                </thead>
                <tbody style="color:white">
                    <?php while ($row = $one_way_flights->fetch_assoc()): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($row['departure_datetime'])) ?></td>
                            <td><?= date('h:i A', strtotime($row['departure_datetime'])) ?></td>
                            <td><?= $airport_names[$row['departure_airport_id']] ?></td>
                            <td><?= $airport_names[$row['arrival_airport_id']] ?></td>
                            <td><?= number_format($row['price'], 2) ?> VND</td> 
                            <td><button class="btn btn-primary">Đặt vé</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>    
        <?php else: ?>
            <div class="row align-items-center">
                <h5 class="text-center"><b>No one-way flights found.</b></h5>
            </div>
        <?php endif; ?>

        <?php if (isset($round_trip_flights) && $round_trip_flights->num_rows > 0): ?>
            <h3>Vé Khứ Hồi</h3>
            <?php else: ?>
            <div class="row align-items-center">
                <h5 class="text-center"><b>No round-trip flights found.</b></h5>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>