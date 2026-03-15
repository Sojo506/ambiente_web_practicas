const btn_calcular = document.querySelector("#btn-calcular");
const monto_cargas = document.querySelector("#monto-cargas");
const monto_impuestos_renta = document.querySelector("#monto-impuesto-renta");
const monto_salario_neto = document.querySelector("#monto-salario-neto");

btn_calcular.addEventListener("click", () => {
    const sueldo = parseFloat(document.querySelector("#sueldo").value);

    if (isNaN(sueldo) || sueldo <= 0) {
        Swal.fire({
            title: "¡Sueldo inválido!",
            text: "Por favor, ingrese un sueldo válido.",
            icon: "error",
            confirmButtonText: "Aceptar",
        });
        return;
    }

    const cargas_sociales = sueldo * 0.1083;
    const base = sueldo - cargas_sociales;
    let impuesto_renta = 0;

    if (base > 4783000) {
        impuesto_renta += (base - 4783000) * 0.25;
        impuesto_renta += (4783000 - 2392000) * 0.20;
        impuesto_renta += (2392000 - 1363000) * 0.15;
        impuesto_renta += (1363000 - 929000) * 0.10;
    }
    else if (base > 2392000) {
        impuesto_renta += (base - 2392000) * 0.20;
        impuesto_renta += (2392000 - 1363000) * 0.15;
        impuesto_renta += (1363000 - 929000) * 0.10;
    }
    else if (base > 1363000) {
        impuesto_renta += (base - 1363000) * 0.15;
        impuesto_renta += (1363000 - 929000) * 0.10;
    }
    else if (base > 929000) {
        impuesto_renta += (base - 929000) * 0.10;
    }

    const salario_neto = sueldo - cargas_sociales - impuesto_renta;

    monto_cargas.textContent = `₡ ${cargas_sociales.toFixed(2)}`;
    monto_impuestos_renta.textContent = `₡ ${impuesto_renta.toFixed(2)}`;
    monto_salario_neto.textContent = `₡ ${salario_neto.toFixed(2)}`;
});