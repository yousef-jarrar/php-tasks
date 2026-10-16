<?php
session_start();
require "connect.php";

// Admin protection
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);

if ($stmt->fetchColumn() !== "admin") {
    exit("Access denied");
}

// Security token
if (empty($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}

// Add, Update, Delete
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!hash_equals($_SESSION["token"], $_POST["token"] ?? "")) {
        exit("Invalid request");
    }

    $action = $_POST["action"] ?? "";
    $id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);

    if ($action === "delete" && $id > 0) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    if ($action === "add" || $action === "update") {
        $name = trim($_POST["name"] ?? "");
        $description = trim($_POST["description"] ?? "");
        $price = $_POST["price"] ?? "";
        $quantity = $_POST["quantity"] ?? "";

        if ($name === "" || $description === "" ||
            !is_numeric($price) || $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            $quantity < 0) {
            exit("Invalid product data");
        }

        if ($action === "add") {
            $stmt = $conn->prepare(
                "INSERT INTO products (name, description, price, quantity)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$name, $description, $price, $quantity]);
        }

        if ($action === "update" && $id > 0) {
            $stmt = $conn->prepare(
                "UPDATE products SET name=?, description=?,
                 price=?, quantity=? WHERE id=?"
            );
            $stmt->execute([$name, $description, $price, $quantity, $id]);
        }
    }

    header("Location: products.php");
    exit;
}

// Edit product
$edit = null;
if (isset($_GET["edit"])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET["edit"]]);
    $edit = $stmt->fetch();
}

// Display products
$products = $conn->query("SELECT * FROM products")->fetchAll();

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Product Management</h1>

<nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="users.php">Users</a> |
    <a href="logout.php">Logout</a>
</nav>

<h2><?= $edit ? "Edit Product" : "Add Product" ?></h2>

<form method="POST">
    <input type="hidden" name="token"
           value="<?= e($_SESSION["token"]) ?>">
    <input type="hidden" name="action"
           value="<?= $edit ? "update" : "add" ?>">
    <input type="hidden" name="id"
           value="<?= e($edit["id"] ?? "") ?>">

    <input name="name" placeholder="Product Name" required
           value="<?= e($edit["name"] ?? "") ?>">

    <textarea name="description" placeholder="Description"
              required><?= e($edit["description"] ?? "") ?></textarea>

    <input type="number" name="price" placeholder="Price"
           min="0" step="0.01" required
           value="<?= e($edit["price"] ?? "") ?>">

    <input type="number" name="quantity" placeholder="Quantity"
           min="0" step="1" required
           value="<?= e($edit["quantity"] ?? "") ?>">

    <button type="submit">
        <?= $edit ? "Update" : "Add Product" ?>
    </button>
</form>

<h2>All Products</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= e($product["name"]) ?></td>
        <td><?= e($product["description"]) ?></td>
        <td><?= e($product["price"]) ?></td>
        <td><?= e($product["quantity"]) ?></td>
        <td><?= e($product["created_at"]) ?></td>
        <td>
            <a href="?edit=<?= e($product["id"]) ?>">Edit</a>

            <form method="POST" style="display:inline"
                  onsubmit="return confirm('Delete product?')">
                <input type="hidden" name="token"
                       value="<?= e($_SESSION["token"]) ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id"
                       value="<?= e($product["id"]) ?>">
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>