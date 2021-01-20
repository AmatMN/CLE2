<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveren van een tafel</title>
    <link rel="stylesheet" type="text/css" href="css/FormStyle.css">
</head>
<body>
<div id="navbar">
    <div class="logo">
        <img src="assets/logo.png" alt="logo">
    </div>

    <div class="navContent">
        <a href="https://www.werkenbijverhage.nl/">vacatures</a>
        <a href="https://e-food.nl/verhage">bestellen bij verhage</a>
        <a href="https://verhage.nu/">verhage.nu</a>
    </div>
</div>

<div class="formBlock">
    <h1>Dit zijn de gegevens die wij ontvangen hebben</h1><br>
    <strong>Naam: </strong> <?php echo $_SESSION['RName'];?> <br>
    <strong>Telefoon nummer: </strong> <?php echo $_SESSION['Tell'];?> <br>
    <strong>E-mail: </strong> <?php echo $_SESSION['Email'];?> <br>
    <strong>Aantal mensen: </strong> <?php echo $_SESSION['PAmount'];?> <br>
    <strong>Datum: </strong> <?php echo $_SESSION['RDate'];?> <br>
    <strong>Tijd: </strong> <?php echo $_SESSION['RTime'];?> <br>
    <strong>Tafel: </strong> <?php echo $_SESSION['RTable'];?> <br>
</div>

<div class="wrapper">
    <img src="assets/Website-footer-1.jpg" class="wrapper" alt="footer">
</div>
</body>
</html>