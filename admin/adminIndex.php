<?php
session_start();
//if ($_SESSION['Auth'] == "") {
//    header("Location: http://undaground.nl/CLE2/login.php");
//    exit;
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/AdminStyle.css">
    <title>Reserveringen</title>
</head>
<body>
    <p id="check">Reserveringen</p>
    <div id="ress"></div>
    <script src="../js/AdminControl.js"></script>
</body>
</html>