<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Payment</title>
</head>
<body> 
    <?php
        require_once('api/functions.php');
        session_start();
        if(empty($_SESSION['managerID'])) {
            sendErrorMessage( 'Not authenticated' , __LINE__ );
        }
    ?>    

    <div id="payment-field-input">
        <span data-error class="error-box"></span>
        <span data-success class="success-box"></span>
        <input data-cardID name="cardID" type="number" placeholder="Credit Card ID">
        <button data-payBtn id="btnPay"><b>Renew Subscription</b></button>
    </div>

    <div>
        <div class="payment-field"><p>Credit card ID</p></div>
        <div class="payment-field"><p>Amount</p></div>
        <div class="payment-field"><p>Payment date</p></div>
    </div>

    <section id="previous-payments" data-previous-payments>
        <template data-previous-payments-template>
            <div>
                <div class="payment-field" id="nCreditCardID"></div>
                <div class="payment-field" id="nAmount"></div>
                <div class="payment-field" id="dPayment"></div>
            </div>
        </template>
    </section>

    <a href="manager.php">Back</a>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/payment.js"></script>
</body>
</html>
