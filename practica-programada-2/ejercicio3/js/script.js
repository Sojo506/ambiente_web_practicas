document.querySelector("#form").addEventListener("submit", (e) => {
    e.preventDefault();
    const mensaje = document.querySelector("#mensaje");
    const edad = document.querySelector("#edad-input").value;

     if (isNaN(edad) || edad <= 0 || edad > 100) {
        Swal.fire({
            title: "¡Edad inválida!",
            text: "Por favor, ingrese una edad válida entre 1 y 100.",
            icon: "error",
            confirmButtonText: "Aceptar",
        });
        return;
    }

    
    if (edad >= 18) {
        mensaje.textContent = "Eres mayor de edad";
    } else {
        mensaje.textContent = "Eres menor de edad";
    }
});