<?php
session_start();
require_once "connect.php";

// Allow only logged-in users
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

// Get all registered users without passwords
$sql = "SELECT id, fullname, email FROM users ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Registered Users</h1>
        <p>List of all registered users</p>

        <p>
            Welcome, <?= htmlspecialchars($_SESSION["fullname"]) ?>
        </p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$user["id"]) ?></td>
                            <td><?= htmlspecialchars($user["fullname"]) ?></td>
                            <td><?= htmlspecialchars($user["email"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No registered users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p>
            <a href="logout.php">Logout</a>
        </p>
    </div>

</body>
</html>

<?php
$conn->close();
?>