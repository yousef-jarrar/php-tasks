
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

// Check if the email already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt->close();
    $conn->close();

    echo "<script>
        alert('Email already has an account');
        window.location.href = 'index.php';
    </script>";
    exit;
}

$stmt->close();

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert the new user
$stmt = $conn->prepare(
    "INSERT INTO users (fullname, email, password)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $fullname, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script>
        alert('Account created successfully');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "Error creating account.";
}

$stmt->close();
$conn->close();
?>