<?php
class DB {
    public function connect() {
        $cServer = '127.0.0.1';
        $cDB = 'ohshaker';
        $cUser = 'ohshaker_restricted';
        $cPwd = 'restricted123';

        $cDSN = 'mysql:host=' . $cServer . ';dbname=' . $cDB . ';charset=utf8_danish_ci';
        $cOptions = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $cnDB = @new PDO($cDSN, $cUser, $cPwd, $cOptions);
        } catch (\PDOException $oException) {
            echo 'Connection unsuccessful';
            die('Connection unsuccessful: ' . $cnDB->connect_error());
            exit();
        }

        return($cnDB);
    }

    public function disconnect($pcnDB) {
        $pcnDB = null;
    }
}
?>