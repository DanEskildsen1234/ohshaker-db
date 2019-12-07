<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

validatePost();

$iIngredientID = (int)htmlspecialchars($_POST['ingredientID']);

session_start();
validateLoggedIn();

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
