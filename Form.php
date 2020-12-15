<?php
    require_once "Settings.php";

    try
    {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

        if (isset($_POST['RName']))
        {
            $RName = $_POST['RName'];
            $Tell = $_POST['Tell'];
            $Email = $_POST['Email'];
            $RDate = $_POST['RDate'];
            $RTime = $_POST['RTime'];
            $PAmount = $_POST['PAmount'];
            $RTable = $_POST['RTable'];

            $stmt = $conn->prepare("INSERT INTO Res(RName, Email, Tell, RDate, RTime, PAmount, RTable) 
                VALUES(:RName, :Email, :Tell, :RDate, :RTime, :PAmount, :RTable)");

            $stmt->bindParam(':RName', $RName);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':Tell', $Tell);
            $stmt->bindParam(':RDate', $RDate);
            $stmt->bindParam(':RTime', $RTime);
            $stmt->bindParam(':PAmount', $PAmount);
            $stmt->bindParam(':RTable', $RTable);
            $stmt->execute();
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

