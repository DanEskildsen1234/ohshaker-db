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
    <div id="card-field-input">
        <span data-error class="error-box"></span>
        <span data-success class="success-box"></span>
        <input data-cardID name="cardID" type="number" placeholder="Credit Card ID">
        <button data-payBtn id="btnPay"><b>Renew Subscription</b></button>
    </div>

    <div>
        <div class="card-field"><p>Credit card ID</p></div>
        <div class="card-field"><p>Manager ID</p></div>
        <div class="card-field"><p>Total payment amount</p></div>
        <div class="card-field"><p>Expiration date</p></div>
        <div class="card-field"><p>CCV</p></div>
        <div class="card-field"><p>IBAN</p></div>
    </div>

    <section id="existing-cards" data-existing-cards>
        <template data-existing-cards-template>
            <div data-card-id>
                <div class="card-field" id="nCreditCardID"></div>
                <div class="card-field" id="nManagerID"></div>
                <div class="card-field" id="nTotalAmount"></div>
                <div class="card-field" id="dExpiration"></div>
                <div class="card-field" id="cCCV"></div>
                <div class="card-field" id="cIBAN"></div>
            </div>
        </template>
    </section>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/card.js"></script>
</body>
</html>