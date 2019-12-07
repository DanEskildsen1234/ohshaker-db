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
        
        $statement = $con->prepare("SELECT * FROM tcocktail WHERE nCocktailID = ?");
        $statement->execute([$sCocktailID]);
        $results = $statement->fetchAll();
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
