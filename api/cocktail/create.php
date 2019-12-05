<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'/validation.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

$sShakenStirred =  htmlspecialchars($_POST['shakenStirred']);
$sCubedCrushed = htmlspecialchars($_POST['cubedCrushed']);
$sCocktailName = htmlspecialchars($_POST['cocktailName'], ENT_QUOTES); //  ENT_QUOTES allows use of single quotes
$sCocktailRecipe = htmlspecialchars($_POST['recipe'], ENT_QUOTES);
$aMeasurements = $_POST['measurement'];
$aMeasurementTypes = $_POST['measurementType'];
$aIngredients = $_POST['ingredient'];

// only values in these arrays are permitted
$aAllowedShakenStirred = array('Shaken', 'Stirred', '');
$aAllowedCubedCrushed = array('Cubed', 'Crushed', '');
$aAllowedMeasurementTypes = array('ml','cl','dl','l','gram','slice','wedge','part','dash','tbsp','tsp','');

validateLoggedIn();
validateNotInArray($sShakenStirred, $aAllowedShakenStirred);
validateNotInArray($sCubedCrushed, $aAllowedCubedCrushed);
validateName($sCocktailName);
validateRecipe($sCocktailRecipe);


$db = new DB();
$con = $db->connect();

if ($con) {

    $statement = $con->prepare(
        "
        INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`)
        VALUES (?, ?, ?, ?)");

    $statement->execute([$sShakenStirred, $sCubedCrushed, $sCocktailName, $sCocktailRecipe]);
    $statement = null;

    // Last id cocktail is the php equivalent of LAST_INSERT_ID, I store it as a variable as if i used
    // LAST_INSERT_ID it would call on every iteration of the loop.

    $last_id_cocktail = $con->lastInsertId();
    for ($i = 0; $i < count($aIngredients); $i++) {

        $sIngredient = htmlspecialchars($aIngredients[$i], ENT_QUOTES);  
        $sMeasurement = htmlspecialchars($aMeasurements[$i], ENT_QUOTES);
        $sMeasurementType = htmlspecialchars($aMeasurementTypes[$i], ENT_QUOTES);

        validateNotInArray($sMeasurementType, $aAllowedMeasurementTypes);
        validateMeasurement($sMeasurement);
        validateName($sIngredient);

        $statement = $con->prepare(
            "
            INSERT INTO `tingredient`(`cName`) VALUES (?);
            ");
        $statement->execute([$sIngredient]);
        $statement = null;

        $statement = $con->prepare(
            "
            INSERT INTO `tcocktailingredient`(`nCocktailID`, `nIngredientID`, `nMeasurement`, `eMeasurementType`)
            VALUES (?, LAST_INSERT_ID(), ?, ?);
            ");
        $statement->execute([$last_id_cocktail, $sMeasurement, $sMeasurementType]);
        $statement = null;
    }

    $db->disconnect($con);
    sendSuccessMessage( 'Cocktail Created' , __LINE__ );
}
