<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

validatePost();

$sShakenStirred =  htmlspecialchars($_POST['shakenStirred']);
$sCubedCrushed = htmlspecialchars($_POST['cubedCrushed']);
$sCocktailName = htmlspecialchars($_POST['cocktailName'], ENT_QUOTES); //  ENT_QUOTES allows sanitization  use of single quotes
$sCocktailRecipe = htmlspecialchars($_POST['recipe'], ENT_QUOTES);
$aMeasurements = $_POST['measurement'];
$aMeasurementTypes = $_POST['measurementType'];
$aIngredients = $_POST['ingredient'];

// only values in these arrays are permitted
$aAllowedShakenStirred = array('Shaken', 'Stirred', '');
$aAllowedCubedCrushed = array('Cubed', 'Crushed', '');
$aAllowedMeasurementTypes = array('ml','cl','dl','l','gram','slice','wedge','part','dash','tbsp','tsp','');

session_start();
validateLoggedIn();
validateNotInArray($sShakenStirred, $aAllowedShakenStirred);
validateNotInArray($sCubedCrushed, $aAllowedCubedCrushed);
validateAssetName($sCocktailName);
validateRecipe($sCocktailRecipe);

$db = new DB();
$con = $db->connect();

if ($con) {
    $con->beginTransaction();
    $statement = $con->prepare(
        "
        INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`)
        VALUES (?, ?, ?, ?)");

    $statement->execute([$sShakenStirred, $sCubedCrushed, $sCocktailName, $sCocktailRecipe]);
    $iCocktailID = $con->lastInsertId();
    $statement = null;

    // Last id cocktail is the php equivalent of LAST_INSERT_ID, I store it as a variable as if i used
    // LAST_INSERT_ID it would call on every iteration of the loop.

    for ($i = 0; $i < count($aIngredients); $i++) {

        $sIngredient = htmlspecialchars($aIngredients[$i], ENT_QUOTES);  
        $sMeasurement = htmlspecialchars($aMeasurements[$i], ENT_QUOTES);
        $sMeasurementType = htmlspecialchars($aMeasurementTypes[$i], ENT_QUOTES);

        validateNotInArray($sMeasurementType, $aAllowedMeasurementTypes);
        validateMeasurement($sMeasurement);
        validateAssetName($sIngredient);

        $statement = $con->prepare("SELECT `nIngredientID` FROM tingredient WHERE cName=?;");
        $statement->execute([$sIngredient]);
        $result = $statement->fetch();
        $statement = null;

        $iIngredientID = 0;

        if ($result['nIngredientID']) {
            $iIngredientID = $result['nIngredientID'];
        }

        if ($iIngredientID === 0) {
            $statement = $con->prepare("INSERT INTO `tingredient` (`cName`) VALUES (?);");
            $statement->execute([$sIngredient]);
            $iIngredientID = $con->lastInsertId();
            $statement = null;
        }

        $statement = $con->prepare(
            "
            INSERT INTO `tcocktailingredient`(`nCocktailID`, `nIngredientID`, `nMeasurement`, `eMeasurementType`)
            VALUES (?, ?, ?, ?);
            ");
        $statement->execute([$iCocktailID, $iIngredientID, $sMeasurement, $sMeasurementType]);
        $statement = null;
    }

    $con->commit();
    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Created' , __LINE__ );
}
