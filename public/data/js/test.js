let postData = {nom : lucas};

await fetch("../view/index.php", {
    method: "POST",
    data: JSON.stringify(postData),
    headers: { "Content-type": "application/json; charset=UTF-8" },
}).catch((err) => console.log(err));