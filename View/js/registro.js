function validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validarContrasena(contrasena) {
    const re = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
    return re.test(contrasena);
}

function validarFecha(fecha) {
    const today = new Date();
    const inputDate = new Date(fecha);
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    const hace100años = new Date(today.getFullYear() - 100, today.getMonth(), today.getDay());
    if(inputDate >= tomorrow||inputDate <= hace100años){
        return false;
    }
    else {
        return true;
    }
}

function mostrarImagen(event) {
    const imagen = document.getElementById('imgP');
    const reader = new FileReader();
    reader.onload = function() {
        imagen.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

document.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById('registro');

    form.addEventListener('submit', function(event){

        const usuario = document.getElementById('user').value;
        const name = document.getElementById('name').value;
        const lastnames = document.getElementById('lastnames').value;
        const email = document.getElementById('email').value;
        const contrasena = document.getElementById('pass').value;
        const fecha = document.getElementById('date').value;
        const genero = document.getElementById('genero').value;
        const imgPerfil = document.getElementById('img-perfil').value;
        const rol = document.getElementById('rol').value;

        if(!usuario||!name||!lastnames||!email||!contrasena||!fecha||!genero||!imgPerfil||!rol){
            alert("No pueden haber campos vacios");
            event.preventDefault();
            return;
        }

        if(!validarEmail(email)) {
            alert("El correo introducido no es valido");
            event.preventDefault();
            return;
        }   

        if(!validarContrasena(contrasena)) {
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.");
            event.preventDefault();
            return;
        }

        if (!validarFecha(fecha)){
            alert("Fecha de nacimiento no es valida");
            event.preventDefault();
            return;
        }
    });
});

function añadirComentario(){
    alert('Se ha realizado la compra');
    prompt('Agrega un Comentario ','Tu Comentario...');
}
