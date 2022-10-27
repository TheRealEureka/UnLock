
//Manage popup
document.getElementById("close_popup").addEventListener("click", toggle);
document.getElementById("card_popup").addEventListener("click", toggle);

function toggle(){
    document.getElementById("popup").classList.toggle("hidden");
}

//Manage Menu
document.getElementById("resetButton").addEventListener("click", function() {
    window.location = "/reset";
});
document.getElementById("saveButton").addEventListener("click", function() {
    if(this.classList.contains("disabled")) return;
    window.location = "/save";

});


//calculator
let html = `
<html lang="fr">
<head>
<link rel="stylesheet" href="../data/style/calculator.css">
<title>Calculator</title>
</head>
<body>
    <div class="calculator">
      <input type="text" class="calculator-screen" value="" disabled="">

      <div class="calculator-keys">
        <button type="button" class="operator" value="+">+</button>
        <button type="button" class="operator" value="-">-</button>
        <button type="button" class="operator" value="*">×</button>
        <button type="button" class="operator" value="/">÷</button>

        <button type="button" value="7">7</button>
        <button type="button" value="8">8</button>
        <button type="button" value="9">9</button>

        <button type="button" value="4">4</button>
        <button type="button" value="5">5</button>
        <button type="button" value="6">6</button>

        <button type="button" value="1">1</button>
        <button type="button" value="2">2</button>
        <button type="button" value="3">3</button>

        <button type="button" value="0">0</button>
        <button type="button" class="decimal" value=".">.</button>
        <button type="button" class="all-clear" value="all-clear">AC</button>

        <button type="button" class="equal-sign operator" value="=">=</button>
      </div>
    </div>
<script type="text/javascript" src="../data/js/calculator.js"></script>
</body>
</html>
`;

document.getElementById("calc").addEventListener("click", function() {
    let win = window.open("", "", "width=398,height=500");
    win.document.write(html);

});