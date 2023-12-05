<?php
$host = "localhost"; // Sesuaikan dengan host Anda
$username = "root"; // Sesuaikan dengan username Anda
$password = ""; // Sesuaikan dengan password Anda
$database = "nama_database"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
