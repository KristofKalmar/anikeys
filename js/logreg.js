const LoginForm = document.querySelector(".LoginForm");
const regForm = document.querySelector(".regForm");
const regLink = document.querySelector(".regLink");


regLink.onclick = () => {
    regForm.classList.add('active');
    LoginForm.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('.LoginForm');
    const loginButton = loginForm.querySelector('.btn');
    const usernameInput = loginForm.querySelector('input[type="text"]');
    const passwordInput = loginForm.querySelector('input[type="password"]');

    loginButton.addEventListener('click', function (event) {
        /*event.preventDefault();

        const uname = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (!uname || !password) {
            alert('Kérjük, töltse ki mind a felhasználónevet, mind a jelszót!');
            return;
        }

        alert('Sikeres bejelentkezés!');*/

        window.location.href = 'profil.html';
    });
});