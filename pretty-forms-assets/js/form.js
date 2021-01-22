/*
let formInputResponseMessages = [
                                 'First Name required',
                                 'E-mail required',
                                 'Contact required', 
                                 'Password required', 
                                 'Confirm password required'
                                ] 

let formInput = document.getElementsByClassName('form-input') 
let formInputResponse = document.getElementsByClassName('form-input-response') 
function validateForm(form){
    let val
    let result = true
    let control

    // validating normal inputs and textarea fields
    for(i=0; i<formInput.length; i++){
        val = formInput[i].value.trim()
        if(val == ''){
            formInputResponse[i].className += ' valid-error'
            formInputResponse[i].style.display = 'block'
            formInputResponse[i].innerHTML = formInputResponseMessages[i]
            formInput[i].className = 'form-input input-valid-error'
            result = false
        }
        else{
            formInputResponse[i].style.display = 'none'
            formInput[i].className = 'form-input input-valid-success'
        }
    }

    result = emailValidation()
    result = passwordValidation()
    result = checkPasswordMatch()
    return result
}

function formSetUp(){
    let form = document.getElementById('validate-form')
    form.addEventListener('submit', (event) => {
        event.preventDefault()
        event.stopPropagation()
        let result = validateForm()
        if(result)
            form.submit()
    })
    for(i=0; i<formInput.length; i++){
        formInput[i].addEventListener('input', validateForm)
    }
}


/*window.onload = function(){
    formSetUp()
}
*/
// check password match
/*
let passwordID = 'password'
let confPasswordID = 'conf-password'
let passwordInput = document.getElementById(passwordID)
let confPasswordInput = document.getElementById(confPasswordID)
function checkPasswordMatch(){
    let password = passwordInput.value
    let confPassword = confPasswordInput.value
    let matchIcon = document.getElementById('password-match-icon')
    let notMatchIcon = document.getElementById('password-not-match-icon')
    if(password.length > 0 && confPassword.length > 0){
        if(password == confPassword){
            matchIcon.style.display = 'block'
            notMatchIcon.style.display = 'none'
            passwordInput.className = 'form-input input-valid-success'
            confPasswordInput.className = 'form-input input-valid-success'
            return true
        }
        else{
            matchIcon.style.display = 'none'
            notMatchIcon.style.display = 'block'
            passwordInput.className = 'form-input input-valid-error'
            confPasswordInput.className = 'form-input input-valid-error'
            return false
        }
    }
    else return false
}
passwordInput.addEventListener('click', checkPasswordMatch)
confPasswordInput.addEventListener('click', checkPasswordMatch)
*/
// toggle password visibility


let showEyeIconID = 'password-show-eye-icon'
let hideEyeIconID = 'password-hide-eye-icon'
let showEyeIcon = document.getElementById(showEyeIconID)
let hideEyeIcon = document.getElementById(hideEyeIconID)
function makePasswordVisible(){
    let passwordInput = document.getElementById('password')
    if(passwordInput.type == 'password'){
        passwordInput.type = 'text'
        showEyeIcon.style.display = 'none'
        hideEyeIcon.style.display = 'block'
    }
    else{
        passwordInput.type = 'password'
        showEyeIcon.style.display = 'block'
        hideEyeIcon.style.display = 'none'
    }
}
showEyeIcon.addEventListener('click', makePasswordVisible)
hideEyeIcon.addEventListener('click', makePasswordVisible)


// E-mail validation
/*
function emailValidation(){
    let emailID = 'email-validate'
    let emailValidateResponseID = 'email-validate-response'
    let emailInput = document.getElementById(emailID)
    let emailValidateResponse = document.getElementById(emailValidateResponseID)
    let email = emailInput.value
    let emailRegExp = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/
    if(email.length > 0){
        if(email.match(emailRegExp))
        {
            emailValidateResponse.innerHTML = 'Valid E-mail'
            emailValidateResponse.style.color = 'green'
            emailValidateResponse.style.display = 'block'
            emailInput.className = 'form-input input-valid-success'
            return true
        }
        else{
            emailValidateResponse.innerHTML = 'Invalid E-mail'
            emailValidateResponse.style.color = 'red'
            emailValidateResponse.style.display = 'block'
            emailInput.className = 'form-input input-valid-error'
            return false
        }
    }
    else return false
}

//Password validation
function passwordValidation(){
    let passwordID = 'password'
    let passwordValidateResponseID = 'password-validate-response'
    let passwordInput = document.getElementById(passwordID)
    let passwordValidateResponse = document.getElementById(passwordValidateResponseID)
    let password = passwordInput.value
    //Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character, Maximum limit 20 characters
    let passwordRegExp = "^(?=.*[0-9])"
                            + "(?=.*[a-z])(?=.*[A-Z])"
                            + "(?=.*[@#$%^&+=])"
                            + "(?=\\S+$).{8,20}$"
    console.log('password : ' + password)
    if(password.length > 0){
        console.log('validating...')
        console.log(password.match(passwordRegExp))
        if(password.match(passwordRegExp))
        {
            console.log('success')
            passwordValidateResponse.innerHTML = 'Valid Password'
            passwordValidateResponse.style.color = 'green'
            passwordValidateResponse.style.display = 'block'
            passwordInput.className = 'form-input input-valid-success'
            return true
        }
        else{
            console.log('error 1')
            passwordValidateResponse.innerHTML = 'Minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character <br/> Maximum limit 20 characters'
            passwordValidateResponse.style.color = 'red'
            passwordValidateResponse.style.display = 'block'
            passwordInput.className = 'form-input input-valid-error'
            return false
        }
    }
    else return false
}
*/
