document.addEventListener("DOMContentLoaded", function () {
    const monto = document.getElementById("monto");

    if (monto) {
        monto.addEventListener("input", function () {

            if (this.value <= 0) {
                alert("El monto debe ser mayor a 0");
                this.value = "";
            }
        });
    }
});