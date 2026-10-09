<?php
session_start();

if(isset($_GET["logout"])){
    session_unset();
    session_destroy();

    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION["name"])){
        echo "<h1> welcome". htmlspecialchars($_SESSION["name"])."<h1>";
        echo '<a href="profile.php?logout=1">Logout</a>';
    }
    else{
        echo"<h1> plese register first</h1>";
        echo'<a href="index.php?go to register</a>';

    }
    ?>
</body>
</html>