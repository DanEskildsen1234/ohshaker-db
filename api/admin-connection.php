<?php

class DB {
    public function connect()
    {
        $host = '127.0.0.1';
        $db = 'ohshaker';
        $user = 'ohshaker_admin';
        $pass = 'admin123';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        // driver options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $oException) {
            echo 'Connection unsuccessful';
            die('Connection unsuccessful: ' . $pdo->connect_error());
        }

        return($pdo);
    }

    public function disconnect($pdo) {
        $pdo = null;
    }
}
