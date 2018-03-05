function checkmin(){
    var box = document.getElementsByClassName('single-checkbox');
    var c = 0;
    for (var i = 0; i < box.length; i++) {
        if (box[i].checked){
            c++;
        }
    }
    return c;
}

function view(c){
    if (c<5){
        var b = document.getElementsByClassName('majcomp');
        for (var i = 0; i < b.length; i++) {
            b[i].style.visibility='hidden';
        }
    }else{
        var b = document.getElementsByClassName('majcomp');
        for (var i = 0; i < b.length; i++) {
            b[i].style.visibility='visible';
        }
    }
}

function look(){
    var a = checkmin();
    view(a);
}

setInterval(look,500);