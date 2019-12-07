<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

validatePost();

$sName = htmlspecialchars($_POST['name'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes
validateAssetName($sName);

session_start();
validateLoggedIn();

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare(
        "INSERT INTO `tingredient`(`cName`) VALUES (?)");    
    $statement->execute([$sName]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Created ingredient' , __LINE__);
}
