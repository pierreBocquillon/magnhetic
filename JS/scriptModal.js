window.onload =function () {

    var modal = document.getElementById('modalAddProject');

// Get the button that opens the modal
    var btn = document.getElementById("btnAddProject");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close3")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var modal2 = document.getElementById('modalAddTag');

// Get the button that opens the modal
    var btn2 = document.getElementById("btnAddTag");

// Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal
    btn2.onclick = function() {
        modal2.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span2.onclick = function() {
        modal2.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }

    var modal3 = document.getElementById('modalAddHob');

// Get the button that opens the modal
    var btn3 = document.getElementById("btnAddHob");

// Get the <span> element that closes the modal
    var span3 = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal
    btn3.onclick = function() {
        modal3.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span3.onclick = function() {
        modal3.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal3) {
            modal3.style.display = "none";
        }
    }
}
