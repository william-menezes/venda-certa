window.addEventListener("DOMContentLoaded", (event) => {
  const cpf = document.getElementById("cpf");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");

  if(cpf)
  cpf.addEventListener("keyup", formatCPF);

  if(minValue)
  minValue.addEventListener("keyup", formatCurrency);
  
  if(maxValue)
  maxValue.addEventListener("keyup", formatCurrency);

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
});
