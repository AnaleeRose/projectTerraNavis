console.log("border");
profilePicThumb = document.body.querySelector(".profilePic");
registerForm = document.body.querySelector(".registerForm");
requiredInputs = document.body.querySelectorAll(".requiredInput");
choosePicBtn = document.body.querySelector(".choosePic");

// run these onload
updateProfileBorder();

// checks if all required inputs are valid and updates he profile picture's border accordingly
window.addEventListener('keyup', updateProfileBorder);
function updateProfileBorder() {
    list = [];
    console.log("ran");
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
