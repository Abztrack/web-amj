<?php
// Koneksi ke database
$servername = "localhost"; // Ganti sesuai konfigurasi server
$username = "root"; // Ganti dengan username database
$password = ""; // Ganti dengan password database
$dbname = "wonderful_indonesia"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        echo "<script>alert('Login successful! Redirecting to home...'); window.location.href='/home';</script>";
    } else {
        // Login gagal
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/imgs/placeholder.svg">
    <style>
        /* Tambahkan semua gaya CSS yang sama seperti sebelumnya */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('assets/imgs/login.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }
        .container {
            text-align: center;
            padding: 40px;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }
        h1 {
            font-size: 40px;
            color: #ffffff;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #e3e3e3;
            margin-bottom: 40px;
        }
        .input-group {
            margin-bottom: 30px;
            text-align: left;
        }
        .input-group label {
            display: block;
            font-size: 14px;
            color: #e3e3e3;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .actions button {
            padding: 10px 20px;
            font-size: 14px;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Wonderful Indonesia</h1>
        <p>Welcome to Wonderful Indonesia Official Page<br>Explore the stunning natural beauty of Indonesia</p>
        <form method="POST" action="login.php">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Input email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Input password" required>
            </div>
            <div class="actions">
                <button type="submit">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>
