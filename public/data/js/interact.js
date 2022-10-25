
//Manage popup
document.getElementById("close_popup").addEventListener("click", toggle);
document.getElementById("card_popup").addEventListener("click", toggle);

function toggle(){
    document.getElementById("popup").classList.toggle("hidden");
}