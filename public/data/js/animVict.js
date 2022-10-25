let win = document.getElementById('winner');
let max = 10;
let min = -10;
let i = 0;



function animVictPlus() {
    if (i < max) {
        i++;
        win.style.transform = 'rotate(' + i + 'deg)';



        requestAnimationFrame(animVictPlus);
    } else {
        requestAnimationFrame(animVictMinus);
    }

}

function animVictMinus() {
    if (i > min) {
        i--;
        win.style.transform = 'rotate(' + i + 'deg)';



        requestAnimationFrame(animVictMinus);

    } else {
        requestAnimationFrame(animVictPlus);

    }

}

let color;

function animColor() {
    win.style.color = '#' + Math.floor(Math.random() * 16777215).toString(16);
    win.style.transition = 'color 0.3s';

    setTimeout(animColor, 300);
}



animColor()

animVictPlus();



