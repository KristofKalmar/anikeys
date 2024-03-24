const LoginForm = document.querySelector(".LoginForm");
const regForm = document.querySelector(".regForm");
const regLink = document.querySelector(".regLink");
const LoginLink = document.querySelector(".LoginLink");


regLink.onclick = () => {
    regForm.classList.add('active');
    LoginForm.classList.add('active');
}

LoginLink.onclick = () => {
    regForm.classList.remove('active');
    LoginForm.classList.remove('active');
}

const showHiddenPass = (loginPass, loginEye) =>{
    const input = document.getElementById(loginPass),
          iconEye = document.getElementById(loginEye);

    iconEye.addEventListener('click', () =>{
       
       if(input.type === 'password'){
          
          input.type = 'text';

          
          iconEye.classList.add('bxs-lock-open-alt');
          iconEye.classList.remove('bxs-lock-alt');
       } else{
          
          input.type = 'password';

          
          iconEye.classList.remove('bxs-lock-open-alt');
          iconEye.classList.add('bxs-lock-alt');
       }
    });
};

showHiddenPass('login-pass','login-eye');
showHiddenPass('reg-pass','reg-eye');
showHiddenPass('reg-pass2','reg-eye2');


document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('.LoginForm');
    const loginButton = loginForm.querySelector('.btn');
    const usernameInput = loginForm.querySelector('input[type="text"]');
    const passwordInput = loginForm.querySelector('input[type="password"]');
    
    loginButton.addEventListener('click', function (event) {
        event.preventDefault(); 
        
        const uname = usernameInput.value.trim();
        const password = passwordInput.value.trim();
        
        if (!uname || !password) {
            alert('Kérjük, töltse ki mind a felhasználónevet, mind a jelszót!');
            return;
        }
     
        alert('Sikeres bejelentkezés!');
        
        window.location.href = 'index.html';
    });
});