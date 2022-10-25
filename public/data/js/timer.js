console.log("timer.js loaded");

let timer = "60:00";

let timerElement = document.getElementById("timer");

let interval;

function startTimer(time = '60:00') {
    if(time !== "")
    {
         time  = time.split(":");
        let minutes_temp =60 -  time[0];
        let seconds_temp = 0 - time[1];
        //calcule the diffrence between the current time and the time that the user entered
        if(seconds_temp < 0)
        {
            seconds_temp = 60 + seconds_temp;
            minutes_temp--;
        }
        time = minutes_temp + ":" + seconds_temp;
        timer = time;
    }

    timerElement.innerText = timer;
    let timerArray = timer.split(":");
    let minutes = timerArray[0];
    let seconds = timerArray[1];

    interval = setInterval(function () {
        seconds--;
        if (seconds < 0) {
            minutes--;
            seconds = 59;
            if (minutes < 10 ) {
                minutes = "0" + minutes;
            }
        }

        if (seconds < 10) {

            seconds = "0" + seconds;
        }

        if (minutes === "00" && seconds === "00") {
            seconds = "00";
            timer = minutes + ":" + seconds;
            timerElement.innerText = timer;
            clearInterval(interval);
            return;
        }



        if (minutes <= 4) {
            timerElement.style.color = "red";
            timerElement.style.textShadow = "2px 0 0 black";
            document.getElementById("progress").style.backgroundColor = "red";
        }

        timer = minutes + ":" + seconds;
        timerElement.innerText = timer;
    }, 1000);


}


function stopTimer() {
    clearInterval(interval);
}



