<?php
session_start();
require_once '../php/Settings.php';
$conn = new PDO("mysql:host=$db_host;dbname=$db_name;", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$page = $_POST['page'];
$user = $_POST['usrnme'];
$pass = $_POST['pwd'];
$Hash =  password_hash($pass, PASSWORD_DEFAULT);

if ($page == 0) {
    try {
        $stmt = $conn->prepare("SELECT * FROM Admins WHERE NameFull = :NameFull");
        $stmt->bindParam(':NameFull', $user);
        $stmt->execute();
        $res = $stmt->fetch();
        $L = count($res);
        if ($L != 0) {
            if (password_verify($pass, $res['Pass'])) {
                $_SESSION['Name'] = $res['NameFull'];
                $_SESSION['Auth'] = $res['Auth'];
                header("Location: http://undaground.nl/CLE2/admin/adminIndex.php");
                exit;
            } else {
                echo 'Combinatie is incorrect';
            }
        } else {
            echo 'Combinatie is incorrect';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
else if ($page == 1) {
    if ($_SESSION['Auth'] == 1) {
        try {
            $stmt = $conn->prepare("INSERT INTO Admins(NameFull,Pass) VALUES (:NameFull, :Pass)");
            $stmt->bindParam(':NameFull', $user);
            $stmt->bindParam(':Pass', $Hash);
            $stmt->execute();
            header("Location: http://undaground.nl/CLE2/admin/adminIndex.php");
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

