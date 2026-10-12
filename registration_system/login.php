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
    exit("Please enter your email and password.");
}

// Find the user by email
$stmt = $conn->prepare(
    "SELECT id, fullname, email, password FROM users WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];
        $_SESSION["email"] = $user["email"];

        $stmt->close();
        $conn->close();

        header("Location: users.php");
        exit;
    }
}

// Same message for an unknown email or incorrect password
$stmt->close();
$conn->close();

echo "<script>
    alert('Invalid email or password');
    window.location.href = 'index.php';
</script>";
exit;
?>