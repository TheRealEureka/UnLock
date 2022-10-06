console.log("timer.js loaded");

let timer = "00:05";

let timerElement = document.getElementById("timer");

timerElement.innerText = timer;
let interval;

function startTimer() {
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



        if (minutes <= 5) {
            timerElement.style.color = "red";
        }

        timer = minutes + ":" + seconds;
        timerElement.innerText = timer;
    }, 1000);
}

startTimer();

function stopTimer() {
    clearInterval(interval);
}



