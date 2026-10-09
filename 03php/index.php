<?php
session_start();
class User{
  public $name;
  public $email;
  public $mobile;
  public $governorate;
  public $track;
  public $skills;
  public $message;

  public function __construct($name, $email, $mobile, $governorate, $track, $skills, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->governorate = $governorate;
        $this->track = $track;
        $this->skills = $skills;
        $this->message = $message;
    }
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $governorate = $_POST["governorate"] ?? "";
    $track = $_POST["track"] ?? "";
    $skills = $_POST["skills"] ?? [];
    $message = trim($_POST["message"] ?? "");
    $agree = isset($_POST["agree"]);
    

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email";
    }

    if (empty($mobile)) {
        $errors[] = "Mobile is required";
    }

    if (empty($governorate)) {
        $errors[] = "Choose a governorate";
    }

    if (empty($track)) {
        $errors[] = "Choose a track";
    }

    if (!$agree) {
        $errors[] = "You must agree to the terms";
    }

   
    if (empty($errors)) {

        $user = new User(
            $name,
            $email,
            $mobile,
            $governorate,
            $track,
            $skills,
            $message
        );
         $_SESSION["name"]=$user->name;
         header("Location: profile.php");
        exit;
         }
         }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
   <form action="" method="post">

  <label for="name">Full Name</label>
  <input type="text" id="name" name="name" required>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" required>

  <label for="mobile">Mobile</label>
  <input type="tel" id="mobile" name="mobile" placeholder="0791234567">

  <label for="governorate">Governorate</label>
  <select id="governorate" name="governorate">
    <option value="">Choose a governorate</option>
    <option value="Amman">Amman</option>
    <option value="Irbid">Irbid</option>
    <option value="Aqaba">Aqaba</option>
    <option value="Zarqa">Zarqa</option>
  </select>

  <label>Track</label>

  <label class="inline">
    <input type="radio" name="track" value="Full Stack">
    Full Stack
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Frontend">
    Frontend
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Backend">
    Backend
  </label>

  <label>Skills you already have</label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="HTML">
    HTML
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="CSS">
    CSS
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="JavaScript">
    JavaScript
  </label>

  <label for="message">Why do you want to join? (optional)</label>
  <textarea id="message" name="message" rows="4"></textarea>

  <label class="inline terms">
    <input type="checkbox" name="agree">
    I agree to the academy terms
  </label>

  <button type="submit">Register</button>

</form>
<?php
  if (!empty($errors)) {
    echo "<h2>Please fix these errors:</h2>";

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }
}

?>

</body>

</html>