<?php

session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'/validation.php');


if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$sShakenStirred =  htmlspecialchars($_POST['shakenStirred']);
$sCubedCrushed = htmlspecialchars($_POST['cubedCrushed']);
$sName = htmlspecialchars($_POST['name'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes
$sCocktailRecipe = htmlspecialchars($_POST['recipe'], ENT_QUOTES);

$aShakenStirred = array('Shaken', 'Stirred', '');
$aCubedCrushed = array('Cubed', 'Crushed', '');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__); 
}

// Check if eNum value is valid.
validateShakenStirred($sShakenStirred, $aShakenStirred);
validateCubedCrushed($sCubedCrushed, $aCubedCrushed);
validateName($sName);
validateRecipe($sCocktailRecipe);

$db = new DB();
$con = $db->connect();

if ($con) {
    $cQuery = "INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`) VALUES ('$sShakenStirred', '$sCubedCrushed', '$sName', '$sCocktailRecipe')";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Created' , __LINE__ );
}
