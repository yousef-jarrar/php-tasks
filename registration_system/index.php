<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Registration System</h1>

    <div class="container">

        <section>
            <h2>Create Account</h2>

            <form action="register.php" method="POST">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="email" required>

                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="password" required>

                <button type="submit">Register</button>
            </form>
        </section>

        <section>
            <h2>Login</h2>

            <form action="login.php" method="POST">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>

                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </section>

    </div>

</body>
</html>