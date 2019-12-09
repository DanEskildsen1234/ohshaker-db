<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
include_once('components/header.php');

session_start();

if( !empty($_SESSION['managerID']) ) {
    header('Location: settings.php');
}

if( empty($_SESSION['bartenderID']) ) {
    header('Location: cocktails.php');
}
?>
<span data-error class="error-box"></span>
<span data-success class="success-box"></span>

<h1 id="barName"></h1>

<section id="bartender" data-bartender>
        <div>
            <p>Your ID: <?=$_SESSION['bartenderID'] ?></p>
            <p>Your name: <?=$_SESSION['firstName']. " ". $_SESSION['surname']?></p>
        </div>
        <p>Your details can be updated by your manager</p>
</section>


<button class="btn" data-logout>Logout</button>


<script src="assets/js/bartender-settings.js"></script>
</body>
</html>
