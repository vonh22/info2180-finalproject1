window.onload = async (k) => {
    const result = document.querySelector('#results');
    let filters = document.querySelectorAll(".filters li");
    let currentEl = "";
    k.preventDefault();

    const handleActive = async (k) => {
        k.preventDefault();
        filters.forEach(el => {
            el.classList.remove("current");
        })
        k.currentTarget.classList.add("current");
        currentEl = k.currentTarget;

        let response = await fetch(`dashboard.php
        ?q=${currentEl.querySelector("a").text}`);

        if(response.status === 200){
            let data = await response.text();
            result.innerHTML = data;
        } else {
            alert("There was a problem processing your request.");
        }
    }

    filters.forEach(el => {
        el.addEventListener('click', handleActive);
    })

    let response = await fetch(`dashboard.php`);

        if(response.status === 200){
            let data = await response.text();
            result.innerHTML = data;
        } else {
            alert("There was a problem processing your request.");
        }

}