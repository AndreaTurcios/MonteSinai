<?php
/*
*	Clase para definir las plantillas de las páginas web del <SGC-MEGAFRIO class=""></SGC-MEGAFRIO>
*/
class Dashboard_Page
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        //session_start();
        // Se imprime el código HTML de la cabecera del documento.
        print('
<!DOCTYPE html>
<html lang="es">
<head runat="server">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><%: Page.Title %> - NexusEnterprise </title>
    <asp:PlaceHolder runat="server">
        <%: Scripts.Render("~/bundles/modernizr") %>
    </asp:PlaceHolder>
    <webopt:bundlereference runat="server" path="~/Content/css" />
    <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<div class="css-xfq28i"></div>
<body>
 <nav>
                <div class="menu">
                    <ul>
                         <li><a href="/Default"><img src="../Resources/ActivityHoursLogo.png" width="60" height="60" class="top-center"></a></li>
                    </ul>
                    <ul>
                        <li><a href="/Proyectos">Proyectos</a></li>
                        <li><a href="/Clientes">Clientes</a></li>
                        <li><a href="/Actividades">Actividades</a></li>
                        <li><a href="/Colaboradores">Colaboradores</a></li>
                        <li><a href="/ControlColaboradores">Control</a></li>
                        <li><a href="/Login">Login</a></li>
                    </ul>
                </div>
            </nav>
    <br />

    <form runat="server">
        <asp:ScriptManager runat="server">
            <Scripts>
                <asp:ScriptReference Name="MsAjaxBundle" />
                <asp:ScriptReference Name="jquery" />
                <asp:ScriptReference Name="bootstrap" />
                <asp:ScriptReference Name="WebForms.js" Assembly="System.Web" Path="~/Scripts/WebForms/WebForms.js" />
                <asp:ScriptReference Name="WebUIValidation.js" Assembly="System.Web" Path="~/Scripts/WebForms/WebUIValidation.js" />
                <asp:ScriptReference Name="MenuStandards.js" Assembly="System.Web" Path="~/Scripts/WebForms/MenuStandards.js" />
                <asp:ScriptReference Name="GridView.js" Assembly="System.Web" Path="~/Scripts/WebForms/GridView.js" />
                <asp:ScriptReference Name="DetailsView.js" Assembly="System.Web" Path="~/Scripts/WebForms/DetailsView.js" />
                <asp:ScriptReference Name="TreeView.js" Assembly="System.Web" Path="~/Scripts/WebForms/TreeView.js" />
                <asp:ScriptReference Name="WebParts.js" Assembly="System.Web" Path="~/Scripts/WebForms/WebParts.js" />
                <asp:ScriptReference Name="Focus.js" Assembly="System.Web" Path="~/Scripts/WebForms/Focus.js" />
                <asp:ScriptReference Name="WebFormsBundle" />
            </Scripts>
        </asp:ScriptManager>
        <br>
    

        <div class="container body-content">
            <asp:ContentPlaceHolder ID="MainContent" runat="server">
            </asp:ContentPlaceHolder>
            <hr />
            <div class="css-xfq28i"></div>
            <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Sobre nosotros</h6>
            <p class="text-justify">NexusERP <i>TIENE COMO OBJETIVO </i> brindar apoyo a empresas tanto grandes como peque;as.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Lenguajes con los que trabajamos: </h6>
            <ul class="footer-links">
              <li><a href="">C</a></li>
              <li><a href="">PHP</a></li>
              <li><a href="">Java</a></li>
              <li><a href="">Android</a></li>
              <li><a href="">Templates</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>CONTACTO</h6>
            <ul class="footer-links">
              <li><a href="">Sobre nosotros</a></li>
              <li><a href="">Contactanos</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; <%: DateTime.Now.Year %> All Rights Reserved by 
         <a href="#">NexusERP</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>
        </div>

    </form>
</body>
</html>');
}    
}