let nivelContador = 1; //Se empieza en 1 porque ya hay 0 en el View

function mostrarInputRecurso(select) {
    const tipoRecurso = select.value;
    const inputRecursoContainer = select.nextElementSibling;

    inputRecursoContainer.innerHTML = '';

    //Agarra el indice del contenedor para los recursos adicionales
    const nivelIndex = select.name.match(/\d+/)[0]; //Extrae el número de nivel del nombre

    if (tipoRecurso === "imagen" || tipoRecurso === "pdf") {
        inputRecursoContainer.innerHTML = `
            <input type="file" class="input-curso" name="nivel[${nivelIndex}][recurso]" id="recursoAdicional">
        `;
    } else if (tipoRecurso === "url") {
        inputRecursoContainer.innerHTML = `
            <input type="text" class="input-curso" name="nivel[${nivelIndex}][recurso]" id="recursoAdicional" placeholder="Ingrese la URL">
        `;
    }
}

function agregarNivel() {
    const nuevoNivel = document.createElement('div');
    nuevoNivel.classList.add('nivel');
    nuevoNivel.id = `nivel-${nivelContador}`;
    nuevoNivel.style.backgroundColor = 'violet'; 
    nuevoNivel.style.marginBottom = '20px'; 
    nuevoNivel.style.padding = '15px'; 
    
    nuevoNivel.innerHTML = `
        <h3>Nivel ${nivelContador + 1}</h3>
        <h3>Nombre:</h3>
        <input type="text" class="input-curso" name="nivel[${nivelContador}][nombre]" placeholder="Nombre">
        <br>
        <h3>Precio del Nivel:</h3>
        <input type="number" class="input-curso" name="nivel[${nivelContador}][precio]" step="0.01" placeholder="0.00">
        <br>
        <h3>Video:</h3>
        <input type="text" class="input-curso" name="nivel[${nivelContador}][video]" placeholder="Embed link">
        <br>
        <h3>Recurso adicional</h3>
        <select class="input-curso" id="tipoRecurso" name="nivel[${nivelContador}][tipo_recurso]" onchange="mostrarInputRecurso(this)" style="margin-bottom: 20px;">
            <option value="">Seleccione un tipo de recurso</option>
            <option value="imagen">Imagen</option>
            <option value="pdf">PDF</option>
            <option value="url">URL</option>
        </select>
        <div class="input-recurso-container"></div>
    `;

    document.getElementById('niveles-container').appendChild(nuevoNivel);

    nivelContador++;
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("RegistarCurso").addEventListener('submit', function(event) {
        alert("Todo cargado");
        let valid = true;
        let mensajeErrores = "";

        const campos = document.querySelectorAll("input[type='text'], input[type='number'], textarea");
        campos.forEach(campo => {
            if (campo.value.trim() === "") {
                mensajeErrores += `El campo ${campo.name} no puede estar vacío.\n`;
                valid = false;
            }
        });

        const categorias = document.getElementById('categorias').value;
        if (!categorias) {
            mensajeErrores += "Debe seleccionar al menos una categoría.\n";
            valid = false;
        }

        const videoLink = document.getElementById("video").value;
        const iframePattern = /<iframe.*?src="https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]{11}.*?".*?>.*?<\/iframe>/;
        if (!iframePattern.test(videoLink)) {
            mensajeErrores += "El enlace del video debe ser un código embed de YouTube con un iframe válido.\n";
            valid = false;
        }

        const tipoRecurso = document.getElementById("tipoRecurso").value;
        
        if (tipoRecurso != "") {
            const recursoAdicional = document.getElementById("recursoAdicional").value;
            if (tipoRecurso === "pdf" && !recursoAdicional.endsWith(".pdf")) {
                mensajeErrores += "El recurso adicional debe tener la extensión .pdf.\n";
                valid = false;
            }
    
            if (tipoRecurso === "url") {
                const urlPattern = /^(https?:\/\/[^\s$.?#].[^\s]*)$/;
                if (!urlPattern.test(recursoAdicional)) {
                    mensajeErrores += "El recurso adicional debe ser una URL válida.\n";
                    valid = false;
                }
            }
        }

        const precios = document.querySelectorAll("input[name='precio']");
        precios.forEach(precio => {
            if (parseFloat(precio.value) < 0.00) {
                mensajeErrores += `El precio no puede ser menor que 0.00 en ${precio.name}.\n`;
                valid = false;
            }
        });

        if (!valid) {
            event.preventDefault();
            alert(mensajeErrores);
        }
    });
});