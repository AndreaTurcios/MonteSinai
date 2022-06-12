var html =  '<!DOCTYPE html>'+
'<html lang="es">'+
'    '+
'    <head>'+
'        <meta charset="UTF-8" />'+
'        <meta name="viewport" content="width=device-width, initial-scale=1.0" />'+
'        <meta'+
'            name="description"'+
'            content="ejercicio para libro de ingles javascript"'+
'        />'+
'        <title>crucigramas</title>'+
'        <link'+
'            rel="stylesheet"'+
'            type="text/css"'+
'            href="assets/polyfill/dialog-polyfill.css"'+
'        />'+
'        <link rel="stylesheet" href="style.css" />'+
'    </head>'+
'    <body class="body">'+
'        <header class="header wrapper">'+
'            <h1 class="title">Crossword about numbers <br /> from eleven to twenty</h1>'+
'            <p class="text" text-align: center>'+
'                Write the correct number:'+
'            </p>'+
'        </header>'+
'        <main class="main">'+
'            <dialog class="dialog">'+
'                <h1 class="dialog-title">¡lo lograste, muy bien!<br /></h1>'+
'            </dialog>'+
'            <form class="form" autocomplete="off" method="post" novalidate>'+
'                <div class="timer">'+
'                    <span class="minutes">00</span>:<span class="seconds"'+
'                        >00</span'+
'                    >'+
'                </div>'+
'                <table class="table">'+
'                    <tr class="row row-1">'+
'                        <td class="cell cell-black" id="1"></td>'+
'                        <td class="cell cell-black" id="2"></td>'+
'                        <td class="cell cell-black" id="3"></td>'+
'                        <td class="cell cell-black" id="4"></td>'+
'                        <td class="cell cell-black" id="5"></td>'+
'                        <td class="cell cell-black" id="6"></td>'+
'                        <td class="cell cell-black" id="7"></td>'+
'                        <td class="cell cell-black" id="8"></td>'+
'                        <td class="cell cell-black" id="9"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="10">1</label>'+
'                            <input'+
'                                required'+
'                                id="10"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ff]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="11"></td>'+
'                        <td class="cell cell-black" id="12"></td>'+
'                        <td class="cell cell-black" id="13"></td>'+
'                        <td class="cell cell-black" id="14"></td>'+
'                        <td class="cell cell-black" id="15"></td>'+
'                        <td class="cell cell-black" id="16"></td>'+
'                        <td class="cell cell-black" id="17"></td>'+
'                    </tr>'+
'                    <tr class="row row-2">'+
'                        <td class="cell cell-black" id="18"></td>'+
'                        <td class="cell cell-black" id="19"></td>'+
'                        <td class="cell cell-black" id="20"></td>'+
'                        <td class="cell cell-black" id="21"></td>'+
'                        <td class="cell cell-black" id="22"></td>'+
'                        <td class="cell cell-black" id="23"></td>'+
'                        <td class="cell cell-black" id="24"></td>'+
'                        <td class="cell cell-black" id="25"></td>'+
'                        <td class="cell cell-black" id="26"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="27"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Oo]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="28"></td>'+
'                        <td class="cell cell-black" id="29"></td>'+
'                        <td class="cell cell-black" id="30"></td>'+
'                        <td class="cell cell-black" id="31"></td>'+
'                        <td class="cell cell-black" id="32"></td>'+
'                        <td class="cell cell-black" id="33"></td>'+
'                        <td class="cell cell-black" id="34"></td>                       '+
'                    </tr>'+
'                    <tr class="row row-3">'+
'                        <td class="cell cell-black" id="37"></td>'+
'                        <td class="cell cell-black" id="38"></td>'+
'                        <td class="cell cell-black" id="39"></td>'+
'                        <td class="cell cell-black" id="40"></td>'+
'                        <td class="cell cell-black" id="41"></td>'+
'                        <td class="cell cell-black" id="42"></td>'+
'                        <td class="cell cell-black" id="43"></td>'+
'                        <td class="cell cell-black" id="44"></td>'+
'                        <td class="cell cell-black" id="45"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="46"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Uu]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="47"></td>'+
'                        <td class="cell cell-black" id="48"></td>'+
'                        <td class="cell cell-black" id="49"></td>'+
'                        <td class="cell cell-black" id="50"></td>'+
'                        <td class="cell cell-black" id="51"></td>'+
'                        <td class="cell cell-black" id="52"></td>'+
'                        <td class="cell cell-black" id="53"></td>'+
'                    </tr>'+
'                    <tr class="row row-4">'+
'                        <td class="cell cell-black" id="54"></td>'+
'                        <td class="cell cell-black" id="55"></td>'+
'                        <td class="cell cell-black" id="56"></td>'+
'                        <td class="cell cell-black" id="57"></td>'+
'                        <td class="cell cell-black" id="58"></td>'+
'                        <td class="cell cell-black" id="59"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="60">2</label>'+
'                            <input'+
'                                required'+
'                                id="60"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="61"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Hh]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="62"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ii]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="63"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Rr]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="64"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="65"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="66"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="67"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="2"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="68"></td>'+
'                        <td class="cell cell-black" id="69"></td>'+
'                        <td class="cell cell-black" id="70"></td>'+
'                    </tr>'+
'                    <tr class="row row-5">'+
'                        <td class="cell cell-black" id="71"></td>'+
'                        <td class="cell cell-black" id="72"></td>'+
'                        <td class="cell cell-black" id="73"></td>'+
'                        <td class="cell cell-black" id="74"></td>'+
'                        <td class="cell cell-black" id="75"></td>'+
'                        <td class="cell cell-black" id="76"></td>'+
'                        <td class="cell cell-black" id="77"></td>'+
'                        <td class="cell cell-black" id="78"></td>'+
'                        <td class="cell cell-black" id="79"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="80"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="81"></td>'+
'                        <td class="cell cell-black" id="82"></td>'+
'                        <td class="cell cell-black" id="83"></td>'+
'                        <td class="cell cell-black" id="84"></td>'+
'                        <td class="cell cell-black" id="85"></td>'+
'                        <td class="cell cell-black" id="86"></td>'+
'                        <td class="cell cell-black" id="87"></td>'+
'                    </tr>'+
'                    <tr class="row row-6">'+
'                        <td class="cell cell-black" id="88"></td>'+
'                        <td class="cell cell-black" id="89"></td>'+
'                        <td class="cell cell-black" id="90"></td>'+
'                        <td class="cell cell-black" id="91"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="92">3</label>'+
'                            <input'+
'                                required'+
'                                id="92"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="93"></td>'+
'                        <td class="cell cell-black" id="94"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="95">4</label>'+
'                            <input'+
'                                required'+
'                                id="95"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ff]"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="96"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="97"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="98"></td>'+
'                        <td class="cell cell-black" id="99"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="100">5</label>'+
'                            <input'+
'                                required'+
'                                id="100"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ss]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="101"></td>'+
'                        <td class="cell cell-black" id="102"></td>'+
'                        <td class="cell cell-black" id="103"></td>'+
'                        <td class="cell cell-black" id="104"></td>'+
'                    </tr>'+
'                    <tr class="row row-7">'+
'                        <td class="cell cell-black" id="105"></td>'+
'                        <td class="cell cell-black" id="106"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="107">6</label>'+
'                            <input'+
'                                required'+
'                                id="107"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-down="6"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="108"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="109"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ii]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="110"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="111">7</label>'+
'                            <input'+
'                                required'+
'                                id="111"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="112"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ii]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="113"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="114"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="115"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="116"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="117"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="118"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="7"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="119"></td>'+
'                        <td class="cell cell-black" id="120"></td>'+
'                        <td class="cell cell-black" id="121"></td>'+
'                    </tr>'+
'                    <tr class="row row-8">'+
'                        <td class="cell cell-black" id="122"></td>'+
'                        <td class="cell cell-black" id="123"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="124"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ww]"'+
'                                data-down="6"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="125"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="126"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Gg]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="127"></td>'+
'                        <td class="cell cell-black" id="128"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="129"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ff]"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="130"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="131"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="1"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="132"></td>'+
'                        <td class="cell cell-black" id="133"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="134"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Vv]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="135"></td>'+
'                        <td class="cell cell-black" id="136"></td>'+
'                        <td class="cell cell-black" id="137"></td>'+
'                        <td class="cell cell-black" id="138"></td>'+
'                        '+
'                    </tr>'+
'                    <tr class="row row-9">'+
'                        <td class="cell cell-black" id="139"></td>'+
'                        <td class="cell cell-black" id="140"></td>'+
'                        '+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="141"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="6"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="142"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="143"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Hh]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="144"></td>'+
'                        <td class="cell cell-black" id="145"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="146"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
''+
'                        <td class="cell cell-black" id="147"></td>'+
'                        <td class="cell cell-black" id="148"></td>'+
'                        <td class="cell cell-black" id="149"></td>'+
'                        <td class="cell cell-black" id="150"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="151"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="152"></td>'+
'                        <td class="cell cell-black" id="153"></td>'+
'                        <td class="cell cell-black" id="154"></td>'+
'                        <td class="cell cell-black" id="155"></td>'+
'                    </tr>'+
'                    <tr class="row row-10">'+
'                        <td class="cell cell-black" id="156"></td>'+
'                        <td class="cell cell-black" id="157"></td>'+
'                        '+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="158"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="6"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="159"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="160"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="161"></td>'+
'                        <td class="cell cell-black" id="162"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="163"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
''+
'                        <td class="cell cell-black" id="164"></td>'+
'                        <td class="cell cell-black" id="165"></td>'+
'                        <td class="cell cell-black" id="166"></td>'+
'                        <td class="cell cell-black" id="167"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="168"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="169"></td>'+
'                        <td class="cell cell-black" id="170"></td>'+
'                        <td class="cell cell-black" id="171"></td>'+
'                        <td class="cell cell-black" id="172"></td>'+
'                    </tr>'+
'                    <tr class="row row-11">'+
'                        <td class="cell cell-black" id="173"></td>'+
'                        <td class="cell cell-black" id="174"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="175">8</label>'+
'                            <input'+
'                                required'+
'                                id="175"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                data-across="8"'+
'                                data-down="6"'+
'                                pattern="[Tt]"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="176"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ww]"'+
'                                data-across="8"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="177"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="8"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="178"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ll]"'+
'                                data-across="8"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="179"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Vv]"'+
'                                data-across="8"'+
'                            />'+
'                        </td>'+
''+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="180"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="8"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="181"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="182">9</label>'+
'                            <input'+
'                                required'+
'                                id="182"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ss]"'+
'                                data-across="9"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="183"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ii]"'+
'                                data-across="9"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="184"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ii]"'+
'                                data-across="9"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="185"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Tt]"'+
'                                data-across="9"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="186"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="9"'+
'                            />'+
'                        </td><td class="cell">'+
'                            <input'+
'                                required'+
'                                id="187"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="9"'+
'                            />'+
'                        </td><td class="cell">'+
'                            <input'+
'                                required'+
'                                id="188"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="9"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="189"></td>'+
'                    </tr>'+
'                    <tr class="row row-12">'+
'                        <td class="cell cell-black" id="191"></td>'+
'                        <td class="cell cell-black" id="192"></td>'+
'                        '+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="193"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Yy]"'+
'                                data-down="6"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="194"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="195"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="196"></td>'+
'                        <td class="cell cell-black" id="197"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="198"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="4"'+
'                            />'+
'                        </td>'+
''+
'                        <td class="cell cell-black" id="199"></td>'+
'                        <td class="cell cell-black" id="200"></td>'+
'                        <td class="cell cell-black" id="201"></td>'+
'                        <td class="cell cell-black" id="202"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="203"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="204"></td>'+
'                        <td class="cell cell-black" id="205"></td>'+
'                        <td class="cell cell-black" id="206"></td>'+
'                        <td class="cell cell-black" id="207"></td>'+
'                    </tr>'+
'                    <tr class="row row-13">'+
'                        <td class="cell cell-black" id="208"></td>'+
'                        <td class="cell cell-black" id="209"></td>'+
'                        <td class="cell cell-black" id="210"></td>'+
'                        <td class="cell cell-black" id="211"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="212"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="3"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="213"></td>'+
'                        <td class="cell cell-black" id="214"></td>'+
'                        <td class="cell cell-black" id="215"></td>'+
'                        <td class="cell">'+
'                            <label class="word-number" for="216">10</label>'+
'                            <input'+
'                                required'+
'                                id="217"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="10"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="218"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ll]"'+
'                                data-across="10"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="219"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="10"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="220"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Vv]"'+
'                                data-across="10"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="221"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Ee]"'+
'                                data-across="10"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="222"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-across="10"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="223"></td>'+
'                        <td class="cell cell-black" id="224"></td>'+
'                        <td class="cell cell-black" id="190"></td>'+
'                    </tr>'+
'                    <tr class="row row-14">'+
'                        <td class="cell cell-black" id="225"></td>'+
'                        <td class="cell cell-black" id="226"></td>'+
'                        <td class="cell cell-black" id="227"></td>'+
'                        <td class="cell cell-black" id="228"></td>'+
'                        <td class="cell cell-black" id="229"></td>'+
'                        <td class="cell cell-black" id="230"></td>'+
'                        <td class="cell cell-black" id="231"></td>'+
'                        <td class="cell cell-black" id="232"></td>'+
'                        <td class="cell cell-black" id="233"></td>'+
'                        <td class="cell cell-black" id="234"></td>'+
'                        <td class="cell cell-black" id="235"></td>'+
'                        <td class="cell cell-black" id="236"></td>'+
'                        <td class="cell">'+
'                            <input'+
'                                required'+
'                                id="237"'+
'                                class="letter"'+
'                                type="text"'+
'                                maxlength="1"'+
'                                pattern="[Nn]"'+
'                                data-down="5"'+
'                            />'+
'                        </td>'+
'                        <td class="cell cell-black" id="238"></td>'+
'                        <td class="cell cell-black" id="239"></td>'+
'                        <td class="cell cell-black" id="240"></td>'+
'                        <td class="cell cell-black" id="241"></td>'+
'                    </tr>'+
'                </table>'+
'                <div class="clue-box-container">'+
'                    <p class="clue-box"></p>'+
'                </div>'+
'                <div class="btn-group wrapper">'+
'                    <button class="btn btn-check" type="button">'+
'                        Mostrar errores'+
'                    </button>'+
'                    <button class="btn btn-clear" type="reset">'+
'                        Borrar todo'+
'                    </button>'+
'                </div>'+
'            </form>'+
'        </main>'+
'        <script src="assets/polyfill/dialog-polyfill.js"></script>'+
'        <script type="text/javascript" src="./main.js"></script>'+
'    </body>'+
'</html>';