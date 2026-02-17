const modal = document.getElementById("Noti-modal");
const Notimodal = () =>{
    modal.showModal()
}

const closeModal = ()=>{
    modal.close();
}


const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})


// select the button and the div


function addElement(entrada){ //recibe como parametro el nombre del boton pulsado
  
  var filtro = entrada;
  const contenedor = document.querySelector("#cambia-cont"); //se selecciona el padre
  //console.log(contenedor);

  const newdiv=document.createElement("div"); // se crea el div a agregar
  newdiv.classList.add("filtro-indicador"); // se agrega una clase al div
  newdiv.id = entrada; // agrgegamos un id
  const divp=document.createElement("div");
  divp.classList.add("filtro-indicador-p");
  const newp = document.createElement("p"); // se crea un elementeo que ira en el div
  newp.innerHTML = entrada; // se agrega contenido al elemento que ira en el div
  const boton = document.createElement("button"); //creamos boton
  boton.textContent='X';
  boton.classList.add("filtro-delete");
  boton.addEventListener('click', () => {
    quitar(entrada);
  });

  newdiv.appendChild(divp); // se agrega el contenido al div que se agregara en el padre
  divp.appendChild(newp);
  newdiv.appendChild(boton);
  contenedor.appendChild(newdiv); // se agrega el div al padre

  // quitar elementos
  
  const quitade = document.getElementById("A-" + entrada); //se selecciona el padre
  const saca = document.getElementById("R-" + entrada); //se selecciona el hijo
  const throwawayNode = quitade.removeChild(saca);
  
}

function quitar(entrada){
  //regresar el boton a la lista de filtros
  const agregaen = document.querySelector("#A-" + entrada); //se selecciona el padre
  console.log(agregaen);
  const newdiv=document.createElement("div"); // se crea el div a agregar
  newdiv.id = "R-" + entrada;
  const boton = document.createElement("button"); //creamos boton
  boton.classList.add("button-filtro"); // se agrega una clase al div
  boton.textContent = entrada;
  boton.addEventListener('click', () => {
    addElement(entrada);
  });
  newdiv.appendChild(boton);
  agregaen.appendChild(newdiv); // se agrega el div al padre


  // quitar elementos
  const contenedor = document.getElementById("cambia-cont"); //se selecciona el padre
  const quitar = document.getElementById(entrada); //se selecciona el hijo
  const throwawayNode = contenedor.removeChild(quitar);
  //const garbage = contenedor.removeChild(quitar);

  //garbage=contenedor.removeChild(quitar);

}


function desplegar(idcategoria){
  
  var contenedor = document.getElementById("cont-" + idcategoria); //selecciona el dvi contenedor
  console.log(contenedor);
  if(contenedor.style.visibility=="hidden"){ //comprueba el estado de visibilidad y lo cambia
      contenedor.style.visibility="visible"
  }else{
    contenedor.style.visibility="hidden"
  }
  

}