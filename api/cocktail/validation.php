<?php

function validatePost() {
    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        sendErrorMessage( 'Method not allowed' , __LINE__ );
    }
}

 function validateLoggedIn() {
    if(empty($_SESSION['managerID'])) {
        sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
    }
 }

 function validateField($sField) {
    if(empty($sField)){
        sendErrorMessage('Field is required' , __LINE__); 
    }

 }

function validateNotInArray($sInput, $aArray) {
    if (!in_array($sInput, $aArray)){
        sendErrorMessage( 'Incorrect value type' , __LINE__); 
    }  
}

function validateName($field) {
    if(empty($field)){ 
    sendErrorMessage( 'name is missing' , __LINE__); 
    }

    if(strlen($field) < 2 || strlen($field) > 50){
    sendErrorMessage( 'Min 2 max 50 characters' , __LINE__);
    }
}

function validateRecipe($field) {
    if(empty($field)){ 
    sendErrorMessage( 'recipe is missing' , __LINE__); 
    }

    if(strlen($field) < 2 || strlen($field) > 255){
    sendErrorMessage( 'Min 2 max 50 characters' , __LINE__);
    }
}

function validateMeasurement($field) {
    if(empty($field)){ 
    sendErrorMessage( 'measurement is missing' , __LINE__); 
    }

    if(strlen($field) > 10){
    sendErrorMessage( 'max 10 characters' , __LINE__);
    }
}
