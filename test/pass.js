setInterval(checkMail,500);
function checkMail() {
    mail = document.getElementById('mail');
    if(mail.value != ''){
        reRotateMagnet();
        afficherPass();
    }
}