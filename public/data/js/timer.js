console.log("timer.js loaded");

let timer = "60:00";

let timerElement = document.getElementById("timer");
let elem = document.getElementById("progress");

let interval;

function startTimer(time = '60:00') {
    if(time !== "" && time !== '60:00')
    {
         time  = time.split(":");
         if(time[0]<=60 && time[1] >=0 && time[0]>0 && time[1] <= 60)
         {


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
         else{
             timer = "00:00";
         }
    }

    timerElement.innerText = timer;
    let timerArray = timer.split(":");
    let minutes = timerArray[0];
    let seconds = timerArray[1];

    interval = setInterval(function () {
       if(timer !== "00:00") {
           seconds--;
           if (seconds < 0) {
               minutes--;
               seconds = 59;
               if (minutes < 10) {
                   minutes = "0" + minutes;
               }
           }

           if (seconds < 10) {

               seconds = "0" + seconds;
           }

           if (minutes <= 0 && seconds <= 0) {
               seconds = "00";
               minutes = "00";
               timer = minutes + ":" + seconds;
               timerElement.innerText = timer;
               clearInterval(interval);
               window.location = "/timeout";

               return;
           }


           if (minutes <= 4) {
               timerElement.style.color = "red";
               timerElement.style.textShadow = "2px 0 0 black";
               document.getElementById("progress").style.backgroundColor = "red";
           }
       }
       else{
           seconds = "00";
           minutes = "00";
           timer = minutes + ":" + seconds;
           timerElement.innerText = timer;
           clearInterval(interval);
           window.location = "/timeout";

           return;
       }
        timer = minutes + ":" + seconds;
        elem.style.width = ((60-minutes) * 1.66) + "%";

        timerElement.innerText = timer;
    }, 1000);


}


