const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';
document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se declaran las variables segun el numero de campos, a evaluar.
    let a, b, d, e, f, h, i, j, l, n, o, q, r, t, u, w, x, z;

    //Se igualan las variables a el campo de texto de la vista mediante el id.
    a  = document.getElementById('input-abc-a').value;
    b  = document.getElementById('input-abc-b').value;
    d  = document.getElementById('input-abc-d').value;
    e  = document.getElementById('input-abc-e').value;
    f  = document.getElementById('input-abc-f').value;
    h  = document.getElementById('input-abc-h').value;
    i  = document.getElementById('input-abc-i').value;
    j  = document.getElementById('input-abc-j').value;
    l  = document.getElementById('input-abc-l').value;
    n  = document.getElementById('input-abc-n').value;
    o  = document.getElementById('input-abc-o').value;
    q  = document.getElementById('input-abc-q').value;
    r  = document.getElementById('input-abc-r').value;
    t  = document.getElementById('input-abc-t').value;
    u  = document.getElementById('input-abc-u').value;
    w  = document.getElementById('input-abc-w').value;
    x  = document.getElementById('input-abc-x').value;
    z  = document.getElementById('input-abc-z').value;

    /**
     * 18 letras del alfabeto 
     * 1 punto
     * Cada letra 1/18 = 0.056
     */
    let puntoLetra = 1/18;
    let totalPunto = 0;

    console.log("entro a la funcion ");
    console.log("entro " + a);
    console.log("entro " + a.toUpperCase());
    console.log("entro " + a.toUpperCase().localeCompare("A"));

    if(a.toUpperCase().localeCompare("A")==0){
            totalPunto =  totalPunto + puntoLetra;
        console.log("Total " + totalPunto );
    }

    if(b.toUpperCase().localeCompare("B")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(d.toUpperCase().localeCompare("D")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(e.toUpperCase().localeCompare("E")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(f.toUpperCase().localeCompare("F")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(h.toUpperCase().localeCompare("H")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(i.toUpperCase().localeCompare("I")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(j.toUpperCase().localeCompare("J")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(l.toUpperCase().localeCompare("L")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(n.toUpperCase().localeCompare("N")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(o.toUpperCase().localeCompare("O")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(q.toUpperCase().localeCompare("Q")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(r.toUpperCase().localeCompare("R")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(t.toUpperCase().localeCompare("T")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(u.toUpperCase().localeCompare("U")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(w.toUpperCase().localeCompare("W")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(x.toUpperCase().localeCompare("X")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(z.toUpperCase().localeCompare("Z")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 5;
    document.getElementById('idcliente').value = users.value;
    document.getElementById('points').value = notatotal;
    document.getElementById('idlibro').value = libro;
    action = 'create';
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroCinco1');
    sweetAlert(1, 'Resultados ingresados' + users.value + 'sera', null);
    return true;


});