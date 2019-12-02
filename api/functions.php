<?php
function sendErrorMessage( $sErrorMessage , $iLineNumber ){
    echo '{"status":0, "message":"'.$sErrorMessage.'", "line":'.$iLineNumber.'}';
    exit;
}

function sendSuccessMessage( $sSuccessMessage , $iLineNumber ){
    echo '{"status":1, "message":"'.$sSuccessMessage.'", "line":'.$iLineNumber.'}';
    exit;
}