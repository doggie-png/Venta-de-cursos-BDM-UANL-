// Esperar hasta que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Obtener elementos del DOM
    const checkCursoCompleto = document.getElementById("check-curso-completo");
    const checkNiveles = document.querySelectorAll(".check-nivel");
    const inputNivelesSeleccionados = document.getElementById("niveles-seleccionados");
    const ticketTotal = document.getElementById("ticket-total"); // Asegúrate de que el ID sea correcto
    const precioCursoCompleto = parseFloat(document.getElementById('precio-curso').getAttribute('data-precio')); // Convertir el precio a número flotante

    // Evento para manejar "curso completo"
    checkCursoCompleto.addEventListener("change", function () {
        if (checkCursoCompleto.checked) {
            // Desactivar checkboxes de niveles y limpiar selección
            checkNiveles.forEach((checkbox) => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });

            // Actualizar el campo oculto con "curso completo"
            inputNivelesSeleccionados.value = "curso-completo";

            // Mostrar el total del curso completo
            ticketTotal.innerText = "Total: $" + precioCursoCompleto.toFixed(2);
        } else {
            // Activar checkboxes de niveles
            checkNiveles.forEach((checkbox) => {
                checkbox.disabled = false;
            });

            // Limpiar el campo oculto y total
            inputNivelesSeleccionados.value = "";
            ticketTotal.innerText = "Total: $0";
        }
    });

    // Evento para manejar selección de niveles individuales
    checkNiveles.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            // Si se selecciona el curso completo, no hacer nada
            if (checkCursoCompleto.checked) return;

            // Calcular el total
            let total = 0;
            const nivelesSeleccionados = [];

            checkNiveles.forEach((cb) => {
                if (cb.checked) {
                    total += parseFloat(cb.getAttribute("data-precio"));
                    nivelesSeleccionados.push(cb.value); // Guardamos el id del nivel
                }
            });

            // Si no hay niveles seleccionados, limpiar el campo oculto
            if (nivelesSeleccionados.length === 0) {
                inputNivelesSeleccionados.value = "";
            } else {
                inputNivelesSeleccionados.value = nivelesSeleccionados.join(","); // Agregar los ids de los niveles seleccionados
            }

            // Actualizar el total en el ticket
            ticketTotal.innerText = "Total: $" + total.toFixed(2);  // Mostrar con dos decimales
        });
    });

    function validarNombre(nombre) {
        const regex = /^[a-zA-Z\s]+$/; // Solo letras y espacios
        return regex.test(nombre);
    }

    function validarTarjeta(tarjeta) {
        const regex = /^[0-9]{16}$/; // Exactamente 16 números
        return regex.test(tarjeta);
    }

    function validarExpiracion(expiracion) {
        const regex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/; // Formato MM/YY
        return regex.test(expiracion);
    }

    function validarCVV(cvv) {
        const regex = /^[0-9]{3}$/; // Exactamente 3 dígitos
        return regex.test(cvv);
    }

    document.getElementById('pagarCurso').addEventListener('submit', function(event) {
        let valid = true;
        let mensajeErrores = "";

        const nomInput = document.getElementById('datanombre').value;
        const numTarj = document.getElementById('datanum').value;
        const numexp = document.getElementById('dataexp').value;
        const numcod = document.getElementById('datacod').value;
        if(inputNivelesSeleccionados.value == "") {
            valid = false;
            mensajeErrores += "Se debe seleccionar al menos 1 nivel para comprar.\n";
        }

        if(!validarNombre(nomInput)) {
            valid = false;
            mensajeErrores += "El nombre del proprietario no es valido.\n";
        }

        if(!validarTarjeta(numTarj)) {
            valid = false;
            mensajeErrores += "El numero de tarjeta debe ser de 16 digitos.\n";
        }

        if(!validarExpiracion(numexp)) {
            valid = false;
            mensajeErrores += "La fecha de expiracion no es valida.\n";
        }

        if(!validarCVV(numcod)) {
            valid = false;
            mensajeErrores += "El CVV debe ser exactamente 3 digitos.\n";
        }

        if (!valid) {
            event.preventDefault();
            alert(mensajeErrores);
        }
    });
});