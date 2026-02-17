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

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('profile-form');

    form.addEventListener('submit', function(event){
        const usuario = document.getElementById('user').value;
        const names = document.getElementById('names').value;
        const lastnames = document.getElementById('lastnames').value;
        const email = document.getElementById('email').value;
        const contrasena = document.getElementById('pass').value;
        const fecha = document.getElementById('date').value;
        const genero = document.getElementById('genero').value;
        const imgPerfil = document.getElementById('img-perfil').value;

        if(!usuario||!names||!lastnames||!email||!contrasena||!fecha||!genero||!imgPerfil){
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

function alertaEliminado(){
    alert('Se ha elimiando el Usuario');
}