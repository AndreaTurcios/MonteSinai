<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Memory Game 3</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
<h1>Where is it? </h1>

    <style>
        :root {
            --w: calc(70vw / 6);
            --h: calc(70vh / 4);
        }

        * {
            transition: all 0.5s;
        }

        body {
            padding: 0;
            margin: 0;
            -webkit-perspective: 1000;
            background: powdergreen;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-family: calibri;
        }

        div {
            display: inline-block;
        }

        .area-tarjeta,
        .tarjeta,
        .cara {
            cursor: pointer;
            width: var(--w);
            min-width: 100px;
            height: var(--h);
        }

        .tarjeta {
            position: relative;
            transform-style: preserve-3d;
            animation: iniciar 5s;
        }

        .cara {
            position: absolute;
            backface-visibility: hidden;
            box-shadow: inset 0 0 0 5px white;
            font-size: 500%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .trasera {
            background-color: lightcyan;
            transform: rotateY(180deg);
        }

        .superior {
            background: linear-gradient(orange, darkorange);
        }

        .nuevo-juego {
            cursor: pointer;
            background: linear-gradient(orange, darkorange);
            padding: 20px;
            border-radius: 50px;
            border: white 5px solid;
            font-size: 130%;
            display: inline-block;
        }

        #puntos {
            display: inline-block;
            font-size: 300%;
            margin-left: 30px;
        }

        @keyframes iniciar {

            20%,
            90% {
                transform: rotateY(180deg);
            }

            0%,
            100% {
                transform: rotateY(0deg);
            }
        }
    </style>

    <div id="tablero">
    </div>

    <br>

    <div>
        <div class="nuevo-juego" onclick="generarTablero()">
            Nuevo Juego
        </div>

        <div id="puntos">
            Puntos: 0
        </div>
    </div>

    <!-- JS -->
    <!-- parte lógica -->
    <script>

        let puntos;
        let iconos = []
        let selecciones = []

        generarTablero()

        function cargarIconos() {
            iconos = [
                '<i class=""><img src="img/bodyparts/nose.png" width="80px" height="80px"></i>',
                '<i class=""><img src="img/bodyparts/ear.png" width="80px" height="80px"></i>',
                '<i class=""><img src="img/bodyparts/eye.png" width="80px" height="80px"></i>',
                '<i class=""><img src="img/bodyparts/foot.png" width="80px" height="80px"></i>',
                '<i class=""><img src="img/bodyparts/hand.png" width="80px" height="80px"></i>',
                '<i class="fab fa-galactic-republic"></i>',
                '<i class="fas fa-sun"></i>',
                '<i class="fas fa-stroopwafel"></i>',
                '<i class="fas fa-dice"></i>',
                '<i class="fas fa-chess-knight"></i>',
                '<i class="fas fa-chess"></i>',
                '<i class="fas fa-dice-d20"></i>',
            ]
        }

        function generarTablero() {
            puntos = 0
            document.getElementById("puntos").innerHTML = "Puntos: " + puntos
            cargarIconos()
            selecciones = []
            let tablero = document.getElementById("tablero")
            let tarjetas = []
            for (let i = 0; i < 24; i++) {
                tarjetas.push(`
                <div class="area-tarjeta" onclick="seleccionarTarjeta(${i})">
                    <div class="tarjeta" id="tarjeta${i}">
                        <div class="cara trasera" id="trasera${i}">
                            ${iconos[0]}
                        </div>
                        <div class="cara superior">
                            <i class="far fa-question-circle"></i>
                        </div>
                    </div>
                </div>        
                `)
                if (i % 2 == 1) {
                    iconos.splice(0, 1)
                }
            }
            tarjetas.sort(() => Math.random() - 0.5)
            tablero.innerHTML = tarjetas.join(" ")
        }

        function seleccionarTarjeta(i) {
            let tarjeta = document.getElementById("tarjeta" + i)
            if (tarjeta.style.transform != "rotateY(180deg)") {
                tarjeta.style.transform = "rotateY(180deg)"
                selecciones.push(i)
            }
            if (selecciones.length == 2) {
                deseleccionar(selecciones)
                selecciones = []
            }
        }

        function deseleccionar(selecciones) {
            setTimeout(() => {
                let trasera1 = document.getElementById("trasera" + selecciones[0])
                let trasera2 = document.getElementById("trasera" + selecciones[1])
                if (trasera1.innerHTML != trasera2.innerHTML) {
                    let tarjeta1 = document.getElementById("tarjeta" + selecciones[0])
                    let tarjeta2 = document.getElementById("tarjeta" + selecciones[1])
                    tarjeta1.style.transform = "rotateY(0deg)"
                    tarjeta2.style.transform = "rotateY(0deg)"
                } else {
                    trasera1.style.background = "plum"
                    trasera2.style.background = "plum"
                    puntos++;
                    document.getElementById("puntos").innerHTML = "Puntos: " + puntos
                }
            }, 1000);
        }

    </script>

</body>

</html>