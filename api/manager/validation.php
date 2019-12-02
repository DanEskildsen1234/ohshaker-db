<?php

function validateFirstName($sFirstName) {
    if (strlen($sFirstName) <= 1) {
        sendErrorMessage( 'Surname has to be at least 2 characters' , __LINE__ );
    }
    if (strlen($sFirstName) > 100){
        sendErrorMessage( 'Surname cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateSurname($sSurname) {
    if (strlen($sSurname) <= 1) {
        sendErrorMessage( 'Surname has to be at least 2 characters' , __LINE__ );
    }

    if (strlen($sSurname) > 100){
        sendErrorMessage( 'Surname cannot be longer then 100 characters' , __LINE__ );
    }
}

function validatePassword($sPassword)
{
    if (strlen($sPassword) <= 12) {
        sendErrorMessage('Password needs to be at least 12 characters', __LINE__);
    }
    if (strlen($sPassword) > 255) {
        sendErrorMessage('Password cannot be longer then 255 characters', __LINE__);
    }
    if (!preg_match("#[0-9]+#", $sPassword)) {
        sendErrorMessage('Password needs to contain at least one number', __LINE__);
    }
    if (!preg_match("#[A-Z]+#", $sPassword)) {
        sendErrorMessage('Password needs to contain at least one capitalized letter', __LINE__);
    }
    if (!preg_match("#[a-z]+#", $sPassword)) {
        sendErrorMessage('Password needs to contain at least one lowercase letter', __LINE__);
    }
}

function validateUsername($sUsername) {
    if (strlen($sUsername) <= 6){
        sendErrorMessage( 'Username has to be at least 6 characters' , __LINE__ );
    }
    if (strlen($sUsername) > 100){
        sendErrorMessage( 'Username cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateEmail($sEmail) {
    if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
        sendErrorMessage( 'Email is invalid' , __LINE__ );
    }
    if (strlen($sEmail) > 255){
        sendErrorMessage( 'Email cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateAddress($sAddress) {
    if( strlen($sAddress) > 50 || strlen($sAddress) <= 4 ){
        sendErrorMessage( 'Address is not valid' , __LINE__ );
    }
}

function validateZip($iZip) {
    if( strlen((string)($iZip)) > 4){
        sendErrorMessage( 'Zip is not valid' , __LINE__ );
    }
}

function validatePhoneNumber($iPhoneNumber) {
    if( strlen((string)($iPhoneNumber)) > 8){
        sendErrorMessage( 'Phone number has to be 8 digits. Only danish numbers are allowed' ,
            __LINE__ );
    }
}
