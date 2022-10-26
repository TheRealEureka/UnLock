let lose = document.getElementById('loser');
let i = 0;
let hei = 100;






function animLose(){
    if (i<20){
        i++
        hei = hei - 5;
        lose.animate([
            {transform: 'translateY(0px)'},
            {transform: 'translateY('+hei+'px)'},
            {transform: 'rotate('+hei+'deg)'},
            {transform: 'translateY(0px)'},
            {transform: 'rotate(0deg)'},
            {transform: 'translateY(0px)'},
            {transform: 'translateY('+hei+'px)'},
            {transform: 'rotate('+-hei+'deg)'},
            {transform: 'translateY(0px)'}
        ],{
            duration: 1000,
            iterations: Infinity,
            direction: 'alternate'
        })
    }else {
        console.log('kiki');
        return 0;
    }

}


animLose();


/**
 * Code taken there
 * https://codepen.io/yaclive/pen/EayLYO
 *
 */

// Initialising the canvas
let canvas = document.querySelector('canvas'),
    ctx = canvas.getContext('2d');

// Setting the width and height of the canvas
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Setting up the letters
let letters = 'LOSER';
//letters = letters.split('');

// Setting up the columns
let fontSize = 30,
    columns = canvas.width / fontSize;

// Setting up the drops
let drops = [];
for (let i = 0; i < columns; i++) {
    drops[i] = 1;
}

// Setting up the draw function
function draw() {
    ctx.fillStyle = 'rgba(0, 0, 0, .1)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    for (let i = 0; i < drops.length; i++) {
        let text = letters;
        ctx.fillStyle = '#fff';
        ctx.fillText(text, i * fontSize, drops[i] * fontSize);
        drops[i]++;
        if (drops[i] * fontSize > canvas.height && Math.random() > .95) {
            drops[i] = 0;
        }
    }
}

// Loop the animation
setInterval(draw, 100);

