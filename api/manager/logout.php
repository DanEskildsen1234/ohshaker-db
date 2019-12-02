<?php

require_once(__DIR__.'../../functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_SESSION['managerID'])) {
    session_destroy();
    sendSuccessMessage( 'User successfully logged out' , __LINE__ );

    header('Location: /');
}
