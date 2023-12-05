<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $query = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";
    $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Create</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah User</h2>
    <form action="create.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="age">Age:</label>
        <input type="number" name="age" required>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
