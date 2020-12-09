<?php
  require_once "Settings.php";

  $conn = new PDO("mysql:host=$servername;dbname=$database;", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['Namea'])) {
    $Name = $_POST['Namea'];
    $Tell = $_POST['Tell'];
    $Email = $_POST['Email'];

    $stmt = $conn->prepare("INSERT INTO Reserv(Name, Email, Tell)
      VALUES (:Name, :Email, :Tell)");
    $stmt->bindParam(':Name', $Name);
    $stmt->bindParam(':Email', $Email);
    $stmt->bindParam(':Tell', $Tell);
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
            <input type="text" required name="Namea" placeholder="Volle Naam"><br>
            <input type="tel" required name="Tell" placeholder="Telefoon Nummer"><br>
            <input type="email" required name="Email" placeholder="Email"><br>
          </div>
		  <button type="submit">register</button>
        </form>
      </body>
    </html>
    <?php
  }
?>
