<?php
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$fullname = trim($_POST["fullname"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($fullname === "" || $email === "" || $password === "") {
    exit("Please fill in all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email address.");
}

// Check if email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    echo "<script>
        alert('Email already has an account');
        window.location.href = 'index.php';
    </script>";
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare(
    "INSERT INTO users (fullname, email, password)
     VALUES (?, ?, ?)"
);

try {
    $stmt->execute([$fullname, $email, $hashed_password]);

    echo "<script>
        alert('Account created successfully');
        window.location.href = 'index.php';
    </script>";
} catch (PDOException $e) {
   error_log($e->getMessage());
exit("Registration failed. Check the PHP error log.");
}
?>