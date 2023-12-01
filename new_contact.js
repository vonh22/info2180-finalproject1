window.onload = async (k) => {
    const form = document.getElementById("contactform");
    let save = document.querySelector("#save");
    let responsearea = document.querySelector("#responsemsg");
    let url = "contact.php?";

    save.addEventListener("click", function (k) {
        k.preventDefault();
    
        const fdata = new FormData(form);
        const data = new URLSearchParams(fdata);
    
        fetch(url, {
            method: "POST",
            body: data,
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Network response was not ok.");
            }
        })
        .then(responseText => {
            console.log(responseText);
            responsearea.innerHTML = responseText;
    
            if (responseText === "<span class='resMsg'>New user successfully submitted!</span><br>") {
                form.reset();
            }
        })
        .catch(e => {
            console.error("There was an error detected:", e);
        });
    });
    
    let result = document.getElementById('result');

    let response = await fetch(`contact.php?load=options`);

    if(response.status === 200){
        let data = await response.text();
        result.innerHTML = data;
    } else {
        alert("There was a problem processing your request.");
    }

}
