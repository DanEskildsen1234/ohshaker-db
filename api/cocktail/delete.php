<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');


validatePost();

$iCocktailID = (int)htmlspecialchars($_POST['cocktailID'], ENT_QUOTES);

session_start();
validateLoggedIn();

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare(
        "DELETE FROM `tcocktail` WHERE `tcocktail`.`nCocktailID` = ?");
    $statement->execute([$iCocktailID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Deleted Cocktail' , __LINE__);
}
