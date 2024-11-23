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
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Paytone+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="GDC-HomeCSSnew.css">
</head>
<?php
// Kết nối cơ sở dữ liệu
require_once 'database_connect.php'; // Kết nối đến database

?>


<body>  
      <!--NavBar-->
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a href="#" class="navbar-brand"><img src="4b5d99c4-2f06-45be-88b2-5e4bb39f9885.png" id="logo"> GDC AIRWAYS</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        		<span class="sr-only">Toggle navigation</span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	      </button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#"><strong>Home</strong></a></li>
					<li><a href="GDC-About.php"><strong>About</strong></a></li>
					<li><a href="GDC-Contacts.php"><strong>Contacts</strong></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" data-toggle="modal" data-target="#signup"><strong>Sign up </strong><i class="fas fa-user-plus"></i></a></li>
					<li><a href="#" data-toggle="modal" data-target="#login"><strong>Login </strong><i class="fas fa-user"></i></a></li>
				</ul>
			</div>
		</div>
	</nav>
  <!--NavBar End-->

  <!--Heading/Moto-->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div id="content">
					<h1>Your  Experience  Starts  Here!</h1>
				</div>
			</div>
		</div>
	</div>
  <!--Heading/Moto End-->
    <div class="container">
        <div class="booking-form mx-auto">
            <h2>Đặt Chuyến Bay</h2>
            <form method="post" action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="departure">Điểm đi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                            </div>
                            <select name="departure_airport_id" id="departure_location" class="custom-select browser-default select2">
                                                <option value=""></option>
                                            <?php
                                                $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                                            while($row = $airport->fetch_assoc()):
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" <?php echo isset($departure_airport_id) && $departure_airport_id == $row['id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="destination">Điểm đến</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                            </div>
                           <select name="arrival_airport_id" id="arrival_airport_id" class="custom-select browser-default select2">
                                                <option value=""></option>
                                            <?php
                                                $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                                            while($row = $airport->fetch_assoc()):
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" <?php echo isset($arrival_airport_id) && $arrival_airport_id == $row['id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
                                            <?php endwhile; ?>
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
                <button type="submit" class="btn btn-primary btn-block">Tìm chuyến bay</button>
            </form>           
        </div>

        <?php  
    
        include 'ketquatim.php'; 
        
        ?>
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
