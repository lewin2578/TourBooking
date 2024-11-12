<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Chuyến Bay</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $departure = $_POST['departure'];
                $destination = $_POST['destination'];
                $departureDate = $_POST['departureDate'];
                $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
                $tripType = $_POST['tripType'];
                $adults = $_POST['adults'];
                $children = $_POST['children'];
                $infants = $_POST['infants'];

                // Kiểm tra và xử lý dữ liệu ở đây (nếu cần)
                echo "<div class='alert alert-success mt-3'>Form đã được gửi thành công!</div>";
            }
            ?>
<body>
   <div class="container">
   <div class="image-container">
            <img src="pexels-apasaric-1285625.jpg" alt="Mô tả hình ảnh">
        </div>
   </div>
    <div class="container">
        <div class="booking-form mx-auto">
            <h2>Đặt Chuyến Bay</h2>
            <form method="post" action="">
                <?php
                $airports = [
                    "HAN" => "Hà Nội",
                    "SGN" => "Hồ Chí Minh",
                    "DAD" => "Đà Nẵng",
                    "CXR" => "Cam Ranh",
                    "HPH" => "Hải Phòng"
                    // Thêm các sân bay khác ở Việt Nam
                ];
                ?>
              <div class="form-row">
               <div class="form-group col-md-6">
                        <label for="departure">Điểm đi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                            </div>
                            <select class="form-control" id="departure" name="departure" onchange="updateDestinations()" required>
                                <option value="">Chọn điểm đi</option>
                                <?php
                                foreach ($airports as $code => $name) {
                                    echo "<option value='$code'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="destination">Điểm đến</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                            </div>
                            <select class="form-control" id="destination" name="destination" required>
                                <option value="">Chọn điểm đến</option>
                                <?php
                                foreach ($airports as $code => $name) {
                                    echo "<option value='$code'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="departureDate">Ngày đi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" id="departureDate" name="departureDate" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="returnDateDiv" style="display: none;">
                        <label for="returnDate">Ngày về</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" id="returnDate" name="returnDate">
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tripType" id="oneWay" value="oneWay" onclick="toggleReturnDate()" required>
                        <label class="form-check-label" for="oneWay">Một chiều</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tripType" id="roundTrip" value="roundTrip" onclick="toggleReturnDate()">
                        <label class="form-check-label" for="roundTrip">Khứ hồi</label>
                    </div>
                </div>
                
                <div class="form-row">
    <div class="form-group col-md-4">
        <label for="adults">Người lớn</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="number" class="form-control" id="adults" name="adults" value="1" min="1" required>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="children">Trẻ em</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-child"></i></span>
            </div>
            <input type="number" class="form-control" id="children" name="children" value="0" min="0" required>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="infants">Em bé</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-baby"></i></span>
            </div>
            <input type="number" class="form-control" id="infants" name="infants" value="0" min="0" required>
        </div>
    </div>
</div>

                <button type="submit" class="btn btn-primary btn-block">Tìm chuyến bay</button>
            </form>           



        </div>
    </div>  

    <div class="container">
        <div class="title">Giá vé nội địa tốt nhất</div>
        <div class="subtitle">Giá tốt nhất từ Vietnam Airlines, Bamboo, Vietjet...</div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Phú Quốc</h3>
            <div class="date">20/12/2024</div>
            <div class="price">1,905,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Đà Nẵng</h3>
            <div class="date">21/12/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hà Nội → Đà Nẵng</h3>
            <div class="date">15/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hà Nội → Đà Lạt</h3>
            <div class="date">22/11/2024</div>
            <div class="price">3,525,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
    </div>

    <div class="container">
        <div class="title">Giá vé nội địa tốt nhất</div>
        <div class="subtitle">Giá tốt nhất từ Vietnam Airlines, Bamboo, Vietjet...</div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Phú Quốc</h3>
            <div class="date">20/12/2024</div>
            <div class="price">1,905,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Đà Nẵng</h3>
            <div class="date">21/12/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hà Nội → Đà Nẵng</h3>
            <div class="date">15/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hà Nội → Đà Lạt</h3>
            <div class="date">22/11/2024</div>
            <div class="price">3,525,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
        <div class="flight-card">
            <h3>Hồ Chí Minh → Huế</h3>
            <div class="date">22/11/2024</div>
            <div class="price">2,445,000</div>
            <a href="#" class="view-button">Xem</a>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleReturnDate() {
            var returnDateDiv = document.getElementById("returnDateDiv");
            if (document.getElementById("roundTrip").checked) {
                returnDateDiv.style.display = "block";
            } else {
                returnDateDiv.style.display = "none";
            }
        }
    </script>
    <script>
        function updateDestinations() {
            var departure = document.getElementById("departure").value;
            var destination = document.getElementById("destination");
            var options = destination.options;

            // Reset the destination options to visible
            for (var i = 0; i < options.length; i++) {
                options[i].style.display = "block";
            }

            // Hide the selected departure airport in destination options
            if (departure !== "") {
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value === departure) {
                        options[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
