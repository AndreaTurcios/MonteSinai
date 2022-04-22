<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 1');
?>

<div>
	<input type="text" id="texto">
	<input type="button" id="hablar" value="Decir">
</div>
<script src="../../resources/js/script.js"></script>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('cont.js');
?>