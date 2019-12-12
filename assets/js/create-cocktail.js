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

function getIngredientSearch(row) {
    let input = row.querySelector('[data-search-input]');
    let resultsLocation = row.querySelector('[data-search-results]');
    const item = row.querySelector( '[data-search-item]').content;

    let lastValue = "";
    let status = false;

    input.addEventListener('keypress', async ()=> {
        const inputValue = input.value;

        if (status === true || inputValue === "" || !/^[a-zA-Z].*$/.test(inputValue
            || lastValue === inputValue) ) {
            return;
        }
        status = true;
        lastValue = inputValue;
        resultsLocation.innerHTML = '';

        const response = await fetch('api/ingredient/search.php' + '?query=' + inputValue, {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            redirect: 'follow',
            referrer: 'no-referrer',
        });

        const results = await response.json();
        results.forEach( (result)=> {
            console.log(result);
            const cln = item.cloneNode(true);
            const ingredientLink = cln.querySelector('a');
            ingredientLink.href = "#";

            const ingredientName = result.cName;

            cln.querySelector('p').innerText = ingredientName;
            ingredientLink.addEventListener('click', (e) => {
                e.preventDefault();
                console.log(ingredientName);
                input.value = ingredientName;
                resultsLocation.innerHTML = '';
            });
            resultsLocation.appendChild(cln);
        });
        status = false;
    }, false);
}

function addIngredient() {
    const ingredientSection = document.querySelector("[data-ingredients");
    const ingredientTemplate = document.querySelector("[data-ingriedient-template]").content;

    const cln = ingredientTemplate.cloneNode(true);

    getIngredientSearch(cln);
    ingredientSection.appendChild(cln);
}
