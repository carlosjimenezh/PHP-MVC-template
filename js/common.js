//agregar todas las funciones comunes aquí, para después importarlas en los archivos js de cada vista
// como ocultarElemento, mostrarElemento, etc

export function show(selector) {
  const elemento = document.querySelector(selector);
  if (elemento && elemento.classList.contains("w3-hide")) {
    elemento.classList.remove("w3-hide");
  } else {
    console.error("no existe el elemento");
  }
}

export function hide(selector) {
  const elemento = document.querySelector(selector);
  if (elemento && !elemento.classList.contains("w3-hide")) {
    elemento.classList.add("w3-hide");
  } else {
    console.error("no existe el elemento");
  }
}
