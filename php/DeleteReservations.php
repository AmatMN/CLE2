<?php
require_once "Settings.php"; //importing database settings

try
{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass); //making connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("DELETE FROM Res WHERE RTime = :RTime && RTable = :RTable && RDate = :RDate");
    $stmt->bindParam(':RTime', $_POST['RTime']);
    $stmt->bindParam(':RTable', $_POST['RTable']);
    $stmt->bindParam(':RDate', $_POST['RDate']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $reservations = $stmt->fetchAll();

    echo json_encode($reservations);

}
catch(PDOException $e)//failed connection error handling
{
    echo "Connection failed: " . $e->getMessage();
}
