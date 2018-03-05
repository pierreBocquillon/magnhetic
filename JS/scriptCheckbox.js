/*$('.fav_checkbox').on('change', function() {
    if(this.checked) {
        $('.single-checkbox').checked = false;
    }
});*/

$('.single-checkbox').on('change', function() {
    if($('.single-checkbox:checked').length > 5) {
        this.checked = false;
    }
});

$('.fav_checkbox').on('change', function() {
    if($('.fav_checkbox:checked').length > 1) {
        this.checked = false;
    }
});

$('.single-checkbox2').on('change', function() {
    if($('.single-checkbox2:checked').length > 4) {
        this.checked = false;
    }
});

$('.single-checkbox').on('change', function() {
    if($('.single-checkbox:checked').length == 5) {
        $('.fav_checkbox').prop("disabled", false);
    }
});

$('.single-checkbox').on('change', function() {
    if($('.single-checkbox:checked').length < 5){
        $('.fav_checkbox').prop("disabled", true); // Element(s) are now enabled.
    }
});
