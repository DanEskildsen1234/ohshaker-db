<?php
session_start();

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'/validation.php');


$iCocktailID = $_POST['cocktailID'];
$sField = htmlspecialchars($_POST['field'], ENT_QUOTES);
$sValue = htmlspecialchars($_POST['value'], ENT_QUOTES);
$sMeasurement = htmlspecialchars($_POST['measurement'], ENT_QUOTES);
$sMeasurementType = htmlspecialchars($_POST['measurementType'], ENT_QUOTES);

validatePost();
validateLoggedIn();

// Sends error message if empty, with the exception of eShakenStirred and eCubedCrushed.
if(empty($sValue) && ($sField !== 'eShakenStirred') && $sValue !== 'eCubedCrushed'){
    sendErrorMessage( 'Value is required' , __LINE__ ); 
}

$aAllowedFields = array('eShakenStirred', 'eCubedCrushed', 'cName', 'cCocktailRecipe', 'add-ingredient', 'remove-ingredient');

validateNotInArray($sField, $aAllowedFields);

// Check if eNum value is valid.
if ($sField === 'eShakenStirred'){

    $aAllowedShakenStirred = array('Shaken', 'Stirred', '');
    validateNotInArray($sValue, $aAllowedShakenStirred);

    }

    if ($sField === 'eCubedCrushed'){
    
        $aAllowedCubedCrushed = array("Cubed", "Crushed", "");
        validateNotInArray($sValue, $aAllowedCubedCrushed);
        
        }

if ($sField === 'cName') {
    validateName($sValue);
}

if ($sField === 'cCocktailRecipe') {
    validateRecipe($sValue);
}

if ($sField === 'add-ingredient' || $sField === 'remove-ingredient') {
    $sValue = (int)$sValue;
}

$aAllowedMeasurementTypes = array('ml','cl','dl','l','gram','slice','wedge','part','dash','tbsp','tsp','');
validateNotInArray($sMeasurementType, $aAllowedMeasurementTypes);
validateMeasurement($sMeasurement);

$db = new DB();
$con = $db->connect();
if ($con) {

    if ($sField === 'add-ingredient') {
        $statement = $con->prepare(
            "INSERT `tcocktailingredient`(`nCocktailID`, `nIngredientID`, `nMeasurement`, `eMeasurementType`)
            VALUES (?,?,?,?);");
        $statement->execute([$iCocktailID, $sValue, $sMeasurement, $sMeasurementType]);
    }

    elseif ($sField === 'remove-ingredient')  {
        $statement = $con->prepare(
            "DELETE FROM `tcocktailingredient` WHERE `nIngredientID` = ?");
        $statement->execute([$sValue]);
    }

    else {
        $statement = $con->prepare(
            "UPDATE `tcocktail` SET `$sField` = ? WHERE `tcocktail`.`nCocktailID` = ?;");
        $statement->execute([$sValue, $iCocktailID]);
    }

    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Updated' , __LINE__ );
}
