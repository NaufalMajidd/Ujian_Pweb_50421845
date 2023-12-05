<?php
include 'koneksi.php';

// Handle create form submission || Menangani pengiriman formulir untuk membuat data baru di database.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $query = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";
    $conn->query($query);
}

// Handle update form submission || Menangani pengiriman formulir untuk memperbarui data yang sudah ada di database.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $query = "UPDATE users SET name='$name', email='$email', age='$age' WHERE id=$id";
    $conn->query($query);
}

// Handle delete action||   Menangani permintaan penghapusan data pengguna berdasarkan ID.
if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = $id";
    $conn->query($query);
}

// Fetch all users||Mengambil semua data pengguna dari tabel users di database.
$query = "SELECT * FROM users";
$result = $conn->query($query);

//Tampilan HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Read</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ujian CRUD Naufal Majid_50421845</h2>
    
    <!-- Create Form ||Ini adalah formulir untuk menambahkan pengguna baru.-->
    <form action="read.php" method="post">
        <h3>Tambah User</h3>
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="age">Age:</label>
        <input type="number" name="age" required>
        <button type="submit" name="create">Tambah</button>
    </form>

    <!-- User Table ||Ini adalah tabel yang menampilkan data pengguna dari hasil query yang diambil dari database.-->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['age']}</td>
                    <td>
                        <a href='read.php?action=edit&id={$row['id']}'>Edit</a>
                        <a href='read.php?action=delete&id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
    </table>

    <?php
    // Display Edit Form if edit action is triggered
    // Bagian ini mengecek apakah parameter action adalah 'edit'. Jika ya, itu akan menampilkan formulir edit untuk pengguna dengan ID tertentu.
    //Formulir ini memiliki tombol "Update" yang akan memicu proses pembaruan data di database ketika dikirim.
    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        $editUserId = $_GET['id'];
        $editQuery = "SELECT * FROM users WHERE id = $editUserId";
        $editResult = $conn->query($editQuery);
        $editRow = $editResult->fetch_assoc();
        ?>
        <!-- Edit Form -->
        <form action="read.php" method="post">
            <h3>Edit User</h3>
            <input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $editRow['name']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $editRow['email']; ?>" required>
            <label for="age">Age:</label>
            <input type="number" name="age" value="<?php echo $editRow['age']; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    <?php
    }
    ?>

</body>
</html>
