var mail = document.getElementById("mail");
var pass = document.getElementById("pass");
var magnet = document.getElementById("magnet");
var logo = document.getElementById("logo");
var wave = document.getElementById("wave");

function afficherLogo(){
    magnet.style.visibility='visible';
    logo.style.visibility='visible';
    wave.style.visibility='visible';
    wave.style.opacity='1';
    magnet.style.opacity='1';
    logo.style.opacity='1';
}
function cacherLogo(){
    magnet.style.visibility='hidden';
    logo.style.visibility='hidden';
    wave.style.visibility='hidden';
    wave.style.opacity='0';
    magnet.style.opacity='0';
    logo.style.opacity='0';
}function afficherTxt(){
    logo.style.visibility='visible';
    logo.style.opacity='1';
}
function cacherTxt(){
    logo.style.opacity='0';
    wave.style.opacity='0';
    wave.style.visibility='hidden';
    logo.style.visibility='hidden';
}
function rotateMagnet(){
    magnet.style.transform='scale(1,-1)';
}
function reRotateMagnet(){
    magnet.style.transform='scale(1,1)';
}

function afficherMail(){
    mail.style.visibility='visible';
    mail.style.opacity='1';
}

function afficherPass(){
    pass.style.visibility='visible';
    pass.style.opacity='1';
}

function cacherMail(){
    mail.style.visibility='hidden';
    mail.style.opacity='0';
}

function cacherPass(){
    pass.style.visibility='hidden';
    pass.style.opacity='0';
}
cacherPass();
cacherMail()
cacherLogo();
cacherTxt();
setTimeout(afficherLogo,1000);
setTimeout(rotateMagnet,2000);
setTimeout(cacherTxt,2000);
setTimeout(afficherMail,3000);



