<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAME2  - BODY PARTS</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>

        * {
            transition: all 0.3s;
        }
        body{
            background: slategray;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        .contenedor{
            width: 98vw;
            height: 97vh;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            
        }

        .encabezado{
            position: relative;
            background: white;
            min-width: 300px;
            width: 70%;
            max-width: 600px;
            padding: 10px;

        }

        .categoria{
            opacity: 0.3;
            text-align: left;
        }

        .pregunta{
            padding: 10px;
        }

        .imagen{
            object-fit: scale-down;
            height:0px;
            width: 0px;
        }
        .btn {
            background: white;
            width: 60%;
            max-width: 550px;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
    }
    
        .btn:hover {
            transform: scale(1.05);
    }

        .numero{
            position: absolute;
            opacity:0.3;
            top: 10px;
            right: 10px;
        }
        
        .puntaje{
            padding:10px;
            color:white;
        }

    </style>

<div class="contenedor">
    <div class="puntaje" id="puntaje"></div>
    <div class="encabezado">
      <div class="categoria" id="categoria">
    </div>
    <div class="numero" id="numero"></div>
      <div class="pregunta" id="pregunta">
     </div>
      <img src="#" class="imagen" id="imagen">
    </div>
    <div class="btn" id="btn1" onclick="oprimir_btn(0)"></div>
    <div class="btn" id="btn2" onclick="oprimir_btn(1)"></div>
    <div class="btn" id="btn3" onclick="oprimir_btn(2)"></div>
    <div class="btn" id="btn4" onclick="oprimir_btn(3)"></div>
    <script src="index.js"></script>
  </div>
</body>
</html>