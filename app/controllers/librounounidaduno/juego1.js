const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';


document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var one, five, nine, thirdteen, two, six,
        ten, fourteen, three, seven, eleven, fifteen,
        four, eight, twelve, sixteen;
    //definición de variables 
    one = document.getElementById('input-oneh').value;//a
    five = document.getElementById('input-fivec').value;//r
    nine = document.getElementById('input-niner').value;//a
    thirdteen = document.getElementById('input-thirdteenu').value;//o
    two = document.getElementById('input-twoe').value;//c
    six = document.getElementById('input-sixn').value;//o
    ten = document.getElementById('input-tend').value;//d
    fourteen = document.getElementById('input-fourteenl').value;//l
    three = document.getElementById('input-threef').value;//o
    seven = document.getElementById('input-sevenh').value;//h
    eleven = document.getElementById('input-elevench').value;//o
    fifteen = document.getElementById('input-fifteenf').value;//g
    four = document.getElementById('input-fourc').value;//f
    eight = document.getElementById('input-eightt').value;//t
    twelve = document.getElementById('input-twelvey').value;//e
    sixteen = document.getElementById('input-sixteenk').value;//e
    // declacración de variables de puntajes 
    let promedio; 
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10, pt11, pt12, pt13, pt12
    // declaración de condicionales 
    if (one === "" && five === "" && nine === "" && thirdteen === "" && two === "" && six === "" && ten === "" &&
        fourteen === "" && three === "" && seven === "" && eleven === "" && fifteen === "" && four === ""
        || eight === "" && twelve === "" && sixteen === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (one === "a" && five === "r" && nine === "a" && thirdteen === "o" && two === "c" && six === "o"
        && ten === "d" && fourteen === "l" && three === "o" && seven === "h" && eleven === "o"
        && fifteen === "g" && four === "f" && eight === "t"
        && twelve === "e" && sixteen === "e") {
            
            if(one === "a"){
                var pt1 =0.63;
                console.log('0.63');
             }
             if(five === "r"){
                var pt2 =0.63;
                console.log('0.63');
             }
             if(nine === "a"){
                var pt3 =0.63;
                console.log('0.63');
             }
             if(thirdteen === "o"){
                var pt4 =0.63;
                console.log('0.63');
             }
             if(two === "c"){
                var pt5 =0.63;
                console.log('0.63');
             }
             if(six === "o"){
                var pt6 =0.63;
                console.log('0.63');
             }
             if(ten === "d"){
                var pt7 =0.63;
                console.log('0.63');
            }
            if(fourteen === "l"){
                var pt8 =0.63;
                console.log('0.63');
            }
            if(three === "o"){
                var pt9 =0.63;
                console.log('0.63');
            }
            if(seven === "h"){
                var pt10 =0.63;
                console.log('0.63');
            }
            if(eleven === "o"){
                var pt11 =0.63;
                console.log('0.63');
            }
            if(twelve === "e"){
                var pt12 =0.63;
                console.log('0.63');
            }
            if(sixteen === "o"){
                var pt13 =0.63;
                console.log('0.63');                
            }
            if(fifteen === "g"){
                var pt14 =0.63;
                console.log('0.63');
            }
            if(four === "f"){
                var pt15 =0.63;
                console.log('0.63');
            }
            if(eight === "t"){
                var pt16 =0.63;
                console.log('0.63');
            }

            let suma = parseFloat(pt1 + pt2 + pt3 + pt4 + pt5+ pt6 + pt7 + pt8 + pt9+ pt10+ pt11 + pt12+ pt13+ pt14 + pt15+ pt16)

            promedio = 1.11;
            var libro = 4; 
            document.getElementById('idcliente').value=users.value ;
            document.getElementById('points').value=promedio ;
            document.getElementById('idlibro').value=libro ;
            
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroUno');
            // sweetAlert(1, 'good job', null);
            // return true;
            
    } else if (one !== "a" || five !== "r" || nine !== "a" || thirdteen !== "o" || two !== "c" || six !== "o"
        || ten !== "d" || fourteen !== "l" || three !== "o" || seven !== "h" || eleven !== "o"
        || fifteen !== "g" || four !== "f" || eight !== "t"
        || twelve !== "e" || sixteen !== "e") {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return false;
    }

    
});




// document.getElementById('game-two').addEventListener('submit', function (event) {
//     // Se evita recargar la página web después de enviar el formulario.
//     event.preventDefault();
//     //declaración de variables
//     var one, five, nine, thirdteen, two, six,
//         ten, fourteen, three, seven, eleven, fifteen,
//         four, eight, twelve, sixteen;
//     //definición de variables
//    // one = document.getElementById('recipient-name').value;//a
//     // declaración de condicionales
//     // if (one = "  ") {
//     //     sweetAlert(2, 'Todos los campos son obligatorios', null);
//     //     return false;
//     // }
// });