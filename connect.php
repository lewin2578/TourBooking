<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect("localhost", "root", "", "tourbooking");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
?>