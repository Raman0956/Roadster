<?php
    $dsn = 'mysql:host=localhost;dbname=roadster';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
        echo "connection success";
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
?>