
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <name="viewport" content="width=device-width,
    initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="View/css/login.css">
    <link href='https://unpkg.cm/boxicons@2.1.4/css/booxicons.min.css' rel="stylesheet">
</head>


<div class="wrapper">
    
    <form action="index.php?control=login&accion=loginn"  method="POST">

        <h1>Login</h1>
        <div class="input-box">
          <input type="text" placeholder="Email o Usuario" name="emailuser">
        </div>

        <div class="input-box">
            <input type="password" placeholder="Password" name="pass">
        </div>

        <!-- <div class="remember-forgot">
            <label><input type="checkbox"> Recuerdame</label>
        
        </div>
        <div class="remember-forgot">
            
            <a href="#">forgot password?</a>
        </div> 
        -->

        <span class="error-message" id="login-error"></span>

        <button type="submit" class="btn" name="Login">Login</button>

        <div class="register-link">
            <p>Don't have an account? <a href="index.php?control=user&accion=registrar">Register</a> </p>
        </div>

    </form>
</div>
    



