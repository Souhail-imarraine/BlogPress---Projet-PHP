let d = document.querySelector("#alert");
let containerAlert = document.querySelector(".alertred");

d.addEventListener('click', () => {
    containerAlert.classList.add("hidden");
});

const myform = document.forms ;
console.log(myform);
myform.addEventListener('submit', (e)=> {
    let valid = true;
    
    const name = form.Fullname.value.trim();
    const email = form.email.value.trim();
    const password = form.password.value.trim();
    let role = form.rolee.value;
    
    clearErrors();

    if (name === "") {
        showError("Full Name is required.");
        valid = false;
    }

    if (email === "") {
        showError("Email is required.");
        valid = false;
    }

    if (password === "") {
        showError("Password is required.");
        valid = false;
    } else if (password.length < 6) {
        showError("Password must be at least 6 characters long.");
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }

});


function showError(message) {
    containerAlert.textContent = message;
    alertDiv.style.display = 'flex'; 
}

function clearErrors() {
    containerAlert.textContent = ""; 
    containerAlert.style.display = 'none'; 
}