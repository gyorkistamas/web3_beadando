const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const passwordConfInput = document.getElementById('password_confirmation');

const nameError = document.getElementById('nameError');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const passwordConfError = document.getElementById('passwordConfError');

const emailAlreadyExistsError = document.getElementById('emailAlreadyExistsError');

const regForm = document.getElementById('regForm');

const  IsNameCorrect = () => nameInput.value.length !== 0;
function IsEmailCorrect() {
    if (emailInput.value.length === 0) {
        return false;
    }

    const regexExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/gi;

    return regexExp.test(emailInput.value)
}
const IsPasswordLongEnough = () => passwordInput.value.length >= 8;
const IsPasswordMatches = () => passwordInput.value === passwordConfInput.value;

nameInput.addEventListener('input', () => {
    if (IsNameCorrect()) {
        nameInput.classList.remove('is-invalid');
        nameInput.classList.add('is-valid');
        nameError.hidden = true;
    }
    else {
        nameInput.classList.add('is-invalid');
        nameInput.classList.remove('is-valid');
        nameError.hidden = false;
    }
});


emailInput.addEventListener('input', () => {
    if (IsEmailCorrect()) {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
        emailError.hidden = true;
    }
    else {
        emailInput.classList.add('is-invalid');
        emailInput.classList.remove('is-valid');
        emailError.hidden = false;
    }

    if (emailAlreadyExistsError != null) {
        emailAlreadyExistsError.hidden = true;
    }
});


passwordInput.addEventListener('input', () => {
    if (IsPasswordLongEnough()) {
        passwordInput.classList.remove('is-invalid');
        passwordInput.classList.add('is-valid');
        passwordError.hidden = true;
    }
    else {
        passwordInput.classList.add('is-invalid');
        passwordInput.classList.remove('is-valid');
        passwordError.hidden = false;
    }

    if (IsPasswordMatches()) {
        passwordConfInput.classList.remove('is-invalid');
        passwordConfInput.classList.add('is-valid');
        passwordConfError.hidden = true;
    }
    else {
        passwordConfInput.classList.add('is-invalid');
        passwordConfInput.classList.remove('is-valid');
        passwordConfError.hidden = false;
    }
});

passwordConfInput.addEventListener('input', () => {
    if (IsPasswordMatches()) {
        passwordConfInput.classList.remove('is-invalid');
        passwordConfInput.classList.add('is-valid');
        passwordConfError.hidden = true;
    }
    else {
        passwordConfInput.classList.add('is-invalid');
        passwordConfInput.classList.remove('is-valid');
        passwordConfError.hidden = false;
    }
});

regForm.addEventListener('submit', (e) => {
    e.preventDefault();

    if (IsNameCorrect() &&
        IsEmailCorrect() &&
        IsPasswordLongEnough() &&
        IsPasswordMatches()) {

        regForm.submit();
    }
});
