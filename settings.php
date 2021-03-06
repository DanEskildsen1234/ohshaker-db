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
        echo "<span data-manager-id=".$_SESSION['managerID'].">";
    }

    if( !empty($_SESSION['bartenderID']) ) {
        header('Location: settings-bartender.php');
    }

    if( empty($_SESSION['managerID'])) {
        header('Location: index.php');
    }
?>
<span data-error class="error-box"></span>
<span data-success class="success-box"></span>
<a href="creditcards.php">Credit cards</a>
<section id="update-bar">
    <input placeholder="Bar name" id="barName" type="text">
</section>

<section id="update-manager">
    <span data-error class="error-box"></span>
    <input placeholder="First name" id="cFirstname" type="text">
    <input placeholder="Surname" id="cSurname" type="text">
    <input placeholder="Username" id="cUsername" type="text">
    <input placeholder="Email" id="cEmail" type="email">
    <input placeholder="Phone number" id="cPhoneNumber" type="tel">
    <input placeholder="Address" id="cAddress" type="text">
    <input placeholder="Zip" id="cZip" type="number">
    <input placeholder="New password" id="cPassword" type="password">
    <input id="nTotalAmount" type="hidden">

    <p hidden>Date joined: <span id="dJoined"></span></p>
</section>

<section id="update-bartender" data-update-bartender>
    <template data-bartender-template>
        <div>
            <input placeholder="First name" id="cFirstname" type="text">
            <input placeholder="Surname" id="cSurname" type="text">
            <input placeholder="Pin code" id="cPin" type="text">
            <button data-delete-bartender>Delete bartender</button>
        </div>
    </template>
</section>

<section id="create-bartender">
    <form data-create-bartender-form>
        <input placeholder="First name" id="firstName" type="text">
        <input placeholder="Surname" id="surname" type="text">
        <input placeholder="Pin code" id="pin" type="text">
        <button data-create>Create bartender</button>
    </form>
</section>

<button class="btn" data-logout>Logout</button>
<button data-delete-manager>Delete my account</button>

<script src="assets/js/settings.js"></script>
</body>
</html>
