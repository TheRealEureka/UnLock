//L'objet qui contient les données à envoyer
let data_test = {
    "name": "John",
    "age": 30
}

//Fonction qui envoie les données
async function sendRequest(data) {
    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    };
    //Envoie la requête sur l'URL de l'API
   return await fetch("http://localhost:8080/test/post", options)
        .then(response => {
            return response.json()
        })
        .then(data => {
            return data;
        });
}
//Appelle la fonction et log le resultat
async function log(){
    console.log(await sendRequest(data_test))
}

log();