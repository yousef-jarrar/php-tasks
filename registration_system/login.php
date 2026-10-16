<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    exit("Please enter email and password.");
}

// Get user from database
$stmt = $conn->prepare(
    "SELECT id, fullname, email, password, role
     FROM users
     WHERE email = ?"
);

$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verify login credentials
if ($user && password_verify($password, $user["password"])) {

    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["fullname"] = $user["fullname"];
    $_SESSION["email"] = $user["email"];

    // Redirect based on role
    if ($user["role"] === "admin") {
        header("Location: dachbord.php");
    } else {
        header("Location: index.php");
    }

    exit;
}

echo "<script>
    alert('Invalid email or password');
    window.location.href = 'index.php';
</script>";
exit;
?>