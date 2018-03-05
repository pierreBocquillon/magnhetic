var img = document.getElementById("img");
var h1=document.getElementById("h1");
var h2=document.getElementById("h2");


function afficherImg(){
    img.style.visibility='visible';
    img.style.opacity='1';
    img.style.height='400px';
    img.style.width='400px';
}
function afficherHeadings(){
    h1.style.opacity='1';
    h2.style.opacity='1';
}
function redirect() {
    //document.location.href="../profil.php?id_profil="+$pid;
    document.location.href="../home.php";
}
function shutup() {
    h1.style.opacity='0';
    h2.style.opacity='0';
    img.style.visibility='hidden';
    img.style.opacity='0';
}


setTimeout(afficherImg, 100);
setTimeout(afficherHeadings,1000)
setTimeout(shutup,2000)
setTimeout(redirect,3000);

