
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