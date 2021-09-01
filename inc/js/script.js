const form = document.querySelector(".product-list form"),
addBtn = form.querySelector(".button input");

form.onsubmit = (e) =>{
    e.preventDefault(); //prevent form from submitting
}

addBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "add_cart.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}

