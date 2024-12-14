<?php
$dsn = "mysql:host=localhost;dbname=blogpress";
$dbusername= "root";
$dbpassword = "";


    try{
        // creat a new object to onnect width database;
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "connection sucsses";
    }catch (PDOException $e) {
        echo "connection field" . $e->getMessage();
    }

?>