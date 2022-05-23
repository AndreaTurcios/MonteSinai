var secs;
var mins;
var cronometer;

 
function ResetTime(){
    clearInterval(cronometer);
}

function StarTime(){
    secs =0;
    mins =0;
    s = document.getElementById("seconds");
    m = document.getElementById("minutes");

    cronometer = setInterval(
        function(){
            if(secs==60){
                secs=0;
                mins++;
                if (mins<10) m.innerHTML ="0"+mins;
                else m.innerHTML = mins;

                if(mins==60) mins=0;
            }
            if (secs<10) s.innerHTML ="0"+secs;
            else s.innerHTML = secs;

            secs++;
        }
        ,1000);
}

function autoplay(){

	ResetTime();
	StarTime();

}

autoplay();







