<?php
require_once(__DIR__.'../../admin-connection.php');
$db = new DB();
$con = $db->connect();
if ($con) {
    $cQuery = "INSERT INTO `tcocktail`(`eShakenStirred`, `eCubedCrushed`, `cName`, `cCocktailRecipe`) VALUES ($vShakenStirred, $vCubedCrushed, $vName, $vCocktailRecipe)";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
}