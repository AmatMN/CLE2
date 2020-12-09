<?php
  require_once "Settings.php";

  $conn = new PDO("mysql:host=$db_host;dbname=$db_name;", $db_user, $db_pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['RName'])) {
    $RName = $_POST['RName'];
    $Tell = $_POST['Tell'];
    $Email = $_POST['Email'];
    $RDate = $_POST['RDate'];
    $RTime = $_POST['RTime'];
    $PAmount = $_POST['PAmount'];
    $RTable = $_POST['RTable'];

    $stmt = $conn->prepare("INSERT INTO Reserv(RName, Email, Tell, RDate, RTime, PAmount, RTable)
      VALUES (:RName, :Email, :Tell, :RDate, :RTime, :PAmount, RTable)");
    $stmt->bindParam(':RName', $RName);
    $stmt->bindParam(':Email', $Email);
    $stmt->bindParam(':Tell', $Tell);
    $stmt->bindParam(':RDate', $RDate);
    $stmt->bindParam(':RTime', $RTime);
    $stmt->bindParam(':PAmount', $PAmount);
    $stmt->bindParam(':RTable', $RTable);
    $stmt->execute();
    ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
      </head>
      <body>
        <div>
          <p>Gelukt</p>
        </div>
      </body>
    </html>

    <?php
  } else {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title>Reserveren van een tafel</title>
      </head>
      <body>
        <form method="post">
          <div>
            <input type="text" required name="RName" placeholder="Volle Naam"><br>
            <input type="tel" required name="Tell" placeholder="Telefoon Nummer"><br>
            <input type="email" required name="Email" placeholder="Email"><br>
            <input type="text" required name="RDate" placeholder="Datum"><br>
            <input type="text" required name="RTime" placeholder="Tijd"><br>
            <input type="text" required name="PAmount" placeholder="Aantal Mensen"><br>
            <input type="text" required name="RTable" placeholder="Tafel"><br>
          </div>
		  <button type="submit">register</button>
        </form>
      </body>
    </html>
    <?php
  }
?>
