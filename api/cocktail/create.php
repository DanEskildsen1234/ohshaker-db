<?php

session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

if(empty($_POST)){
    sendErrorMessage( 'Invalid method [!$_POST]' , __LINE__ ); 
}

if(empty( $_POST['name'] ) ){ 
    sendErrorMessage( 'cocktail name is missing' , __LINE__ ); 
}
if(strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50  ){
    sendErrorMessage( 'cocktail name min 2 max 50 characters' , __LINE__ );
}

if(empty( $_POST['recipe'] ) ){ 
    sendErrorMessage( 'recipe is missing' , __LINE__ ); 
}
if(strlen($_POST['recipe']) < 2 || strlen($_POST['recipe']) > 255  ){
    sendErrorMessage( 'recipe min 2 max 50 characters' , __LINE__ );
}

$db = new DB();
$con = $db->connect();

$sShakenStirred =  htmlspecialchars($_POST['shakenStirred']);
$sCubedCrushed = htmlspecialchars($_POST['cubedCrushed']);
$sName = htmlspecialchars($_POST['name'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes
$sCocktailRecipe = htmlspecialchars($_POST['recipe'], ENT_QUOTES);

if ($con) {
    $cQuery = "INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`) VALUES ('$sShakenStirred', '$sCubedCrushed', '$sName', '$sCocktailRecipe')";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
}