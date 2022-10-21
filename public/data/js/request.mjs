
let data_test = {
    "name": "John",
    "age": 30
}


async function sendRequest(data) {
    console.log(data)
    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    };
    console.log(options)
   let res = await fetch("http://localhost:8080/test/post", options)
        .then(response => {
            return response.json()
        })
        .then(data => {
            return data;
        });
   console.log(res)
return res;
}

console.log(sendRequest(data_test));