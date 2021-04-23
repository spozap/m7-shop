console.log("CACA")

let submit = document.getElementById('product-submit');
let invalidFeedback = document.querySelectorAll('.invalid-feedback');

submit.addEventListener('click' ,function(e) {

    if (!validateProductName() || !validateProductDesc() || !validateProductPrice()
    ||!validateProductImages()) {

        e.preventDefault();
        return;

    }
    
    // Appending data to FormData to send to PHP
    let body = new FormData;
    body.append("name" , document.getElementById('product-name').value)
    body.append("description" , document.getElementById('product-description').value)
    body.append("price" , document.getElementById('product-price').value)
    
    let fileNames = Array.from(document.getElementById('product-images').files)

    for(let i = 0 ; i < fileNames.length ; ++i) {

        body.append("images[]", fileNames[i])

    }

    let radio = document.getElementsByClassName('radio');

    let category = null

    for(let i = 0 ; i < radio.length ; ++i) {

        if (radio[i].checked){
            category = radio[i].value 
        }

    }
    
    body.append("category" , category)

    e.preventDefault();
    
    fetch("../db/insertProduct.php", { method: 'POST', body: body }).then(response => {
        response.json()
    })
    .then(data => {

        console.log(data)
    })

    e.preventDefault();


})

const validateProductName = () => {

    let name = document.getElementById('product-name');

    if (name.value === "") {
        setIsInvalid(name , invalidFeedback[0] , "Nombre del producto inválido")
        return false
    }

    setIsValid(name)
    return true

}

document.getElementById('product-name').addEventListener("blur" , validateProductName)

const validateProductPrice = () => {

    let price = document.getElementById('product-price');

    if (price.value === "") {
        setIsInvalid(price, invalidFeedback[1], "Precio del producto inválido")
        return false
    }

    setIsValid(price)
    return true
}

document.getElementById('product-price').addEventListener("blur" , validateProductPrice)

const validateProductDesc = () => {

    let desc = document.getElementById('product-description');

    if (desc.value === "") {
        setIsInvalid(desc, invalidFeedback[2], "Descripción del producto inválida")
        return false
    }

    setIsValid(desc)
    return true

}

document.getElementById('product-description').addEventListener("blur" , validateProductDesc)

const validateProductImages = () => {

    let productImages = document.getElementById('product-images');

    let files = productImages.files

    if(files.length > 3) {
        
        setIsInvalid(productImages, invalidFeedback[3] , "No puedes subir más de 3 imágenes!")
        return false
    }

    setIsValid(productImages)
    return true

}

document.getElementById('product-images').addEventListener("blur" , validateProductImages)

const setIsValid = (element ) => {


    if (element.classList.contains('is-invalid')){
        element.classList.replace('is-invalid' , 'is-valid')
        return
    }

    element.classList.add('is-valid')

}

const setIsInvalid = (element , feedback , message) => {

    if (element.classList.contains('is-valid')){
        element.classList.replace('is-valid' , 'is-invalid')
        return
    }

    feedback.innerHTML = message
    element.classList.add('is-invalid')
    
}