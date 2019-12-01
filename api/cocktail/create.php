<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
$db = new DB();
$con = $db->connect();

$sShakenStirred = $_POST['shakenStirred'];
$sCubedCrushed = $_POST['cubedCrushed'];
$sName = $_POST['name'];
$sCocktailRecipe = $_POST['recipe'];


if(!$_POST){
    sendErrorMessage( 'Invalid origin [!$_POST]' , __LINE__ ); 
}

if( empty( $_POST['name'] ) ){ 
    sendErrorMessage( 'cocktail name is missing' , __LINE__ ); 
}
if( strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50  ){
    sendErrorMessage( 'cocktail name min 2 max 50 characters' , __LINE__ );
}

if( empty( $_POST['recipe'] ) ){ 
    sendErrorMessage( 'recipe is missing' , __LINE__ ); 
}
if( strlen($_POST['recipe']) < 2 || strlen($_POST['recipe']) > 255  ){
    sendErrorMessage( 'recipe min 2 max 50 characters' , __LINE__ );
}



if ($con) {
    $cQuery = "INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`) VALUES ('$sShakenStirred', '$sCubedCrushed', '$sName', '$sCocktailRecipe')";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
}