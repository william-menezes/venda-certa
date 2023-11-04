document.forms.formSignup.onsubmit = validateForm;

function validateForm(e) {
  let form = e.target;
  let formIsValid = true;

  const hintName = form.name.nextElementSibling;
  const hintCPF = form.cpf.nextElementSibling;
  const hintEmail = form.email.nextElementSibling;
  const hintPassword = form.password.nextElementSibling;

  hintName.textContent = "";
  hintCPF.textContent = "";
  hintEmail.textContent = "";
  hintPassword.textContent = "";

 
  if (form.name.value.length < 4) {
    hintName.style.display = "block";
    hintName.textContent = "Digite um nome com mais de 4 caracteres.";
    formIsValid = false;
  }
  if (form.cpf.value === "" || !isValidCPF(form.cpf.value)) {
    hintCPF.style.display = "block";
    hintCPF.textContent = "Digite um CPF válido.";
    formIsValid = false;
  }
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

function isValidCPF(cpf) {
  // Validar se é String
  if (typeof cpf !== "string") return false;

  // Tirar formatação
  cpf = cpf.replace(/[^\d]+/g, "");

  // Validar se tem tamanho 11 ou se é uma sequência de digitos repetidos
  if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false;

  // String para Array
  cpf = cpf.split("");

  const validator = cpf
    // Pegar os últimos 2 digitos de validação
    .filter((digit, index, array) => index >= array.length - 2 && digit)
    // Transformar digitos em números
    .map((el) => +el);

  const toValidate = (pop) =>
    cpf
      // Pegar Array de items para validar
      .filter((digit, index, array) => index < array.length - pop && digit)
      // Transformar digitos em números
      .map((el) => +el);

  const rest = (count, pop) =>
    ((toValidate(pop)
      // Calcular Soma dos digitos e multiplicar por 10
      .reduce((soma, el, i) => soma + el * (count - i), 0) *
      10) %
      // Pegar o resto por 11
      11) %
    // transformar de 10 para 0
    10;

  return !(rest(10, 2) !== validator[0] || rest(11, 1) !== validator[1]);
}

const cpf = document.getElementById("cpf");
cpf.addEventListener("keyup", formatarCPF);
function formatarCPF(e) {
  let v = e.target.value.replace(/\D/g, "");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  e.target.value = v;
}
