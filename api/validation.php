<?php

function validateBarName($sBarName) {
    if( strlen($sBarName) <= 6 ) {
        sendErrorMessage( 'Bar name has to be at least 3 characters' , __LINE__ );
    }
    if( strlen($sBarName) > 100 ) {
        sendErrorMessage( 'Bar name cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateFirstName($sFirstName) {
    if( strlen($sFirstName) <= 1 ) {
        sendErrorMessage( 'First name has to be at least 2 characters' , __LINE__ );
    }
    if( strlen($sFirstName) > 100 )  {
        sendErrorMessage( 'First name cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateSurname($sSurname) {
    if( strlen($sSurname) <= 2 ) {
        sendErrorMessage( 'Surname has to be at least 2 characters' , __LINE__ );
    }

    if( strlen($sSurname) > 100 ) {
        sendErrorMessage( 'Surname cannot be longer then 100 characters' , __LINE__ );
    }
}

function validatePassword($sPassword)
{
    if( strlen($sPassword) <= 12 ) {
        sendErrorMessage('Password needs to be at least 12 characters', __LINE__);
    }
    if( strlen($sPassword) > 255 ) {
        sendErrorMessage('Password cannot be longer then 255 characters', __LINE__);
    }
    if( !preg_match("#[0-9]+#", $sPassword) ) {
        sendErrorMessage('Password needs to contain at least one number', __LINE__);
    }
    if( !preg_match("#[A-Z]+#", $sPassword) ) {
        sendErrorMessage('Password needs to contain at least one capitalized letter', __LINE__);
    }
    if( !preg_match("#[a-z]+#", $sPassword) ) {
        sendErrorMessage('Password needs to contain at least one lowercase letter', __LINE__);
    }
}

function validateUsername($sUsername) {
    if( strlen($sUsername) <= 6 ) {
        sendErrorMessage( 'Username has to be at least 6 characters' , __LINE__ );
    }
    if( strlen($sUsername) > 100 ) {
        sendErrorMessage( 'Username cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateEmail($sEmail) {
    if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL) ) {
        sendErrorMessage( 'Email is invalid' , __LINE__ );
    }
    if( strlen($sEmail ) > 255){
        sendErrorMessage( 'Email cannot be longer then 100 characters' , __LINE__ );
    }
}

function validateAddress($sAddress) {
    if( strlen($sAddress) > 50 || strlen($sAddress) <= 4 ) {
        sendErrorMessage( 'Address is not valid' , __LINE__ );
    }
}

function validateZip($iZip) {
    if( strlen((string)($iZip)) > 4 ) {
        sendErrorMessage( 'Zip is not valid' , __LINE__ );
    }
}

function validatePin($iPin) {
    if( strlen((string)($iPin)) > 4 ) {
        sendErrorMessage( 'Pin is not valid' , __LINE__ );
    }
}

function validatePhoneNumber($iPhoneNumber) {
    if( strlen((string)($iPhoneNumber)) > 8 || strlen((string)($iPhoneNumber)) < 8 ) {
        sendErrorMessage( 'Phone number has to be 8 digits. Only danish numbers are allowed' ,
            __LINE__ );
    }
}

function validateExpirationDate($sExpiration) {
    // https://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0{2})$/", $sExpiration)) {
        echo sendErrorMessage('Expiration date must be a valid date', __LINE__);
    }
}

function validateCCV($iCCV) {
    if (strlen($iCCV) != 3) {
        echo sendErrorMessage('CCV must be exactly 3 numbers', __LINE__);
    }
}

function validateIBAN($sIBAN)
{
    if (strlen($sIBAN) != 18) {
        echo sendErrorMessage('IBAN must be exactly 18 charecters', __LINE__);
    }
    if (!preg_match("/DK\d{16}$/", $sIBAN)) {
        echo sendErrorMessage('IBAN must be valid', __LINE__);
    }
}
