const showpassword = document.getElementById('showPassword');
const passwordInput = document.querySelectorAll('[type=password]');

showpassword.addEventListener('change', function(){
    if(this.checked){
        passwordInput.forEach(password => {
            password.type = 'text';
        });
    } else {
        passwordInput.forEach(password => {
            password.type = 'password';
        });
    }
})