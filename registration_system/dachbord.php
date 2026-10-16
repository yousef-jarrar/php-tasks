<?php
session_start();
require_once "connect.php";

// Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

// Check admin role from database
$stmt = $conn->prepare(
    "SELECT role FROM users WHERE id = ?"
);
$stmt->execute([$_SESSION["user_id"]]);
$admin = $stmt->fetch();

if (!$admin || $admin["role"] !== "admin") {
    http_response_code(403);
    exit("Access denied. Admin only.");
}

// Count users
$stmt = $conn->query("SELECT COUNT(*) FROM users");
$totalUsers = $stmt->fetchColumn();

// Count products (after creating products table)
$totalProducts = 0;

$stmt = $conn->query("SHOW TABLES LIKE 'products'");

if ($stmt->fetch()) {
    $stmt = $conn->query("SELECT COUNT(*) FROM products");
    $totalProducts = $stmt->fetchColumn();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Admin Dashboard</h1>

    <h3>
        Welcome,
        <?= htmlspecialchars($_SESSION["fullname"]) ?>
    </h3>

    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="users.php">Users</a> |
        <a href="products.php">Products</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <hr>

    <h2>Dashboard Overview</h2>

    <div class="container">

        <section>
            <h2>Total Users</h2>
            <h1><?= (int)$totalUsers ?></h1>
        </section>

        <section>
            <h2>Total Products</h2>
            <h1><?= (int)$totalProducts ?></h1>
        </section>

    </div>

</body>
</html>
