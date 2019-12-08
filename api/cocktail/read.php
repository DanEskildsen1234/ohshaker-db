<?php
require_once(__DIR__.'../../restricted-connection.php');

// Sometimes in our app we want to read all cocktails or only one, the api only assigns $sCocktailID variable
// if there is a post, preventing an undefined error. Later if the variable is truthy, the api will only read
// that variable, if not it will read all cocktails.

if ($_POST) {
    $sCocktailID = htmlspecialchars($_POST['cocktailID'], ENT_QUOTES);
}

$db = new DB();
$con = $db->connect();
if ($con) {

    if (!empty($sCocktailID)) {
        // also grabs information from tingredient because it is required for the individual cocktail description page. (single.php)
        $statement = $con->prepare("SELECT * from tcocktail WHERE nCocktailID = ?");
        $statement->execute([$sCocktailID]);
        $results = $statement->fetch();

        $statement = null;
        
        $statement = $con->prepare("SELECT tingredient.cName as cIngredientName, tcocktailingredient.nMeasurement, tcocktailingredient.eMeasurementType, tingredient.nIngredientID as nIngredientID FROM tingredient
                                    INNER JOIN tcocktailingredient ON tingredient.nIngredientID = 
                                    tcocktailingredient.nIngredientID WHERE tcocktailingredient.nCocktailID = ?");
        $statement->execute([$sCocktailID]);
        $output = $statement->fetchAll();

        
        $results["ingredients"] = $output;

        // $results = array_merge($results[0], $results[1]);

        // If the cocktail has no ingredients it will return an empty array, therefore just select cocktail details.
    }
    
    else {
        
        $statement = $con->prepare("SELECT * FROM tcocktail");
        $statement->execute();
        $results = $statement->fetchAll();
    }
    
    $statement = null;
    $db->disconnect($con);
    echo json_encode($results);
}
