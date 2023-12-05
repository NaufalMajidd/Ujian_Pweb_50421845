<?php
include 'koneksi.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_GET['action'] === 'delete') {
        $query = "DELETE FROM users WHERE id = $id";
        $conn->query($query);
    } elseif ($_GET['action'] === 'edit') {
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $query = "UPDATE users SET name='$name', email='$email', age='$age' WHERE id=$id";
    $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Update/Delete</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit User</h2>
    <form action="update_delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo $row['age']; ?>" required>
        <button type="submit" name="update">Update</button>
    </form>

    <h2>Delete User</h2>
    <a href="update_delete.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin?')">Delete</a>
</body>
</html>
