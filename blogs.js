let modal = document.querySelector("#modal");

let form = document.forms[0];
let username = form.username;
let email = form.email;

let errors = [];
let containerError = document.getElementById("errors");
console.log(containerError);

function validationForm(){
    form.addEventListener('submit', (e) => {
        e.preventDefault(); 

        errors = []; 
        containerError.textContent = '';
      

        if(username.value == "" || username.value.length < 6){
            errors.push("Username is required and must be at least 7 characters long.");
        }

        if(email.value == ""){
            errors.push("Email is required.");
        }

        if(errors.length > 0){
            errors.forEach(error => {
                let errorElement = document.createElement('p');
                errorElement.classList.add("text-red-600", "text-center");
                errorElement.textContent = error;
                containerError.appendChild(errorElement);
            });
    

        } else {
            form.submit();
        }

        username.value = "";
        email.value = "";
    });
}
validationForm();





setInterval(()=> {
    modal.classList.remove("hidden");
}, 4000);