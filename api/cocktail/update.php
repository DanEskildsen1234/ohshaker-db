<?php
session_start();

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

$iCocktailID = $_POST['cocktailID'];
$sField = htmlspecialchars($_POST['field'], ENT_QUOTES);
$sValue = htmlspecialchars($_POST['value'], ENT_QUOTES);

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

if(empty($sField)){
    sendErrorMessage('Field is required' , __LINE__); 
}


// Sends error message if empty, with the exception of eShakenStirred and eCubedCrushed.
if(empty($sValue) && ($sField !== 'eShakenStirred') && $sValue !== 'eCubedCrushed'){
    sendErrorMessage( 'Value is required' , __LINE__ ); 
}

$aAllowedFields = array('eShakenStirred', 'eCubedCrushed', 'cName', 'cCocktailRecipe', 'nMeasurement');


if (!in_array($sField, $aAllowedFields)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ ); 
}

// Check if eNum value is valid.
if ($sField == 'eShakenStirred'){

    $aShakenStirred = array('Shaken', 'Stirred', '');

    if (!in_array($sValue, $aShakenStirred)){
        sendErrorMessage( 'Incorrect value type' , __LINE__ ); 
        }
    }

    if ($sField == 'eCubedCrushed'){
    
        $aCubedCrushed = array("Cubed", "Crushed", "");
    
        if (!in_array($sValue, $aCubedCrushed)){
            sendErrorMessage( 'Incorrect value type' , __LINE__ ); 
            }
        }

if ($sField == 'cName') {
    if(strlen($sValue) < 2 || strlen($sValue) > 50){
        sendErrorMessage( 'Cocktail name min 2 max 50 characters' , __LINE__ );
    }
}

if ($sField == 'cCocktailRecipe') {
    if(strlen($sValue) < 2 || strlen($sValue) > 255){
        sendErrorMessage( 'Cocktail recipe min 2 max 255 characters' , __LINE__ );
    }
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(
        "UPDATE `tcocktail` INNER JOIN tcocktailingredient ON tcocktailingredient.nCocktailID = tcocktail.nCocktailID INNER JOIN tingredient ON tcocktailingredient.nIngredientID = tingredient.nIngredientID SET `$sField` = '$sValue' WHERE `tcocktail`.`nCocktailID` = $iCocktailID");
    $statement->execute();
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Updated' , __LINE__ );
}
