window.onload = async function() {
    const form = document.getElementById("form");
    var result = document.getElementById("result");
    let submit = document.querySelector("#submitbtn");
    let pword = document.querySelector("#password");
    var url = "newuser.php?";


    submit.addEventListener("click", function (k) {
        k.preventDefault();
    
        const fdata = new FormData(form);
    
        fetch(url, {
            method: "POST",
            body: fdata,
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Network response was not ok");
            }
        })
        .then(responseText => {
            console.log(responseText);
            result.innerHTML = responseText;
    
            if (responseText === "<span class='resMsg'>New user successfully submitted!</span><br>") {
                form.reset();
            }
        })
        .catch(e => {
            console.error("There was a problem with the fetch operation:", e);
        });
    });
    
    pword.addEventListener('keypress', function(k) {  
        var space = k.keyCode;
        if(space === 32) {
            k.preventDefault();
        }
    });
}
