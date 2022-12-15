const form = document.getElementById('form');
const username = document.getElementById('username');
const description = document.getElementById('description');
const phone = document.getElementById('phone');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const images = document.getElementById('image');

form.addEventListener('submit', (listener) => {
    listener.preventDefault();
    if(checkInputs()){
        form.submit();
    }
});

function checkInputs(){
    const namevalue = username.value;
    const descriptionvalue = description.value;
    const phonevalue = phone.value;
    const emailvalue = email.value;
    const passwordvalue = password.value;
    const password2value = password2.value;

    let correct = true;

    if (namevalue === ''){
        setError(username, 'You can not use empty name');
        correct = false;
    } else if (namevalue.length >254){
        setError(username, 'Name too long');
        correct = false;
    }else{
        setValid(username, "Full Name");
    }

    if (phonevalue === ''){
        setError(phone, "Phone number can not be empty");
        correct = false;
    } else if (phonevalue.length > 15) {
        setError(phone, "Phone number too long");
        correct = false;
    } else {
        setValid(phone, "Phone Number");
    }

    if (emailvalue === '') {
        setError(email, "Email can not be empty");
        correct = false;
    } else if (!isEmail(emailvalue)) {
        setError(email, "Email not valid");
        correct = false;
    } else {
        setValid(email, "Email Address");
    } 

    if (passwordvalue.length < 8){
        setError(password, "Password too short");
        correct = false;
    } else if (passwordvalue.length > 254) {
        setError(password, "Password too long");
        correct = false;
    } else {
        setValid(password, "Password");
    }

    if (password2value !== passwordvalue) {
        setError(password2, "This does not match the previous");
        correct = false;
    } else {
        setValid(password2, "Confirm Password");
    }

    setValid(description, "Description");

    if (images.files.length ==0){
        setValidImage(images)
    } else if(isImages(images)){
        setValidImage(images)
    }else{
        setErrorImage(images);
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

function setValid(input, fieldname){
    const formcontrolpar = input.parentElement;
    const formcontrol = input;
    const label = formcontrolpar.querySelector('label');

    label.innerText = fieldname;

    formcontrolpar.className = 'form-floating valid'
    formcontrol.className = 'form-control valid'
}

function setErrorImage(image, message){
    const formcontrolpar = image.parentElement;
    const formcontrol = image;
    const label = formcontrolpar.querySelector('label');

    label.innerText = message;

    formcontrolpar.className = 'mb-3 error'
    formcontrol.className = 'form-control error'
}

function setValidImage(image){
    const formcontrolpar = image.parentElement;
    const formcontrol = image;
    const label = formcontrolpar.querySelector('label');

    label.innerText = "Image";

    formcontrolpar.className = 'mb-3 valid'
    formcontrol.className = 'form-control valid'
}

function isEmail(emailAdress){
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (emailAdress.match(regex)) 
    return true; 

   else 
    return false; 
}

function isImages(input){
    for (var index = 0; index < input.files.length; index++) {
        var imgname = input.files[index].name;
        console.log(imgname);
        if (!isImage(imgname)){
            return false
        }        
    }
    return true;
}

function isImage(file){
    var ext = getExtension(file);
    if (ext.toLowerCase() == 'jpg'){
        return true;
    }
    else{
        return false;
    }
}

function getExtension(file){
    var parts = file.split('.');
    return parts[parts.length - 1];
}