<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 1');
?>

<div class="containerlogin">
  <div class="left">
    <div class="login">Login</div>
    <div class="eula">Bienvenido al sistema de MonteSinai.</div>
  </div>
  <div class="right">
    <svg viewBox="0 0 320 300">
      <defs>
        <linearGradient
                        inkscape:collect="always"
                        id="linearGradient"
                        x1="13"
                        y1="193.49992"
                        x2="307"
                        y2="193.49992"
                        gradientUnits="userSpaceOnUse">
          <stop
                style="stop-color:#87CEEB;"
                offset="0"
                id="stop876" />
          <stop
                style="stop-color:#252850 ;"
                offset="1"
                id="stop878" />
        </linearGradient>
      </defs>
      <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
    </svg>
<!--derecha  abajo  plano  general-->
    <svg viewBox="40 -80 200 300">
      <defs>
        <linearGradient
                        inkscape:collect="always"
                        id="linearGradient"
                        x1="13"
                        y1="193.49992"
                        x2="307"
                        y2="193.49992"
                        gradientUnits="userSpaceOnUse">
          <stop
                style="stop-color:#87CEEB;"
                offset="0"
                id="stop876" />
          <stop
                style="stop-color:#252850 ;"
                offset="1"
                id="stop878" />
        </linearGradient>
      </defs>
      <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
    </svg>

    <svg viewBox="0 -70 320 300">
      <defs>
        <linearGradient
                        inkscape:collect="always"
                        id="linearGradient"
                        x1="13"
                        y1="193.49992"
                        x2="307"
                        y2="193.49992"
                        gradientUnits="userSpaceOnUse">
          <stop
                style="stop-color:#87CEEB;"
                offset="0"
                id="stop876" />
          <stop
                style="stop-color:#252850 ;"
                offset="1"
                id="stop878" />
        </linearGradient>
      </defs>
      <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
    </svg>

    <div class="form" id="CajaDatos">
    <form method="post" id="session-form">
      <label for="email">Correo</label>
      <input class="form-control me-2" type="text" placeholder="Ingrese su nombre de usuario" aria-label="Usuario" name="username" class="validate" autocomplete="off" required>
      <label for="password">Contraseña</label>
      <input class="form-control me-2" type="password" placeholder="Ingrese su contraseña" aria-label="Usuario" name="clave" class="validate" autocomplete="off" required>
      <input type="submit" id="submit" value="Iniciar sesión" data-tooltip="Ingresar" id='login'>
    </form>
    </div>
  </div>
</div>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('login.js');
?>