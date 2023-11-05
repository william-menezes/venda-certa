window.addEventListener("DOMContentLoaded", (event) => {
  const cpf = document.getElementById("cpf");
  const phone = document.getElementById("phone");
  const cep = document.getElementById("cep");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");
  const price = document.getElementById("price");

  if (cpf) cpf.addEventListener("keyup", formatCPF);

  if (phone) phone.addEventListener("keyup", formatPhone);

  if (cep) cep.addEventListener("keyup", formatCEP);

  if (minValue) minValue.addEventListener("keyup", formatCurrency);

  if (maxValue) maxValue.addEventListener("keyup", formatCurrency);

  if (price) price.addEventListener("keyup", formatCurrency);

  function formatCPF(e) {
    let v = e.target.value.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    e.target.value = v;
  }

  function formatCurrency(e) {
    let v = e.target.value.replace(/\D/g, "");
    v = (v / 100).toFixed(2) + "";
    v = v.replace(".", ",");
    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
    e.target.value = v;
  }

  function formatPhone(e) {
    var v = e.target.value.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1)$2");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    e.target.value = v;
  }

  function formatCEP(e) {
    var v = e.target.value.replace(/\D/g, "");
    v = v.replace(/^(\d{5})(\d)/, "$1-$2");
    e.target.value = v;
  }
});
