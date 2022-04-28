document.addEventListener('DOMContentLoaded', () => {

    // Navegation Menu
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);

    // Slider
    var elems = document.querySelectorAll('.slider');
    var instances = M.Slider.init(elems, {
        indicators: false,
        height: 500,
        duration: 500,
        interval: 3000
    });       
});


document.addEventListener('DOMContentLoaded', function() {
    //modals
    M.Modal.init(document.querySelectorAll('.modal'));
    //Datepickers    
    //var instance = M.Datepicker.getInstance(elem);
    var elems = document.querySelectorAll('.datepicker');
    
  });

