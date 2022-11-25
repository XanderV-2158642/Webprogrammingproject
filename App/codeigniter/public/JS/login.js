const form = document.getElementById('form');
const email = document.getElementById('email');
const password = document.getElementById('password');

form.addEventListener('submit', (listener) => {
    listener.preventDefault();
    if(checkInputs()){
        form.submit();
    }
});

function checkInputs(){
    const emailvalue = email.value;
    const passwordvalue = password.value;

    let correct = true;

    if (emailvalue === '') {
        setError(email, "Email can not be empty");
        correct = false;
    } else if (!isEmail(emailvalue)) {
        setError(email, "Email not valid");
        correct = false;
    }

    if (passwordvalue.length < 8){
        setError(password, "Password too short");
        correct = false;
    } else if (passwordvalue.length > 254) {
        setError(password, "Password too long");
        correct = false;
    }

    return correct;
}

function setError(input, message){
    const formcontrolpar = input.parentElement;
    const formcontrol = input;
    const label = formcontrolpar.querySelector('label');

    label.innerText = message;

    formcontrolpar.className = 'form-floating error'
    formcontrol.className = 'form-control error'
}


function isEmail(emailAdress){
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (emailAdress.match(regex)) 
    return true; 

   else 
    return false; 
}