<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Tìm Kiếm Chuyến Bay</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .results-container {
            margin-top: 50px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .flight-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .flight-card h3 {
            font-size: 20px;
            font-weight: bold;
        }
        .flight-card .details {
            margin-bottom: 15px;
        }
        .flight-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container results-container">
        <div class="title">Kết Quả Tìm Kiếm Chuyến Bay</div>
        <div class="flight-card">
            <h3><?php echo $departure; ?> → <?php echo $destination; ?></h3>
            <div class="details">
                <p><strong>Ngày đi:</strong> <?php echo $departureDate; ?></p>
                <?php if ($tripType == 'roundTrip') { ?>
                    <p><strong>Ngày về:</strong> <?php echo $returnDate; ?></p>
                <?php } ?>
                <p><strong>Loại chuyến đi:</strong> <?php echo $tripType == 'roundTrip' ? 'Khứ hồi' : 'Một chiều'; ?></p>
                <p><strong>Người lớn:</strong> <?php echo $adults; ?></p>
                <p><strong>Trẻ em:</strong> <?php echo $children; ?></p>
                <p><strong>Em bé:</strong> <?php echo $infants; ?></p>
            </div>
            <div class="price">Giá vé: 2,000,000 VND</div> <!-- Giá vé có thể thay đổi tùy thuộc vào dữ liệu thực tế -->
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
