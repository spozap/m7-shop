let login = document.getElementById('login')

let invalidFeedbacks = document.querySelectorAll('.invalid-feedback')


login.addEventListener('click' , (e) => {

    if (!validatePassword() ||!validateUsername()) {

        e.preventDefault()
        return
    }


    let body = new FormData;
    body.append("username" , document.getElementById('username').value)
    body.append("password", document.getElementById('password').value)



    fetch('../db/verifyUser.php' , 
    {
        method: 'POST',
        body: body
    })
    .then(response => response.json())
    .then(data => {

        console.log(data.validated)

        if (data.validated === true) {

            location.replace("http://localhost/m7-shop/views/main.php")

        } else {

            alert("LOGIN INCORRECTO")

        }

    })
    e.preventDefault()
})

const validateUsername = () => {

    let elem = document.getElementById('username')

    console.log(elem.value)

    if (elem.value != "") {

        setIsValid(elem , invalidFeedbacks[0])
        return true
    } 

    setIsInvalid(elem , invalidFeedbacks[0] , "No puedes dejar el usuario vacío!")
    return false

}

const validatePassword = () => {
  
    let elem = document.getElementById('password')

    console.log(elem.value)

    if (elem.value != "") {

        setIsValid(elem , invalidFeedbacks[1])
        return true
    } 

    setIsInvalid(elem , invalidFeedbacks[1] , "No puedes dejar la contraseña vacío!")
    return false

}


let username = document.getElementById('username').addEventListener('blur' , validateUsername)
let password = document.getElementById('password').addEventListener('blur' , validatePassword)


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