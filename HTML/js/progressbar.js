let i = 0;
let id;
let width = 1;


function move() {

        let elem = document.getElementById("progress");

        id = setInterval(frame, 36000);
        function frame() {

            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
            }
        }

}

move();

function stop() {
    clearInterval(id);
}





