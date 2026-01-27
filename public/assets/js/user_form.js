//Formulario usuario
const btnreg = document.getElementById("reg"),
    btniniciar = document.getElementById("iniciar"),
    iniciar = document.querySelector(".iniciar");
    registrar = document.querySelector(".registrar");


btnreg.addEventListener("click",e => {
    iniciar.classList.add("hide");
    registrar.classList.remove("hide")
})
btniniciar.addEventListener("click",e => {
    registrar.classList.add("hide");
    iniciar.classList.remove("hide")
})