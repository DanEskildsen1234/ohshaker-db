<?php
function sendErrorMessage( $sErrorMessage , $iLineNumber ){
    echo '{"status":0, "message":"'.$sErrorMessage.'", "line":'.$iLineNumber.'}';
    exit;
}