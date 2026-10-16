<?php
session_start();
require_once "connect.php";

// Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

// Admin protection
$stmt = $conn->prepare(
    "SELECT role FROM users WHERE id = ?"
);
$stmt->execute([$_SESSION["user_id"]]);

if ($stmt->fetchColumn() !== "admin") {
    http_response_code(403);
    exit("Access denied. Admin only.");
}

// CSRF protection for upcoming CRUD forms
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}
// Add new user
if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["add_user"])) {

    if (!hash_equals(
        $_SESSION["csrf_token"],
        $_POST["csrf_token"] ?? ""
    )) {
        exit("Invalid request");
    }

    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($fullname === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || $password === "") {
        exit("Invalid user information");
    }

    // Check duplicate email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        exit("Email already exists");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (fullname, email, password, role)
         VALUES (?, ?, ?, 'user')"
    );

    $stmt->execute([$fullname, $email, $hashedPassword]);

    header("Location: users.php");
    exit;
}

// Edit and Delete User
if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["action"])) {

    if (!hash_equals(
        $_SESSION["csrf_token"],
        $_POST["csrf_token"] ?? ""
    )) {
        exit("Invalid request");
    }

    $id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);
    $action = $_POST["action"];

    if (!$id || $id < 1) {
        exit("Invalid user ID");
    }

    // Delete user
    if ($action === "delete") {

        if ($id == $_SESSION["user_id"]) {
            exit("You cannot delete your own account.");
        }

        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Update user
    if ($action === "update") {
        $fullname = trim($_POST["fullname"] ?? "");
        $email = trim($_POST["email"] ?? "");

        if ($fullname === "" ||
            !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Invalid user information");
        }

        $stmt = $conn->prepare(
            "SELECT id FROM users WHERE email = ? AND id != ?"
        );
        $stmt->execute([$email, $id]);

        if ($stmt->fetch()) {
            exit("Email already exists");
        }

        $stmt = $conn->prepare(
            "UPDATE users SET fullname = ?, email = ? WHERE id = ?"
        );
        $stmt->execute([$fullname, $email, $id]);
    }

    header("Location: users.php");
    exit;
}

// Get user to edit
$editUser = null;

if (isset($_GET["edit"])) {
    $id = filter_var($_GET["edit"], FILTER_VALIDATE_INT);

    if ($id && $id > 0) {
        $stmt = $conn->prepare(
            "SELECT id, fullname, email FROM users WHERE id = ?"
        );
        $stmt->execute([$id]);
        $editUser = $stmt->fetch();
    }
}
// Get all registered users using PDO
$stmt = $conn->prepare(
    "SELECT id, fullname, email FROM users"
);

$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <h1>Registered Users</h1>
    <p>List of all registered users</p>

    <h3>
        Welcome,
        <?= htmlspecialchars($_SESSION["fullname"]) ?>
    </h3>
<h2>Add New User</h2>

<form method="POST">
    <input type="hidden" name="csrf_token"
           value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>">

    <input type="text" name="fullname"
           placeholder="Full Name" required>

    <input type="email" name="email"
           placeholder="Email" required>

    <input type="password" name="password"
           placeholder="Password" required>

    <button type="submit" name="add_user">
        Add User
    </button>
</form>
<?php if ($editUser): ?>

<h2>Edit User</h2>

<form method="POST">

    <input type="hidden" name="csrf_token"
           value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>">

    <input type="hidden" name="action" value="update">

    <input type="hidden" name="id"
           value="<?= (int)$editUser["id"] ?>">

    <input type="text" name="fullname"
           value="<?= htmlspecialchars($editUser["fullname"]) ?>"
           required>

    <input type="email" name="email"
           value="<?= htmlspecialchars($editUser["email"]) ?>"
           required>

    <button type="submit">Update User</button>

    <a href="users.php">Cancel</a>

</form>

<?php endif; ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
             <th>Name</th>
             <th>Email</th>
             <th>Actions</th>
        </tr>

        <?php if (count($users) > 0): ?>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$user["id"]) ?></td>
                    <td><?= htmlspecialchars($user["fullname"]) ?></td>
                    <td><?= htmlspecialchars($user["email"]) ?></td>
                    <td>

    <a href="users.php?edit=<?= $user["id"] ?>">
        Edit
    </a>

    <?php if ($user["id"] != $_SESSION["user_id"]): ?>

    <form method="POST" style="display:inline">

        <input type="hidden" name="csrf_token"
               value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>">

        <input type="hidden" name="action" value="delete">

        <input type="hidden" name="id"
               value="<?= (int)$user["id"] ?>">

        <button type="submit"
                onclick="return confirm('Delete this user?')">
            Delete
        </button>

    </form>

    <?php endif; ?>

</td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="4">No registered users found.</td>
            </tr>
        <?php endif; ?>

    </table>

    <br>
    <a href="logout.php">Logout</a>

</body>
</html>