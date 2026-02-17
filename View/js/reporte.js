function vistaAlumno(){
    var _user = "juan22"
    var _name = "Juan Perez"
    var _date = "22/03/24"
    var _course = "5"
    var _var = "3"
    // if(_nom.trim()==''){
    //     alert("Ingrese nombre del producto");
    // }
    // if(_cat.trim()==''){
    //     alert("Ingrese categoria del producto");

    // }
    // if(_precio.trim()==''){
    //     alert("Ingrese precio del producto");
        
    // }
    // if(_stock.trim()==''){
    //     alert("Ingrese stock del producto");
        
    // }

    var newEncabezado = "<th>"+"Usuraio"+"</th><th>"+ "Nombre" +"</th><th>"+"Fecha de ingreso"+"</th><th>"+"Cursos totales"+"</th><th>"+"Cursos completados"+"</th>";
    var fila="<tr><td>"+_user+"</td><td>"+_name+"</td><td>"+_date+"</td><td>"+_course+"</td><td>"+_var+"</td></tr>";
    document.getElementById("encabezado").innerHTML = newEncabezado;
    document.getElementById("tabla").innerHTML = fila;
}

function vistaInstructor(){
    var _user = "juan22"
    var _name = "Juan Perez"
    var _date = "22/03/24"
    var _course = "5"
    var _var = "$700"
    // if(_nom.trim()==''){
    //     alert("Ingrese nombre del producto");
    // }
    // if(_cat.trim()==''){
    //     alert("Ingrese categoria del producto");

    // }
    // if(_precio.trim()==''){
    //     alert("Ingrese precio del producto");
        
    // }
    // if(_stock.trim()==''){
    //     alert("Ingrese stock del producto");
        
    // }

    var newEncabezado = "<th>"+"Usuraio"+"</th><th>"+ "Nombre" +"</th><th>"+"Fecha de ingreso"+"</th><th>"+"Cursos totales"+"</th><th>"+"Ganancias totales"+"</th>";
    var fila="<tr><td>"+_user+"</td><td>"+_name+"</td><td>"+_date+"</td><td>"+_course+"</td><td>"+_var+"</td></tr>";
    var fila1="<tr><td>"+_user+"</td><td>"+_name+"</td><td>"+_date+"</td><td>"+_course+"</td><td>"+_var+"</td></tr>";
    var fila2="<tr><td>"+_user+"</td><td>"+_name+"</td><td>"+_date+"</td><td>"+_course+"</td><td>"+_var+"</td></tr>";
    var fila3="<tr><td>"+_user+"</td><td>"+_name+"</td><td>"+_date+"</td><td>"+_course+"</td><td>"+_var+"</td></tr>";
    document.getElementById("encabezado").innerHTML = newEncabezado;
    document.getElementById("tabla").innerHTML = fila;
    
    
    
}