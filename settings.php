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
    session_start();

    if( !empty($_SESSION['managerID']) ) {
        echo "<span data-manager-id=".$_SESSION['managerID'].">";
    }

    if( !empty($_SESSION['bartenderID']) ) {
        echo "<span data-manager-id=".$_SESSION['bartenderID'].">";
    }
?>
<span data-error class="error-box"></span>
<span data-success class="success-box"></span>

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

    <p>Date joined: <span id="dJoined"></span></p>
</section>

<section id="update-bartender" data-update-bartender>
    <template data-bartender-template>
        <div>
            <input placeholder="First name" id="cFirstname" type="text">
            <input placeholder="Surname" id="cSurname" type="text">
            <input placeholder="Pin code" id="cPin" type="number">
        </div>
    </template>
</section>

<section id="create-bartender">
    <form data-create-bartender-form>
        <input placeholder="First name" id="firstName" type="text">
        <input placeholder="Surname" id="surname" type="text">
        <input placeholder="Pin code" id="pin" type="number">
        <button data-create>Create bartender</button>
    </form>
</section>

<button data-logout>Logout</button>
<button data-delete>Delete my account</button>

<script src="assets/js/functions.js"></script>
<script src="assets/js/settings.js"></script>
</body>
</html>
