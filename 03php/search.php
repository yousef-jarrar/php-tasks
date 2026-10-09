<?php
if (isset($_POST["delete"])) {
    setcookie("lest_search", "", time() - 3600, "/");
}
if(isset($_POST["search"])){
    $search =trim($_POST["search"]);
    setcookie("lest_search",$search,time()+3600,"/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Search</h2>
    <form method="post">
        <input type="text" name="search" placeholder="Enter search word" required>
        <button type="submit">Search</button>
        <button type="submit" name="delete">Delete Cookie</button>
    </form>
    <?php 
    if (isset($_POST["delete"])) {
    
} elseif (isset($_POST["search"])) {
    echo "<p>Last search: " . htmlspecialchars($search) . "</p>";
} elseif (isset($_COOKIE["lest_search"])) {
    echo "<p>Last search: " .
        htmlspecialchars($_COOKIE["lest_search"]) .
        "</p>";
}
    ?>
</body>
</html>