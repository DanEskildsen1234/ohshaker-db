async function PostCocktailCreate() {
    const url = 'api/cocktail/create.php';
    const method = 'POST';

    // needed for array of ingredients
    const data = new FormData;

    // add all non special input fields to form data
    document.querySelectorAll('[data-create-form] input').forEach((input) => {
        data.append(input.id, input.value);
    });

    // add textarea
    const recipe = document.querySelector('#recipe').value;
    data.append("recipe", recipe);

    // add selectors
    const shakenStirred = document.querySelector('#shakenStirred').value;
    const cubedCrushed = document.querySelector('#cubedCrushed').value;

    data.append("cubedCrushed", cubedCrushed);
    data.append("shakenStirred", shakenStirred);

    // add all ingredients to form data
    document.querySelectorAll('[data-create-form] [data-ingredient]').forEach((row) => {
        const ingredientName = row.querySelector("#ingredient").value;
        const measurement = row.querySelector("#measurement").value;
        const measurementType = row.querySelector("#measurementType").value;
        data.append("ingredient[]", ingredientName);
        data.append("measurement[]", measurement);
        data.append("measurementType[]", measurementType);
    });

    const response = JSON.parse(await fetchData(url, data, method));
    if (response.status === 0) {
        console.log(response);
        document.querySelector('[data-error]').innerText = response.message;
    }
    if (response.status === 1) {
        window.location.href = "index.php";
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    addIngredient();

    document.querySelector('[data-add-ingredient]').addEventListener('click', (e) => {
        e.preventDefault();
        addIngredient();
    });

    document.querySelector('[data-create]').addEventListener('click', (e) => {
        e.preventDefault();
        PostCocktailCreate();
    }, false)
});

function addIngredient() {
    const ingredientSection = document.querySelector("[data-ingredients");
    const ingredientTemplate = document.querySelector("[data-ingriedient-template]").content;

    const cln = ingredientTemplate.cloneNode(true);

    ingredientSection.appendChild(cln);
}
