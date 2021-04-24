let register = document.getElementById("registerBtn")
let invalidFeedbacks = document.querySelectorAll('.invalid-feedback')

let latitude = document.getElementById('latitude')
let longitude = document.getElementById('longitude')

// BUTTON TO SHOW USER ADDRESS

var map = L.map('map').setView([41.388, 2.159], 12);
L.esri.basemapLayer('Topographic').addTo(map);
console.log(map)


let findLoc = document.getElementById('findLoc')
findLoc.addEventListener('click' , (e) => {

    let addrName = document.getElementById('addrName')
    let street = document.getElementById('street')
    let pobl = document.getElementById('pobl')

    if (addrName.value != null && street.value != null && pobl.value != null) {

        let selected = document.getElementById('via')
        let via = selected.options[selected.selectedIndex].text



        let address = `${via} ${addrName.value} ${street.value} ${pobl.value}`;
        
        console.log(address)
        setLatLng(address)

    }


})


// BUTTON TO REGISTER USERNAME
register.addEventListener('click' , (e) => {
    console.log("HAS HECHO CLICKKKK")
    if (!validateUsername() || !validatePassword()
        || !validateEmail()){
        e.preventDefault();
        console.log("AAAAAEEEEE")
        return;
    }

    let body = new FormData;
    body.append("username" , document.getElementById('username').value)
    body.append("password", document.getElementById('password').value)
    body.append("email", document.getElementById('email').value)

    console.log(document.getElementById('username').value)
    console.log(document.getElementById('password').value)
    console.log(document.getElementById('email').value)

    fetch("../db/registerUser.php" , { method: 'POST' , body: body })
    .then(response => response.json())
    .then(data => {

        console.log(data)
        location.replace("http://localhost/m7-shop/views/main.php")

    });

    e.preventDefault();

})

const validateEmail = () => {

    let email = document.getElementById('email');
    
    if (email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){ // asdas@asda.com OK
        setIsValid(email)
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
        setIsValid(username)
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
        setIsValid(password)
        return true
    }

    setIsInvalid(password , invalidFeedbacks[2] , "Password is invalid")
    return false
}

// Listener to input for validating password
document.getElementById("password").addEventListener("blur" , validatePassword)


// SET LATITUDE && LONGITUDE
const setLatLng = (address) => {

    L.esri.Geocoding.geocode().text(address).run((err , results , response) => {

        if (!err) {

            latitude = results.results[0].latlng.lat
            longitude = results.results[0].latlng.lng;

            console.log("lat ="+latitude+", lng = "+longitude);

            L.marker([latitude, longitude]).addTo(map);

            register.disabled = false

        } else {

            console.log(err)
            alert("We've got a problem validating your address , " + err)
        }

    })

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