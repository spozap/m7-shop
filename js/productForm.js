console.log("CACA")

let productName = document.getElementById('product-name');
let productPrice = document.getElementById('product-price');
let productDesc = document.getElementById('product-description');
let productImages = document.getElementById('product-images');

let submit = document.getElementById('product-submit');
let invalidFeedback = document.querySelectorAll('invalid-feedback');

// AJAX request to add product when form is validated
submit.addEventListener('click' , (e) => {
    validateProductName();
    e.preventDefault()
})

const validateProductName = () => {

    let name = document.getElementById('product-name');

    if (name.value === "") {
        setIsInvalid(name , invalidFeedbacks[0])
        return
    }

    setIsValid(name)

}

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