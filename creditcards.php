<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Credit cards</title>
</head>
<body> 
    <?php
        session_start();
        if(empty($_SESSION['managerID'])) {
            header('Location: index.php');
        }
    ?>

    <div id="card-field-input">
        <span data-error class="error-box"></span>
        <span data-success class="success-box"></span>

        <input data-expDate name="expiration" type="text" placeholder="Expiration date (MM/YY)" maxlength="5">
        <input data-CCV name="CCV" type="text" placeholder="CCV" maxlength="3">
        <input data-IBAN name="IBAN" type="text" placeholder="IBAN" maxlength="18">
        <button data-btnAddCard id="btnAddCard"><b>Add credit card</b></button>
    </div>

    <div>
        <div class="card-field"><p>Total payment amount</p></div>
        <div class="card-field"><p>Expiration date</p></div>
        <div class="card-field"><p>CCV</p></div>
        <div class="card-field"><p>IBAN</p></div>
    </div>

    <section id="existing-cards" data-existing-cards>
        <template data-existing-cards-template>
            <div>
                <div class="card-field" id="nManagerID"></div>
                <div class="card-field" id="nTotalAmount"></div>
                <div class="card-field" id="dExpiration"></div>
                <div class="card-field" id="cCCV"></div>
                <div class="card-field" id="cIBAN"></div>
            </div>
        </template>
    </section>

    <a href="manager.php">Back</a>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/card.js"></script>
</body>
</html>
