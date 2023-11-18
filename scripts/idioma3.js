var check=document.querySelector(".check");
check.addEventListener('click', idioma);

function idioma(){
    let id=check.checked;
    if (id==true){
        location.href="eng/servicios(eng).html";
}else{
    location.href="../servicios.html";
}
}