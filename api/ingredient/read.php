<?php
require_once(__DIR__.'../../restricted-connection.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if ($_POST) {
    $sIngredientID = htmlspecialchars($_POST['ingredientID'], ENT_QUOTES);
}

$db = new DB();
$con = $db->connect();
if ($con) {

    if (!empty($sIngredientID)) {
        $statement = $con->prepare("SELECT * from tingredient WHERE nIngredientID = ?");
        $statement->execute([$sIngredientID]);
        $results = $statement->fetch();
        $statement = null;
        echo json_encode($results);

    }

    else {
        $statement = $con->query("SELECT * FROM tingredient");
        $results = $statement->fetchAll();
        $statement = null;
        
        $db->disconnect($con);
        echo json_encode($results);
    }

}
