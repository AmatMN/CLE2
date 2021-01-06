<?php
session_start();

if ($_SESSION['Auth'] == "") {
    header("Location: http://undaground.nl/CLE2/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<p>hello there</p>
<?php
if ($_SESSION['Auth'] == 1) {
?>
<a href="../login/register.php">Register new user</a>
<?php
}
?>
</body>
</html>