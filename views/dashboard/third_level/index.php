<?php

session_start();


if(isset($_POST['submit'])){
	header("Location:thirdgrade.php");
}

?>



<!DOCTYPE html>
<!-- saved from url=(0060)https://getbootstrap.com/docs/4.0/examples/starter-template/ -->
<html lang="en"><script>
(() => {
/**
 * This script injected by the installed three.js developer
 * tools extension.
 * https://github.com/threejs/three-devtools
 */

const $devtoolsReady = Symbol('devtoolsReady');
const $backlog = Symbol('backlog');

// The __THREE_DEVTOOLS__ target is small and light-weight, and collects
// events triggered until the devtools panel is ready, which is when
// the events are flushed.
const target = new class ThreeDevToolsTarget extends EventTarget {
  constructor() {
    super();
    this[$devtoolsReady] = false;
    this[$backlog] = [];
    this.addEventListener('devtools-ready', e => {
      this[$devtoolsReady] = true;
      for (let event of this[$backlog]) {
        this.dispatchEvent(event);
      }
    }, { once: true });
  }

  dispatchEvent(event) {
    if (this[$devtoolsReady] || event.type === 'devtools-ready') {
      super.dispatchEvent(event);
    } else {
      this[$backlog].push(event);
    }
  }
}

Object.defineProperty(window, '__THREE_DEVTOOLS__', {
  value: target,
});
})();
</script><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Third Level</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
  </head>

  <body>
  	<form method="POST" action="menu.php">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><img src="img/logosinai.png" width="250px" height=""> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/starter-template/#"><span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="https://getbootstrap.com/docs/4.0/examples/starter-template/#"></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link disabled" href="https://getbootstrap.com/docs/4.0/examples/starter-template/#"></a>
          </li>
         
        </ul>
       
      </div>
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Welcome to Monte Sinaí Collection.</h1>
        <p class="lead"><b>TIME TO  LEARN ENGLISH - THIRD LEVEL</b><br><b>Text adapted to the new Education Ministry Program with approach of competences.</b></p>
      </div>
      <p align="center"><img src="img/img_portada.png" width="250px" height="">
      <br><br><button type="submit" class="btn btn-primary">Let's Fun !!</button>
</form>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Starter Template for Bootstrap_files/jquery-3.2.1.slim.min.js.descarga" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./Starter Template for Bootstrap_files/popper.min.js.descarga"></script>
    <script src="./Starter Template for Bootstrap_files/bootstrap.min.js.descarga"></script>
  

</body></html>