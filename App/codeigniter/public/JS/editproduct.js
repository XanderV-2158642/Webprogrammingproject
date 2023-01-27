const form = document.getElementById('form');
const title = document.getElementById('producttitle');
const price = document.getElementById('productprice');
const heritage = document.getElementById('productheritage');
const size = document.getElementById('productsize');
const amount = document.getElementById('productamount');

const description = document.getElementById('description');
const images = document.getElementById('image');

form.addEventListener('submit', (listener) => {
    listener.preventDefault();
    if(checkInputs()){
        form.submit();
    }
});

function checkInputs(){
    const titlevalue = title.value;
    const pricevalue = price.value;
    const heritagevalue= heritage.value;
    const descriptionvalue = description.value;
    if (size == null){
        var elec = true;
    } else {
        var sizevalue = size.value;
    };
    const amountvalue = amount.value;

    let correct = true;

    if (titlevalue == ''){
        setError(title, 'Please give a title');
        correct = false;
    } else if (titlevalue.length>254){
        setError(title, 'title too long');
        correct = false;
    } else {
        setValid(title, 'Title');
    }

    if (pricevalue <= 0){
        setError(price, 'Price must be higher than 0');
        correct = false;
    } else {
        setValid(price, 'Price');
    }

    if (heritagevalue == ''){
        setError(heritage, 'Please give a Heritage');
        correct = false;
    } else if (heritagevalue.length>254){
        setError(heritage, 'Heritage too long');
        correct = false;
    } else {
        setValid(heritage, 'Heritage');
    }


    if(!elec){
        if (sizevalue <= 0){
            setError(size, 'Size must be higher than 0');
            correct = false;
        } else {
            setValid(size, 'Size');
        }
    } 

    if (amountvalue <= 0){
        setError(amount, 'Amount must be higher than 0');
        correct = false;
    } else {
        setValid(amount, 'Amount');
    }

    if (descriptionvalue == ''){
        setError(description, 'Please give a description');
        correct = false;
    } else if (descriptionvalue.length>600){
        setError(description, 'description too long');
        correct = false;
    } else {
        setValid(description, 'Description');
    }


    if (images.files.length ==0){
        setValid(images , 'Valid')
    } else if(isImages(images)){
        setValid(images, 'Valid')
    }else{
        setError(images, 'upload Jpg image (or mp4vid) ');
        correct = false;
    }

    return correct;
}

function setError(input, message){
    const parentdiv = input.parentElement.parentElement;
    const inputfield = input;
    const label = parentdiv.querySelector('label');

    label.innerText = message;
    var clsname = label.className;
    clsname = clsname + " error-xv"
    label.className = clsname;
}

function setValid(input, message){
    const parentdiv = input.parentElement.parentElement;
    const inputfield = input;
    const label = parentdiv.querySelector('label');

    label.innerText = message;
    var clsname = label.className;
    var clsname = label.className;
    clsname = clsname + " valid-xv"
    label.className = clsname;
}


function isImages(input){
    for (var index = 0; index < input.files.length; index++) {
        var imgname = input.files[index].name;
        console.log(imgname);
        if (!isImage(imgname) && !isVideo(imgname)){
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

function isVideo(file){
    var ext = getExtension(file);
    if (ext.toLowerCase() == 'mp4'){
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