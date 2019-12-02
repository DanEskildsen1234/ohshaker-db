<?php

session_start();

if(empty($_SESSION['managerID']) !== true) {
    session_destroy();
    header('Location: /');
}