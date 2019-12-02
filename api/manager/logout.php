<?php

require_once(__DIR__.'../../functions.php');

session_start();

if(empty($_POST)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_SESSION['managerID'])) {
    session_destroy();
    header('Location: /');
}
