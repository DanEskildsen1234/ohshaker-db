<?php

require_once(__DIR__.'../../functions.php');

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['bartenderID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

session_destroy();
sendSuccessMessage( 'Bartender successfully logged out' , __LINE__ );
header('Location: /');
