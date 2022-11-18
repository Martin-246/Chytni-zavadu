<?php
    $pdo;
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=xpavel39;port=/var/run/mysql/mysql.sock;charset=utf8mb4", 'xpavel39', 'ojatuho6');
    } catch (PDOException $e) {
        echo "Connection error: ".$e->getMessage();
        die();
    }

    function get_pdo()
    {
        global $pdo;
        return $pdo;
    }

?>