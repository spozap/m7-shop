console.log("CACA DE VACA")

let register = document.getElementById("registerBtn")
let invalidFeedbacks = document.querySelectorAll('.invalid-feedback')


register.addEventListener('click' , (e) => {
    
    if (!validateUsername() || !validatePassword()
        || !validateEmail()){
        e.preventDefault();
    }

})

const validateEmail = () => {

    let email = document.getElementById('email');
    
    if (email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){ // asdas@asda.com OK
        setIsValid(email , invalidFeedbacks[1])
        return true
    }
    
    setIsInvalid(email , invalidFeedbacks[1] , "Email is invalid")
    return false
}

// Listener to input for validating email
document.getElementById("email").addEventListener("blur" , validateEmail)


const validateUsername = () => {

    let username = document.getElementById('username');
    
    if (username.value.match(/^\w{3,20}$/)){ // Username with between 3 and 20 chars
        setIsValid(username , invalidFeedbacks[0])
        return true
    }

    setIsInvalid(username , invalidFeedbacks[0] , "Username is invalid")
    return false

}

// Listener to input for validating username
document.getElementById("username").addEventListener("blur" , validateUsername)


const validatePassword = () => {

    let password = document.getElementById('password');

    /**
     * Password must contain
     * Minimum of 8 characters
     * Almost 1 capital letter and number
     * Special simbol (*._/!?)
     */

    if (password.value.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/)){
        setIsValid(password , invalidFeedbacks[2])
        return true
    }

    setIsInvalid(password , invalidFeedbacks[2] , "Password is invalid")
    return false
}

// Listener to input for validating password
document.getElementById("password").addEventListener("blur" , validatePassword)


const setIsValid = (element , feedback ) => {

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