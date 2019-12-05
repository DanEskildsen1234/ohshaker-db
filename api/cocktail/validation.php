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
    if(strlen($field) < 2 || strlen($field) > 50){
    sendErrorMessage( 'Name should be min 2 max 50 characters' , __LINE__);
    }
}

function validateRecipe($field) {
    if(strlen($field) < 2 || strlen($field) > 255){
    sendErrorMessage( 'Recipe should be Min 2 max 50 characters' , __LINE__);
    }
}

function validateMeasurement($field) {


    if(strlen($field) > 10){
    sendErrorMessage( 'measurement max 10 characters' , __LINE__);
    }
}
