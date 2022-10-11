let but = document.getElementById("playpauseButton");

let pause = false;
but.onclick = function () {
    if (pause === false) {
        stopTimer();
        stop();
        but.innerText = "Play";
        pause = true;

    } else {
        startTimer();
        move();
        but.innerText = "Pause";
        pause = false;

    }
}