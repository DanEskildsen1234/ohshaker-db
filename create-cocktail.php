<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Create cocktail</title>
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['managerID'])) {
            header('Location: index.php');
        }
        include_once('components/header.php');

    ?>

    <section>
        <form data-create-form class="form">
            <span data-error class="error-box"></span>
            <input placeholder="Cocktail name" id="cocktailName" type="text">
            <h3>Shaken or stirred?</h3>
            <select id="shakenStirred">
                <option disabled>Shaken or stirred?</option>
                <option></option>
                <option>Shaken</option>
                <option>Stirred</option>
            </select>
            <h3>Cubed or crushed ice?</h3>
            <select id="cubedCrushed">
                <option disabled>Cubed or crushed ice?</option>
                <option></option>
                <option>Cubed</option>
                <option>Crushed</option>
            </select>
            <h3>Recipe</h3>
            <textarea maxlength="255" placeholder="Recipe" id="recipe"></textarea>

            <div data-ingredients>
                <h3>Ingredients</h3>
                <button data-add-ingredient>Add ingredient</button>

                <template data-ingriedient-template>
                    <div data-ingredient>
                        <input placeholder="Ingredient name" id="ingredient" data-search-input type="text">
                        <section data-search-results>

                        </section>
                        <template data-search-item>
                            <a>
                                <p></p>
                            </a>
                        </template>

                        <input placeholder="Measurement" id="measurement" type="text">
                        <select id="measurementType">
                            <option disabled>Measurement type</option>
                            <option>ml</option>
                            <option>cl</option>
                            <option>dl</option>
                            <option>l</option>
                            <option>gram</option>
                            <option>slice</option>
                            <option>wedge</option>
                            <option>part</option>
                            <option>dash</option>
                            <option>tbsp</option>
                            <option>tsp</option>
                        </select>
                    </div>
                </template>
            </div>

            <button class="btn" data-create>Submit</button>
        </form>
    </section>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/create-cocktail.js"></script>
</body>
</html>
