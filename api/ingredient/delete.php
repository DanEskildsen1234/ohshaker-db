<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');


if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

$iIngredientID = (int)htmlspecialchars($_POST['ingredientID']);

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare(
        "DELETE FROM `tingredient` WHERE `tingredient`.`nIngredientID` = ?");
    $statement->execute([$iIngredientID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Deleted Ingredient' , __LINE__);
}