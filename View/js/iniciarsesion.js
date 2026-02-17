document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('InicioSesion');

    form.addEventListener('submit', function(event) {
        const usuario = document.getElementById('emailuser').value;
        const pass = document.getElementById('pass').value;

        if(!usuario || !pass) {
            alert("Todos los campos son obligatorios.");
            event.preventDefault();
            return;
        }
    });
});