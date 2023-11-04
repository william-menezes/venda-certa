document.forms.formLogin.onsubmit = validateForm;

function validateForm(e) {
  let form = e.target;
  let formIsValid = true;

  const hintEmail = form.email.nextElementSibling;
  const hintPassword = form.password.nextElementSibling;

  hintEmail.textContent = "";
  hintPassword.textContent = "";

  if (form.email.value === "" || !isValidEmail(form.email.value)) {
    hintEmail.style.display = "block";
    hintEmail.textContent = "Digite um endereço de email válido.";
    formIsValid = false;
  }
  if (form.password.value === "") {
    hintPassword.style.display = "block";
    hintPassword.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }

  if (!formIsValid) e.preventDefault();
}

function isValidEmail(email) {
  const validEmailRegex =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  if (!email.match(validEmailRegex)) {
    return false;
  } else {
    return true;
  }
}
