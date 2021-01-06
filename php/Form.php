<?php
    require_once "Settings.php"; //importing database settings

    try
    {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass); //making connection
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //trim and sanitize input values if they aren't empty
        if ($_POST['RName'] != "") {
            $RName = sanitizePOSTData($_POST['RName'], "text");
        }
        if ($_POST['Tell'] != "") {
            $Tell = sanitizePOSTData($_POST['Tell'], "text");
        }
        if ($_POST['Email'] != "") {
            $Email = sanitizePOSTData($_POST['Email'], "email");
        }
        if ($_POST['RDate'] != "") {
            $RDate = sanitizePOSTData($_POST['RDate'], "number");
        }
        if ($_POST['RTime'] != "") {
            $RTime = sanitizePOSTData($_POST['RTime'], "time");
        }
        if ($_POST['PAmount'] != "") {
            $PAmount = sanitizePOSTData($_POST['PAmount'], "number");
        }
        if ($_POST['RTable'] != "") {
            $RTable = sanitizePOSTData($_POST['RTable'], "number");
        }


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
    catch(PDOException $e)//failed connection error handling
    {
        echo "Connection failed: " . $e->getMessage();
    }

function sanitizePOSTData($value, $type) {
    $value = trim($value);
    if ($value != "") {
        if ($type === "text") {
            return filter_var($value, FILTER_SANITIZE_STRING);
        } else if ($type === "email") {
            return filter_var($value, FILTER_SANITIZE_EMAIL);
        } else if ($type === "number") {
            return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        } else if ($type === "time") {
            return filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        }
    }
}
