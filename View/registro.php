
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="View/css/registro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="View/js/registro.js"></script>   
</head>

    <div class="container" id="Registro"  >
        <h1>Choose and Enjoy</h1>
        <div class="row align-items-center" id="Opciones">
            <div class="col-XS-6" id="uno">
                <div class="Main-form">
                    <form action="index.php?control=user&accion=registrar" method="POST" enctype="multipart/form-data">
                        <h2>Usuario</h2>
                        <input type="text" id="user" name="user">
                        <br>
                        <h2>Nombre(s)</h2>
                        <input type="text" id="name" name="nombre">
                        <br>
                        <h2>Apellidos</h2>
                        <input type="text" id="lastnames" name="lastnames">
                        <br>
                        <h2>Email</h2>
                        <input type="email" id="email" name="email">
                        <br>
                        <h2>Contraseña</h2>
                        <input type="password" id="pass" name="pass">
                        <br>
                        <h2>Fecha de nacimiento</h2>
                        <input type="date" id="date" name="date">
                        <br>
                        <h2>Genero</h2>
                        <select name="genero" id="genero">Genero
                            <option value="1">Femenino</option>
                            <option value="2">Masculino</option>
                        </select>
                        <br>
                        <h2>Rol</h2>
                        <select name="rol" id="rol">Rol
                            <option value="1">Estudiante</option>
                            <option value="2">Instructor</option>
                        </select>

                        <h2>Foto de perfil</h2>
                        <input type="file" id="img-perfil" name="foto" class="form-control" accept="image/*">
                        <br>
                        <button type="submit" id="Registrar" name="RegistroUsuario">Registrar</button>
                    </form> 
                    
                </div>            
            </div>

            <!--si le sabes al js pues aqui se deberia cargar la imagen seleccionada por el usuario-->
            <div class="col-XS-6" id="dos">
                <div class="img-perfil">
                    <img src="" id="imgP" name="fotopreview">
                </div>
            </div>
        </div>
    </div>

