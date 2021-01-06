<?php
session_start();

if ($_SESSION['Auth'] == 2) {
    header("Location: http://undaground.nl/CLE2/admin/adminIndex.php");
    exit;
} else if ($_SESSION['Auth'] == "") {
    header("Location: http://undaground.nl/CLE2/Form.html");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Here!</title>
</head>
<body>
    <h1>Register Page</h1>
    <form action='finished.php' method='post'>
        Username: <input type='text' required name='usrnme' /><br>
        Password: <input type='password' required name='pwd' /><br>
        <input type='hidden' name='page' value='1'>
        <input type='submit' value='submit'>
    </form>
</body>
</html>