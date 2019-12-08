function PostManagerSignup() {
    console.log('submitted');
    const url = 'api/manager/create.php';
    const method = 'POST';

    const data = {};

    document.querySelectorAll('[data-sign-up-for] input').forEach( (input) => {

    });
}

window.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('[data-create]').addEventListener('click', (e) => {
        e.preventDefault();
        PostManagerSignup();
    }, false)
});