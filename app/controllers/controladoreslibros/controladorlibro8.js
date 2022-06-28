const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

//actividad 1
document.getElementById('game-1').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;

    if (document.getElementById('cbox1').checked || document.getElementById('cbox2').checked || document.getElementById('cbox3').checked ||
        document.getElementById('cbox4').checked || document.getElementById('cbox5').checked || document.getElementById('cbox6').checked) {

        if (document.getElementById('cbox1').checked && document.getElementById('cbox2').checked && document.getElementById('cbox3').checked
            && document.getElementById('cbox4').checked && document.getElementById('cbox5').checked && document.getElementById('cbox6').checked) {
            sweetAlert(2, 'It is not valid to select all answers', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('cbox1').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 2:
                        if (document.getElementById('cbox3').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 4:
                        if (document.getElementById('cbox4').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 5:
                        if (document.getElementById('cbox6').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    default:
                }
            }

            var libro = 8;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = notatotal;
            document.getElementById('idlibro1').value = libro;
            action = 'createact1';
            saveRowActivity(API_ACTIVIDADES, action, 'game-1', 'ModalLibroOcho11')
            sweetAlert(1, 'Good job', null);
            // var modalregion11 = document.getElementById('ModalLibroOcho11');
            // var modal11 = bootstrap.Modal.getInstance(modalregion11)
            // modal11.hide();
            var ModalLibroOcho11 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho11'));
            ModalLibroOcho11.hide();
            return true;
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
    
});