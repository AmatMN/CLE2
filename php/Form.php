<?php
    require_once "Settings.php"; //importing database settings

    try
    {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass); //making connection
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['RName'])) //check if there is a POST made
        {
            $RName = $_POST['RName'];
            $Tell = $_POST['Tell'];
            $Email = $_POST['Email'];
            $RDate = $_POST['RDate'];
            $RTime = $_POST['RTime'];
            $PAmount = $_POST['PAmount'];
            $RTable = $_POST['RTable'];

            $stmt = $conn->prepare("INSERT INTO Res(RName, Email, Tell, RDate, RTime, PAmount, RTable) 
                VALUES(:RName, :Email, :Tell, :RDate, :RTime, :PAmount, :RTable)"); // preparing the statement

            //setting the parameters of the prepared statement
            $stmt->bindParam(':RName', $RName);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':Tell', $Tell);
            $stmt->bindParam(':RDate', $RDate);
            $stmt->bindParam(':RTime', $RTime);
            $stmt->bindParam(':PAmount', $PAmount);
            $stmt->bindParam(':RTable', $RTable);
            $stmt->execute();//execute statement
        }
    }
    catch(PDOException $e)//failed connection error handling
    {
        echo "Connection failed: " . $e->getMessage();
    }

