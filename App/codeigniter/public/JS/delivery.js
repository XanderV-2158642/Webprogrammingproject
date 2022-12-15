const form = document.getElementById('form');
const country = document.getElementById('country');
const city = document.getElementById('city');
const postal = document.getElementById('postal');
const street = document.getElementById('street');
const number = document.getElementById('number');


form.addEventListener('submit', (listener) => {
    listener.preventDefault();
    if(checkInputs()){
        form.submit();
    }
});


function checkInputs(){
    const countryvalue = country.value;
    const cityvalue = city.value;
    const postalvalue = postal.value;
    const streetvalue = street.value;
    const numbervalue = number.value;

    var correct = true;

    if(countryvalue.length < 2){
        setError(country, 'Please enter a valid country');
        correct = false;
    }else{
        setValid(country, 'Country');
    }

    if(cityvalue.length < 2){
        setError(city, 'Please enter a valid city');
        correct = false;
    }else{
        setValid(city, 'City');
    }

    if(postalvalue.length < 2){
        setError(postal, 'Please enter a valid postal');
        correct = false;
    }else{
        setValid(postal, 'Postal');
    }

    if(streetvalue.length < 2){
        setError(street, 'Please enter a valid street');
        correct = false;
    }else{
        setValid(street, 'Street');
    }

    if(numbervalue.length <= 0){
        setError(number, 'Please enter a valid number');
        correct = false;
    }else{
        setValid(number, 'Number');
    }
    
    return correct;
}

function setError(input, message){
    const parentdiv = input.parentElement;
    const inputfield = input;
    const label = parentdiv.querySelector('label');

    label.innerText = message;
    var clsname = label.className;
    clsname = clsname + " error-xv";
    label.className = clsname;
}

function setValid(input, message){
    const parentdiv = input.parentElement;
    const inputfield = input;
    const label = parentdiv.querySelector('label');

    label.innerText = message;
    var clsname = label.className;
    clsname = clsname + " valid-xv";
    label.className = clsname;
}