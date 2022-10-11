
function clearScreen() {
    document.getElementById("result").value = "";
}


function display(value) {
    document.getElementById("result").value += value;

}


function calculate() {
    var p = document.getElementById("result").value;
    var q = eval(p);
    document.getElementById("result").value = q;
    let url = 'http://localhost:8084/api/test';
    let resultCalcul;
    return resultCalcul = fetch(url, {
        method:"POST",
        body: JSON.stringify(q),
        headers: { "Content-type": "application/json; charset=UTF-8" },
    }).then(result => {
        console.log("Completed with result:", result);
    }).catch(err => {
        console.error(err);
    });

}


