//Toggle loginModal
let loginIcon = document.getElementById('loginIcon')
if (loginIcon){
    loginIcon.onclick = function () {
        $('#exampleModalCenter').modal('toggle');
    }
}

//Present deletionConfirmationModal
let trashIcon = document.getElementById('trash-icon')
if (trashIcon){
    trashIcon.addEventListener('click', showConfirmationModal)
   function showConfirmationModal(event) {
        event.preventDefault()
        $('#deletionConfirmationModal').modal('toggle');
    }
}


//use eye-icon to toggle passwordInput visibility
let eyeIcon = document.getElementById('eyeIcon')
if (eyeIcon) {
    eyeIcon.onclick = function () {
        togglePassVisibility('passwordInput')
    }
}


let confirmEyeIcon = document.getElementById("confirmEyeIcon");
if (confirmEyeIcon) {
    confirmEyeIcon.onclick = function () {
        togglePassVisibility('confirmPasswordInput')
    }
}


function togglePassVisibility(passFieldName){
    //Toggle password visibility
    let passwordInput = document.getElementById(passFieldName);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

/* Preview image before adding a CD to a database*/
const uploadImageInput = document.getElementById('form-cd-img-upload')
const previewContainer = document.getElementById('image-preview-container')
const previewImg = document.getElementById('image-preview-image')
const previewDefaultText = document.getElementById('image-preview-placeholder')


if(uploadImageInput){

    uploadImageInput.addEventListener('change', function (){
        const file =this.files[0]

        if(file){
            const reader = new FileReader()
console.log(file)
            console.log(previewImg)
            console.log(previewDefaultText)
            previewDefaultText.style.display = 'none'
            previewImg.style.display = 'inline-block'
            previewContainer.classList.remove('gray-border-override-class')

            reader.addEventListener('load', function(){
                previewImg.setAttribute('src', this.result)
            })
            reader.readAsDataURL(file)

        }
    })
}

/* ------------------------------ Login Form Ajax ------------------------------*/

document.getElementById('login-form').addEventListener('submit', submitLoginInfo)

function submitLoginInfo(event){
    //prevent the redirect
    event.preventDefault()

    //get all dom elements
    let emailLabel = document.getElementById('login-form-label-for-email')
    let emailInput = document.getElementById('login-form-email')
    let passwordLabel = document.getElementById('login-form-label-for-password')
    let passwordInput = document.getElementById('login-form-password')
    let errorPlaceholder = document.getElementById('login-form-error-message-placeholder')

    //CREATE PARAMS TO SEND OVER HEADER
    let email = emailInput.value
    let password = passwordInput.value
    let params = "email="+email+"&password="+password;

    //Create XHR Object
    let xhr = new XMLHttpRequest();
    //OPEN - TYPE, URL/FILE, ASYNC
    xhr.open('POST',  'http://velvetrecords:8888/users/login', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {
        console.log(xhr.status)
        if (xhr.status == 200){
            console.log(xhr.responseText)
            let parsedResponse = JSON.parse(xhr.responseText)

            let emailError = parsedResponse.emailError
            let passwordError = parsedResponse.passwordError

            //EMAIL:
            if(emailError || passwordError){
                //add CSS classes to show  errors
                addInvalidInputAppearance(emailLabel, emailInput, emailError)
                addInvalidInputAppearance(passwordLabel, passwordInput, passwordError)
                addErrorMessage(errorPlaceholder, 'Un de vos idéntifients est erroné')
            } else {
                let contentContainer = document.getElementById('login-popup-content-container')

                //add CSS classes to show success message
                deleteAllChildNodes(contentContainer)
                contentContainer.classList.add('row', 'justify-content-center')
                contentContainer.classList.remove('modal-content')
                appendImageAndMessage(contentContainer, '../images/success-icon.svg', 'Succès!')


                setTimeout(function() {
                    window.location.reload()
                }, 1000);
            }

        } else {
            //TODO: SHOW AN ERROR MESSAGE ON THE LOGIN MODAL
            addInvalidInputAppearance(emailLabel, emailInput)
            addInvalidInputAppearance(passwordLabel, passwordInput)

            addErrorMessage(errorPlaceholder, 'Une erreur est sourvenue lors de la connexion.')
        }
    }

    xhr.send(params)
}


/*--------- Log Out AJAX -----------*/
let logoutButton = document.getElementById('logout-trigger')
    if(logoutButton){
        logoutButton.onclick = function( ) {
            console.log('button clicked')
            //Create XHR Object
            let xhr = new XMLHttpRequest();
            //OPEN - TYPE, URL/FILE, ASYNC
            xhr.open('GET',  'http://velvetrecords:8888/users/logout', true);
            //TODO: FIX THE BUG WITH THE XHR OBJ
             xhr.onload = function () {
                 if (xhr.status == 200){
                     setTimeout(function() {
                         window.location.reload()
                     }, 500);
                 }
             }
             xhr.send()
    }



}







/*--------- Functions -----------*/
function addInvalidInputAppearance(label, input, errorMessage){
    //Add error message to the email label and the red color
    if(errorMessage){
        label.innerHTML = errorMessage
    }

    label.classList.add('text-danger')

    //add red border to the email input
    input.classList.add('is-invalid')
}

function addErrorMessage(placeholder, message){
    placeholder.classList.add('red-color-with-opacity-override-class')
    placeholder.innerHTML = message
}

function deleteAllChildNodes(parentNode) {
parentNode.querySelectorAll('*').forEach(n => n.remove())
}

function appendImageAndMessage(parentNode, imgName, message) {
    let newTextAndImgWrapper = document.createElement("div")
    newTextAndImgWrapper.setAttribute("class", "text-center text-light d-flex flex-column h5")

    let newImage = document.createElement("IMG")
    newImage.setAttribute("src", imgName)
    newImage.setAttribute("width", "100")
    newImage.setAttribute("height", "100")
    newImage.setAttribute("alt", "success")
    newImage.setAttribute("class", "mx-auto my-5")
    newTextAndImgWrapper.appendChild(newImage)
    let newParagraph = document.createTextNode(message)
    newTextAndImgWrapper.appendChild(newParagraph)

    parentNode.appendChild(newTextAndImgWrapper)
}
