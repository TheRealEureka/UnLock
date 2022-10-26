console.log("timer.js loaded");



let timerElement = document.getElementById("timer");
let elem = document.getElementById("progress");

let interval;

function startTimer(timer) {
    if(timer.minute >= 0 && timer.second >= 0 && timer.minute <= 60 && timer.second <= 60)
    {
        interval = setInterval(function () {
            let disp_mins = "";
            let disp_secs = "";
            if(timer.minute !== 0 && timer.second >= 0) {
                timer.second--;
                if (timer.second < 0) {
                    timer.minute--;
                    timer.second = 59;
                    if (timer.minute < 10) {
                        disp_mins = "0" + timer.minute;
                    }
                }
                disp_mins = timer.minute;
                disp_secs = timer.second;
                if (timer.second < 10) {

                    disp_secs = "0" + timer.second;
                }
                timerElement.innerText = disp_mins + ":" + disp_secs;
                elem.style.width = ((60-timer.minute) * 1.66) + "%";
                if (timer.minute <= 0 && timer.second <= 0) {
                    end();
                    return;
                }


                if (timer.minute <= 4) {
                    timerElement.style.color = "red";
                    timerElement.style.textShadow = "2px 0 0 black";
                    document.getElementById("progress").style.backgroundColor = "red";
                }
            }
        }, 1000);
    }
    else{
        end()
    }

}

function end(){
    timerElement.innerText = "00:00";
    if(interval)
    {
        clearInterval(interval);
    }
    console.log("end")
    window.location = "/loose";
}
