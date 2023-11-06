document.forms.formNewAnnouncement.onsubmit = validateForm;

function validateForm(e) {
  let form = e.target;
  let formIsValid = true;

  const hintTitle = form.title.nextElementSibling;
  const hintDescription = form.description.nextElementSibling;
  /* const hintCategory = form.category.nextElementSibling; */
  const hintPrice = form.price.nextElementSibling;
  const hintCep = form.cep.nextElementSibling;
  const hintDistrict = form.district.nextElementSibling;
  const hintCity = form.city.nextElementSibling;
  const hintState = form.state.nextElementSibling;

  hintTitle.textContent = "";
  hintDescription.textContent = "";
  /* hintCategory.textContent = ""; */
  hintPrice.textContent = "";
  hintCep.textContent = "";
  hintDistrict.textContent = "";
  hintCity.textContent = "";
  hintState.textContent = "";

  if (form.title.value === "") {
    hintTitle.style.display = "block";
    hintTitle.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }
  if (form.description.value === "") {
    hintDescription.style.display = "block";
    hintDescription.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }
  /* if (form.category.value === "") {
    hintCategory.style.display = "block";
    hintCategory.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  } */
  if (form.price.value === "") {
    hintPrice.style.display = "block";
    hintPrice.textContent = "Digite um valor válido.";
    formIsValid = false;
  }
  if (form.cep.value === "") {
    hintCep.style.display = "block";
    hintCep.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }
  if (form.district.value === "") {
    hintDistrict.style.display = "block";
    hintDistrict.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }
  if (form.city.value === "") {
    hintCity.style.display = "block";
    hintCity.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }
  if (form.state.value === "") {
    hintState.style.display = "block";
    hintState.textContent = "Este campo é de preenchimento obrigatório.";
    formIsValid = false;
  }

  if (!formIsValid) 
    e.preventDefault();
}
