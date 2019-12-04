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
$sCocktailName = htmlspecialchars($_POST['cocktailName'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes
$sCocktailRecipe = htmlspecialchars($_POST['recipe'], ENT_QUOTES);
$aMeasurements = $_POST['measurement'];
$aMeasurementTypes = $_POST['measurementType'];
$aIngredients = $_POST['ingredient'];

$aShakenStirred = array('Shaken', 'Stirred', '');
$aCubedCrushed = array('Cubed', 'Crushed', '');

// Check if eNum value is valid.
validateLoggedIn();
validateShakenStirred($sShakenStirred, $aShakenStirred);
validateCubedCrushed($sCubedCrushed, $aCubedCrushed);
validateName($sCocktailName);
validateRecipe($sCocktailRecipe);

$db = new DB();
$con = $db->connect();

if ($con) {

    $statement = $con->prepare(
        "
        INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`)
        VALUES ('$sShakenStirred', '$sCubedCrushed', '$sCocktailName', '$sCocktailRecipe')");
    $statement->execute();
    $statement = null;

    $last_id_cocktail = $con->lastInsertId();
    for ($i = 0; $i < count($aIngredients); $i++) {

        $sIngredient = htmlspecialchars($aIngredients[$i], ENT_QUOTES);
        $sMeasurement = htmlspecialchars($aMeasurements[$i], ENT_QUOTES);
        $sMeasurementType = htmlspecialchars($aMeasurementTypes[$i], ENT_QUOTES);

    $statement = $con->prepare(
        "
        INSERT INTO `tingredient`(`cName`) VALUES ('$sIngredient');
        ");
    $statement->execute();
    $statement = null;

    $statement = $con->prepare(
        "
        INSERT INTO `tcocktailingredient`(`nCocktailID`, `nIngredientID`, `nMeasurement`, `eMeasurementType`)
        VALUES ('$last_id_cocktail', LAST_INSERT_ID(), '$sMeasurement', '$sMeasurementType');
        ");
    $statement->execute();
    $statement = null;
    }

    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Created' , __LINE__ );
}
