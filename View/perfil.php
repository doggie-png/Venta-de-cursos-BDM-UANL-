<!--
session_start();

if (!isset($_SESSION['Usuario'])) {
    header('Location: /index.php');
    exit();
}

$usuario = $_SESSION['Usuario'];
$fotoBase64 = base64_encode($usuario['Foto']);
$extension = $usuario['Extension'];
$foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;
$rolUser = $usuario['Rol'];
include_once("../Control/ActualizarPerfil.php");

-->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="View/css/perfil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/ImgPreview.js"></script>
    <script src="js/perfil.js"></script>
</head>


  <div class="container text-center" id="perfil">
    <div class="row align-items-center">
      <div class="col-xs-12">
        <div class="user">
          <h1>Mi Perfil</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="listas">
    <h1>Información de usuario</h1>
    <form action="index.php?control=perfil&accion=actualizar" id="profile-form" method="POST" enctype="multipart/form-data">
      <div class="row align-items-center" id="Opciones">
        <div class="col-md-6" id="Login">
          <div class="info-user">
            <h2>Usuario</h2>
            <input class="input-perfil" type="text" id="user" name="user" value="<?php echo $usuario['NomUsuario']; ?>">
            <h2>Nombre(s)</h2>
            <input class="input-perfil" type="text" id="names" name="names" value="<?php echo $usuario['Nombres']; ?>">
            <h2>Apellidos</h2>
            <input class="input-perfil" type="text" id="lastnames" name="lastnames" value="<?php echo $usuario['Apellidos']; ?>">
            <h2>Email</h2>
            <input class="input-perfil" type="text" id="email" name="email" value="<?php echo $usuario['Email']; ?>">
            <h2>Contraseña</h2>
            <input class="input-perfil" type="password" id="pass" name="pass" value="<?php echo $usuario['Contra']; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="info-user">
            <h2>Fecha de nacimiento</h2>
            <input class="input-perfil" type="date" id="date" name="date" value="<?php echo $usuario['FechaNac']; ?>">
            <h2>Género</h2>
            <select class="input-perfil" id="genero" name="genero">
              <option value= "1" <?php echo $usuario['Genero'] == '1' ? 'selected' : ''; ?>>Femenino</option>
              <option value= "2" <?php echo $usuario['Genero'] == '2' ? 'selected' : ''; ?>>Masculino</option>
            </select>
            <h2>Foto de perfil</h2>
            <input class="input-perfil" type="file" id="img-perfil" name="foto" accept="image/*" onchange="previewImage(event)">
            <img src="<?php echo $foto; ?>" alt="Vista previa" id="imgpreview" style="width: 100%; max-width: 150px; margin-top: 10px;">
            <button type="submit" class="btn-p" id="btn-cambio" name="UpdatePerfil">Guardar Cambios</button>
            <a class="logOut" href="Control/LogOut.php">Salir de Sesión</a>
          </div>
        </div>
      </div>
    </form>
  </div>

  <form id="eliminar-form" action="lading page.html">
    <button class="btn-p" id="btn-eliminar">Eliminar perfil</button> <!--falta esta wea no? -->
  </form>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
