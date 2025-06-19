/**
 * Validar un input, crear un elemento label que contenga el input a validar y su mensaje de error con w3-hide
 * @param {HTMLElement} input - Elemento a validar.
 * @param {regex} regex - Regex de la validación.
 * @returns {boolean} Retorna true si el input es válido
 */
export function validarInput(input, regex) {
  const { value } = input;
  const error = input.parentNode.querySelector(".error");
  if (regex.test(value)) {
    input.classList.remove("invalid");
    error?.classList.add("w3-hide");
    return true;
  }
  input.classList.add("invalid");
  error?.classList.remove("w3-hide");
  return false;
}

/**
 * Validar un input para imagen, crear un elemento label que contenga el input a validar y su mensaje de check con w3-hide
 * @param {Event} e - Evento `change` del input de tipo `file`.
 * @returns {boolean} Retorna `true` si la imagen es válida (tipo y tamaño), `false` si no lo es.
 */
export function validarImagen(e) {
  const imagen = e.target.files[0];
  const check = e.target.parentNode.querySelector(".check");

  if (!imagen) return; // Si no seleccionó nada, salir

  // Validar tipo
  if (imagen.type !== "image/jpeg") {
    Swal.fire({
      title: "",
      text: "Image must be JPG",
      icon: "error",
    });
    e.target.value = ""; // Limpiar input
    check?.classList.add("w3-hide");
    return false;
  }

  // Validar tamaño
  const fileSizeMB = imagen.size / 1024 / 1024;
  if (fileSizeMB > 10) {
    Swal.fire({
      title: "",
      text: "The image exceeds the allowed limit of 10 MB.",
      icon: "error",
    });
    e.target.value = ""; // Limpiar input
    check?.classList.add("w3-hide");
    return false;
  }

  check?.classList.remove("w3-hide");
  return true;
}
