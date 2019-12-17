var registerForm = document.body.querySelector(".registerForm");
var requiredInputs = document.body.querySelectorAll(".requiredInput");
var choosePicBtn = document.body.querySelector(".choosePic");
var profilePicThumb;


// checks if all required inputs are valid and updates he profile picture's border accordingly, but only on mobile because im annoying
if (screen.width < 750 || registerForm) {
    if (document.body.querySelector(".profilePic")) {
        profilePicThumb = document.body.querySelector(".profilePic");
    } else if (document.body.querySelector(".login_profilePic")) {
        profilePicThumb = document.body.querySelector(".login_profilePic");

    }
    // run on load
    updateProfileBorder();
    window.addEventListener('keyup', updateProfileBorder);
}

function updateProfileBorder() {
    list = [];
    if(requiredInputs.length !== 0) {
        if(requiredInputs.length !== 1) {
            requiredInputs.forEach(function(element) {
              if (element.checkValidity() === false) {
                list.push(element);
              }
            });
            if (list.length === 0) {
                allValid = true;
            }
        } else {
            if (requiredInputs[0].checkValidity() === true) {
                allValid = true;
            }
        }
    } else {
        allValid = true;
    }

    if (allValid === true && document.body.querySelector(".formNotice_Error") === null && list.length === 0) {
        profilePicThumb.style.borderColor = '#46b70e';
        if (choosePicBtn) choosePicBtn.style.background = '#46b70e';
    } else {
        profilePicThumb.style.borderColor = '#d8253d' ;
        if (choosePicBtn) choosePicBtn.style.background = '#d8253d';
    }
};
