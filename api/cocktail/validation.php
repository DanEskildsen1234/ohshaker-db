<?php

function validateShakenStirred($sShakenStirred, $aShakenStirred) {
    if (!in_array($sShakenStirred, $aShakenStirred)){
        sendErrorMessage( 'Incorrect value type [$sShakenStirred]' , __LINE__); 
    }  
}

function validateCubedCrushed($sCubedCrushed, $aCubedCrushed) {
    if (!in_array($sCubedCrushed, $aCubedCrushed)){
        sendErrorMessage( 'Incorrect value type [$sCubedCrushed]' , __LINE__); 
    }
}

function validateName($sName) {
    if(empty($sName)){ 
    sendErrorMessage( 'cocktail name is missing' , __LINE__); 
    }

    if(strlen($sName) < 2 || strlen($sName) > 50){
    sendErrorMessage( 'cocktail name min 2 max 50 characters' , __LINE__);
    }
}


function validateRecipe($sCocktailRecipe) {
    if(empty($sCocktailRecipe)){ 
    sendErrorMessage( 'recipe is missing' , __LINE__); 
    }

    if(strlen($sCocktailRecipe) < 2 || strlen($sCocktailRecipe) > 255){
    sendErrorMessage( 'recipe min 2 max 255 characters' , __LINE__);
    }
}