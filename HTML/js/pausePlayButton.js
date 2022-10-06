let but = document.getElementById("playpauseButton");

let pause = false;
but.onclick = function () {
    if (pause == false) {
        stopTimer();
        but.innerText = "Play";
        pause = true;

    } else {
        startTimer();
        but.innerText = "Pause";
        pause = false;

    }
}