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
    <div id="navbar">
        <div class="navContent">
            <a href="https://www.werkenbijverhage.nl/">vacatures</a>
            <a href="https://e-food.nl/verhage">bestellen bij verhage</a>
            <a href="https://verhage.nu/">verhage.nu</a>
        </div>
    </div>

    <p id="check">Reserveringen:</p>
    <div id="ress">
    </div>
    <script src="../js/AdminControl.js"></script>
</body>
</html>