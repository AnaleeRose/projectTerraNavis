if (document.body.querySelector(".profilePicThumb")) {
    var serverProfilePicID =  document.body.querySelector(".profilePicThumb").getAttribute('data-profilePic_id');
}
var profilePic = document.body.querySelector(".profilePic");
var choosePicBtn = document.body.querySelector(".choosePic");
var changePicBtn = document.body.querySelector(".changePicBtn");
var thumbTable = document.body.querySelector(".chooseThumbTable");
var registerForm = document.body.querySelector(".registerForm");
var updatePicForm = document.body.querySelector(".updatePicForm");
var saveChangesBtn = document.body.querySelector(".saveChangesBtn");
var profilePicChoice = document.body.querySelector("#profilePicChoice");
var lightModeBtn = document.body.querySelector(".lightModeBtn");
var lightModeInput = document.body.querySelector(".lightModeInput");
var profileInfo1 = document.body.querySelector(".profileInfo:first-of-type");
var elementTracker = document.body.querySelector('#elementTracker');
var imgs_notice = document.body.querySelector('.imgsNotice');
var publishBtn = document.body.querySelector('#publishBtn');


if (document.body.querySelector("#serverLightMode")) {
    var serverLightMode = document.body.querySelector("#serverLightMode").innerText;
    var currentLightMode = serverLightMode;
}

var requiredInputs = document.body.querySelectorAll(".requiredInput");
var allThumbnails = document.body.querySelectorAll(".chooseThumb");
var formNotices = document.body.querySelectorAll(".formNotice");
list = [];
allValid = false;




// choose profile picture button
if (choosePicBtn) {
    choosePicBtn.addEventListener('click', function(){
        if (thumbTable.classList.contains('chooseThumbTable_anim')) {
            thumbTable.classList.remove('chooseThumbTable_anim');
            registerForm.style.marginTop = '-8rem';
        } else {
            thumbTable.classList.add('chooseThumbTable_anim');
            registerForm.style.marginTop = null;
        }
    });
} else if (changePicBtn) {
    changePicBtn.addEventListener('click', function(){
        if (thumbTable.classList.contains('updateThumbTable_anim')) {
            changePicBtn.innerText = "Change Picture";
            changePicBtn.style.width = null;
            thumbTable.classList.remove('updateThumbTable_anim');
            profileInfo1.style.marginTop = '-5rem';
            if (serverLightMode === currentLightMode) {
                saveChangesBtn.classList.remove('saveChangesBtn_hidden');
            }
        } else {
            changePicBtn.innerText = "Cancel";
            changePicBtn.style.width = "3.5rem";
            thumbTable.classList.add('updateThumbTable_anim');
            profileInfo1.style.marginTop = null;
            if (serverLightMode === currentLightMode) {
                saveChangesBtn.classList.remove('saveChangesBtn_hidden');
            }
        }
    });
}


// choose profile image
function selectNewProfilePicture(elem) {
    profilePicChoice.setAttribute('value', elem.getAttribute('data-id')) ;
    profilePic.src = elem.src;
}

allThumbnails.forEach(function(elem) {
    elem.setAttribute('data-listener', 'true');
    elem.addEventListener('click', function(){
        selectNewProfilePicture(elem);
    });
});


//lightmode switch
if (lightModeBtn) {
    if (serverLightMode === 'dmode') {
        lightModeBtn.classList.add('lightModeBtn_d');
    }
    lightModeBtn.addEventListener('click', function(){
        if (lightModeBtn.classList.contains('lightModeBtn_d')){
            //animation
            lightModeInput.setAttribute('value', 'lmode');
            lightModeBtn.classList.add('lightModeBtn_l');
            lightModeBtn.classList.remove('lightModeBtn_d');

            //changing value for php
            if (currentLightMode === 'lmode') {
                document.body.classList.remove("lmode")
                document.body.classList.add("dmode")
                currentLightMode = 'dmode';
            } else if  (currentLightMode === 'dmode') {
                document.body.classList.remove("dmode")
                document.body.classList.add("lmode")
                currentLightMode = 'lmode';
            }

            if (serverLightMode === currentLightMode) {
                lightModeBtn.style.border = null;
            } else {
                lightModeBtn.style.border = '2px solid #43ac11';
            }

            if (serverLightMode === currentLightMode && !thumbTable.classList.contains("updateThumbTable_anim")){
                saveChangesBtn.classList.add('saveChangesBtn_hidden')
            } else {
                saveChangesBtn.classList.remove('saveChangesBtn_hidden')
            }

        } else {
            if(lightModeBtn.classList.contains('lightModeBtn_l') ){
                lightModeBtn.classList.remove('lightModeBtn_l');
            }
            lightModeInput.setAttribute('value', 'dmode');

            lightModeBtn.classList.add('lightModeBtn_d');

            if (currentLightMode === 'lmode') {
                document.body.classList.remove("lmode")
                document.body.classList.add("dmode")
                currentLightMode = 'dmode';
            } else if  (currentLightMode === 'dmode') {
                document.body.classList.remove("dmode")
                document.body.classList.add("lmode")
                currentLightMode = 'lmode';
            }

            if (serverLightMode === currentLightMode) {
                lightModeBtn.style.border = null;
            } else {
                lightModeBtn.style.border = '2px solid #43ac11';
            }

            if (serverLightMode === currentLightMode && !thumbTable.classList.contains("updateThumbTable_anim")) {
                saveChangesBtn.classList.add('saveChangesBtn_hidden')
            } else {
                saveChangesBtn.classList.remove('saveChangesBtn_hidden')
            }
        }
    })
}


// formNotices
formNotices.forEach(function(elem) {
    // let text = document.createElement("p");
    // elem.classList.forEach(function(e){
    //     text.classList.add(e);
    // })
    // let content = document.createTextNode(elem.innerText)
    // text.appendChild(content);
    // document.body.appendChild(text);
    // text.style.marginLeft = '-' + text.offsetWidth/2;
    // text.addEventListener('click', function() {
    //     text.parentNode.removeChild(text);
    // });
});0

function create_form_notice(name, notice_text, form_notice_type) {
    name = document.createElement('p');
    if (form_notice_type === 'error') {
        name.classList.add('formNotice', 'formNotice_Error');
    }
    let content = document.createTextNode(notice_text)
    name.appendChild(content);
    document.body.appendChild(name);
    let ml = 'margin-left: -' + name.offsetWidth/2 + 'px';
    name.setAttribute('style', ml);
    name.addEventListener('click', function() {
        name.parentNode.removeChild(name);
    });
}


// ------------------------------------------------------------------------------------------------>
// work with php to create elements on demand
// ------------------------------------------------------------------------------------------------>

var allContentTypeBtns = document.body.querySelectorAll(".contentPhpBtn");
var addThisContent = document.body.querySelector("#addThisContent");
var newContentDiv = document.body.querySelector("#newContent");
var allElementDeleteBtns = document.body.querySelector("#newContent");
if (elementTracker) {
    var max_on_page = elementTracker.getAttribute('data-general-max');
    var max_li_elements = elementTracker.getAttribute('data-max-li')
    var max_list_elements = elementTracker.getAttribute('data-max-lists')
}
let all, amount_on_page, input, label, labelName, element_class;


// create regular element
function create_element(input_type, type_of_input, label_name, individual_name, data_content_id) {
    if (input_type === 'hr') {
        newElement = document.createElement('hr');
        newElement.classList.add('newHr');
        newContentDiv.appendChild(newElement)

        input = document.createElement('input');
        input.classList.add(individual_name, type_of_input, 'textInput', 'contentInput', 'createInput');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', individual_name);
        input.setAttribute('id', individual_name);
        input.setAttribute('placeholder', label_name);
        input.setAttribute('data-content-type-id',data_content_id);
        input.setAttribute('value', individual_name);

    } else {
        
        label = document.createElement('label');
        labelName = document.createTextNode(label_name);
        label.setAttribute('for', individual_name);
        label.appendChild(labelName)
        newContentDiv.appendChild(label)
        if (input_type === 'textarea') {
            input = document.createElement('textarea');
            input.classList.add(individual_name, type_of_input, 'textareaInput', 'contentInput', 'createInput');
        } else if (input_type === 'text') {
            input = document.createElement('input');
            input.classList.add(individual_name, type_of_input, 'textInput', 'contentInput', 'createInput');
            input.setAttribute('type', 'text');
        }
        input.setAttribute('name', individual_name);
        input.setAttribute('id', individual_name);
        input.setAttribute('placeholder', label_name);
        input.setAttribute('data-content-type-id', data_content_id);


        elementDeleteBtn = document.createElement('p')
        elementDeleteBtn.addEventListener('click', function(e){
            let elementToDelete = e.srcElement.classList[1].substring(4);
            type_of_element(elementToDelete, true, e.srcElement);
        }) 
        elementDeleteBtn.classList = ''
        elementDeleteBtn.innerHTML = ''
        elementDeleteBtn.classList.add('elementDeleteBtn', 'EDB_' + individual_name);
        elementDeleteBtn.appendChild(document.createTextNode('Delete ' + type_of_input[0].toUpperCase() + type_of_input.slice(1)))

        newContentDiv.appendChild(input)
        label.appendChild(elementDeleteBtn);
    }

}

// create list element, requires special treatment
function create_list(input_type, type_of_input, label_name, individual_name, data_content_id) {
    // create a field set to group it all visually
        fieldset = document.createElement('fieldset');
        fieldset.setAttribute('data-max-lists', max_list_elements)
        fieldset.setAttribute('data-max-li', max_li_elements)
        fieldset.setAttribute('class', type_of_input);
        legend = document.createElement('legend');
        legend_text = document.createTextNode(individual_name);
        list_type = individual_name.substring(0,1)
        if (list_type === 'u') {
            legend_text = document.createTextNode('Unordered List ' + individual_name.substring(3,4));
            legend.classList.add('ul')
        } else if (list_type === 'o') {
            legend_text = document.createTextNode('Ordered List ' + individual_name.substring(3,4));
            legend.classList.add('ol')
        }
        legend.appendChild(legend_text);
        newContentDiv.appendChild(fieldset);
        fieldset.appendChild(legend);

    // create a button to add to list as needed
        btn_name = individual_name + '_btn'
        amount_on_page = document.body.querySelectorAll('.' + btn_name);
        num = amount_on_page.length + 1;
        addToListBtn = document.createElement('p');
        addToListBtn.innerText = '+';
        addToListBtn.setAttribute('data-list-name', individual_name);
        addToListBtn.classList.add("addToListBtn", btn_name);
        fieldset.appendChild(addToListBtn);
        activate_list_btns();
}


// lets you add a list item to a list
function activate_list_btns() {
    allListBtns = document.querySelectorAll('.addToListBtn');
    allListBtns.forEach(function(e) {
        e.addEventListener('click', function(e){
            add_to_list(e);
        })
    })
}


function add_to_list(e) {
    btn_clicked = e.srcElement;
    list_name = btn_clicked.getAttribute('data-list-name')
    fieldset = btn_clicked.parentNode;
    list_max = elementTracker.getAttribute("data-max-li");
    list_type = list_name.substring(0,2);
    list_item_name = list_name + '_li';
    all = document.body.querySelectorAll('.' + list_item_name).length;
    console.log('.' + list_item_name)
    if (all < list_max) {
        num = all + 1;
        individual_name = list_item_name + '_' + num;

        label = document.createElement('label');
        labelText = document.createTextNode('List Item ' + individual_name.substring(8,10));
        label.setAttribute('for', individual_name);
        label.classList.add('listItemLabel')
        label.appendChild(labelText)

        newListItemInput = document.createElement('input');
        newListItemInput.setAttribute('name', individual_name)
        newListItemInput.classList.add(list_item_name, individual_name, 'list_item', 'contentInput', 'createInput');
        btn_clicked.parentNode.insertBefore(label, btn_clicked)
        btn_clicked.parentNode.insertBefore(newListItemInput, btn_clicked)
        elementTracker.value += individual_name + ',';
        track_elements(individual_name, list_item_name);
    } else {
        create_form_notice('maxElement', 'Maximum number of list items for this list type reached', 'error');
    }
}

allContentTypeBtns.forEach(function(e) {
    e.addEventListener('click', function(e) {
        type_of_element(e.srcElement);
    });
})


elementOrder = [];
function track_elements(individual_name, group_name) {
    elementOrder.push(individual_name);
    console.log(elementOrder);
}


function type_of_element(contentBtnClicked, deleteElement = false, e = null) { // determines the type of element and calls the eqquivalent function

    if (deleteElement === false) {
        noHiddenElements = true
        contentType = contentBtnClicked.getAttribute('data-contentType');
        elementName = contentType + ','
        switch (contentType) {
            case 'p':
                all = document.body.querySelectorAll(".paragraph");
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    num = all.length + 1
                    individualName = 'p_' + num;
                    placeholder = 'Paragraph';
                    if (all.length < max_on_page) {
                        create_element('textarea', 'paragraph', 'Paragraph', individualName, 1)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of paragraphs reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + individualName + ',');
                }

                break;


            case 'h2':
                headingNum = contentType.substring(1,2);
                element_class = '.heading' + headingNum
                all = document.body.querySelectorAll(element_class);
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    amount_on_page = all.length + 1;
                    individualName = 'heading' + headingNum + '_'  + amount_on_page;
                    label_placeholder_name = 'Heading ' + headingNum
                    element_name = 'heading' + headingNum
                    if (all.length < max_on_page) {
                        create_element('text', element_name, label_placeholder_name, individualName, 2)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of headings reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                }
                break;


            case 'h3':
                headingNum = contentType.substring(1,2);
                element_class = '.heading' + headingNum
                all = document.body.querySelectorAll(element_class);
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    amount_on_page = all.length + 1;
                    individualName = 'heading' + headingNum + '_'  + amount_on_page;
                    label_placeholder_name = 'Heading ' + headingNum
                    element_name = 'heading' + headingNum
                    if (all.length < max_on_page) {
                        create_element('text', element_name, label_placeholder_name, individualName, 3)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of headings reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + elementName + ',');;
                }
                break;


            case 'h4':
                headingNum = contentType.substring(1,2);
                element_class = '.heading' + headingNum
                all = document.body.querySelectorAll(element_class);
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    amount_on_page = all.length + 1;
                    individualName = 'heading' + headingNum + '_'  + amount_on_page;
                    label_placeholder_name = 'Heading ' + headingNum
                    element_name = 'heading' + headingNum
                    if (all.length < max_on_page) {
                        create_element('text', element_name, label_placeholder_name, individualName, 4)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of headings reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                }
                break;


            case 'h5':
                headingNum = contentType.substring(1,2);
                element_class = '.heading' + headingNum
                all = document.body.querySelectorAll(element_class);
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    amount_on_page = all.length + 1;
                    individualName = 'heading' + headingNum + '_'  + amount_on_page;
                    label_placeholder_name = 'Heading ' + headingNum
                    element_name = 'heading' + headingNum
                    if (all.length < max_on_page) {
                        create_element('text', element_name, label_placeholder_name, individualName, 5)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of headings reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                }
                break;

            case 'hr':
                element_class = '.hr';
                all = document.body.querySelectorAll(element_class);
                all.forEach(function(thisElement) {
                    if (thisElement.classList.contains('hidden') && noHiddenElements === true) {
                        elementName = thisElement.getAttribute('name')

                        label = document.body.querySelector('label[for="' + elementName + '"]')
                        label.parentNode.removeChild(label)
                        newContentDiv.appendChild(label)
                        label.classList.remove('hidden')

                        thisElement.parentNode.removeChild(thisElement)
                        newContentDiv.appendChild(thisElement)
                        thisElement.classList.remove('hidden')

                        noHiddenElements = false;

                        c_elementTracker = elementTracker.getAttribute('value')
                        elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                    }
                })
                if (noHiddenElements === true) {
                    amount_on_page = all.length + 1;
                    individualName = 'hr' + '_'  + amount_on_page;
                    element_name = 'hr'
                    label_placeholder_name = 'none';
                    if (all.length < max_on_page) {
                        create_element('hr', element_name, label_placeholder_name, individualName, 6)
                    } else {
                        create_form_notice('maxElement', 'Maximum number of hr reached', 'error');
                    }
                    c_elementTracker = elementTracker.getAttribute('value')
                    elementTracker.setAttribute('value', c_elementTracker + elementName + ',');
                }
                break;


            case 'ul':
                listType = contentType.substring(0,1);
                element_type = listType + 'l'
                element_class = '.' + element_type
                all = document.body.querySelectorAll('.' + element_type);
                thisNum = all.length + 1;
                individualName = element_type + '_'  + thisNum;
                if (listType === 'u') {
                    label_placeholder_name = 'Unordered List '
                } else if (listType === 'o') {
                    label_placeholder_name = 'Ordered List '
                }
                if (all.length < max_list_elements) {
                    create_list('text', element_type, label_placeholder_name, individualName, 5);
                } else {
                    create_form_notice('maxElement', 'Maximum number of unordered lists reached', 'error');
                }
                break;

            case 'ol':
                listType = contentType.substring(0,1);
                element_type = listType + 'l'
                element_class = '.' +  element_type
                all = document.body.querySelectorAll('.' + element_type);
                thisNum = all.length + 1;
                individualName = element_type + '_'  + thisNum;
                if (listType === 'u') {
                    label_placeholder_name = 'Unordered List ';
                } else if (listType === 'o') {
                    label_placeholder_name = 'Ordered List ';
                }
                if (all.length < max_list_elements) {
                    create_list('text', element_type, label_placeholder_name, individualName, 5);
                } else {
                    create_form_notice('maxElement', 'Maximum number of ordered lists reached', 'error');
                }
                break;

            default:
                console.log('mistake ' + contentType);
                break;
        }
    } else if (deleteElement === true) {
        elementToDelete = document.querySelector('.' + contentBtnClicked) ;
        elementName = elementToDelete.getAttribute('name')
        label = document.body.querySelector('label[for="' + elementName + '"]')


        label.classList.add('hidden_elem', 'hidden')
        elementToDelete.classList.add('hidden_elem', 'hidden')
        elementToDelete.innerText = ''
        // e.classList.add('hidden_elem', 'hidden')
        et_c_value = elementTracker.getAttribute('value')
        if (et_c_value.includes(elementName)) {
            et_n_value = et_c_value.replace(elementName+',', '')
            elementTracker.setAttribute('value', et_n_value)
        }
        // e.classList.add('hidden_elem')
        // e.parentNode.removeChild(e)
        // elementToDelete.classList.add('hidden_elem')
        // elementToDelete.parentNode.removeChild(elementToDelete)
        // label.classList.add('hidden_elem')
        // label.parentNode.removeChild(label)
    }
}


my_count_of_files = 0;
imgs_btn = document.body.querySelector('#uploadImgBtn')
img_input = document.body.querySelector('#imgs');
img_box = document.body.querySelector('.imgBox');

function loadFile(e) {
    checkIfImgExists = document.body.querySelector('.showNewImg')
    if (checkIfImgExists == null) {
        new_img = document.createElement('img');
        new_img.src = URL.createObjectURL(e.target.files[0]);
        new_img.classList.add('showNewImg');
        if (article_name) {
            new_img.setAttribute('alt', article_name.value);
        }
        img_box.appendChild(new_img);
    } else {
        num = e.target.files.length - 1
        checkIfImgExists.src = URL.createObjectURL(e.target.files[num]);
    }
}

// ------------------------------------------------------------------------------------------------>
// popup contentTypeBtns
// ------------------------------------------------------------------------------------------------>

var allContentTypeListBtns = document.body.querySelectorAll(".contentTypeList > .contentTypeBtn");
let thisList;

allContentTypeListBtns.forEach(function(elem) {
    elem.addEventListener('click', function(elem) {
        popup_btn(elem.srcElement);
    });
})

function popup_btn(btn) {
    if (btn.innerText === 'Header') {
        thisList = document.body.querySelector(".headerContentTypes");
        btn.parentNode.classList.add("headerContentTypeList_show");
    } else if (btn.innerText === 'List') {
        thisList = document.body.querySelector(".listContentTypes");
        btn.parentNode.classList.add("listContentTypeList_show");
    }

    if (btn.parentNode.classList.contains("contentTypeList_show")) {
        btn.parentNode.classList.remove("contentTypeList_show");
        btn.parentNode.classList.remove("headerContentTypeList_show");
        thisList.classList.remove("showList");
        thisList.classList.add("hidden");
        imgs_notice.style.bottom = null;
    } else {
        btn.parentNode.classList.add("contentTypeList_show");
        btn.parentNode.classList.remove("headerContentTypeList_show");
        thisList.classList.add("showList");
        thisList.classList.remove("hidden");
        if (imgs_notice) {
            imgs_notice.style.bottom = '-4.2rem';
        }
    }

}

// ------------------------------------------------------------------------------------------------>
// link generator
// ------------------------------------------------------------------------------------------------>

linkGeneratorBtn = document.querySelector('.linkGeneratorBtn')
linkGenBox = document.querySelector('.linkGenBox')
linkGenCloseBtn = document.querySelector('.linkGenCloseBtn')
linkGenBtn = document.querySelector('.linkGenBtn')
linkGenOutput = document.querySelector('.linkGenOutput')
linkNameInput = document.querySelector('.linkName')
linkHrefInput = document.querySelector('.linkHref')
linkOutputText = document.querySelector('.linkOutputText')
linkOutputHref = document.querySelector('.linkOutputHref')
generatorInstructionsBox = document.querySelector('.generatorInstructions')
linkGenEmptyError = document.querySelector('.linkGenEmptyError')
linkNameSampleText = 'My Link'
linkHrefSampleText = 'https://www.mylink.com'


if (linkGeneratorBtn) {
    linkGeneratorBtn.addEventListener('click', function(){
        open_link_gen();
    })

    linkGenCloseBtn.addEventListener('click', function(){
        open_link_gen();
    })

    linkGenBtn.addEventListener('click', function(){
        generate_link();
    })

    linkNameInput.addEventListener('click', function(){
        if (linkNameInput.innerText === linkNameSampleText) {
            linkNameInput.innerText = '';
        }
    })

    // linkNameInput.addEventListener('keyup', function(){
    //     if (linkNameInput.innerText === '') {
    //         linkNameInput.innerText = linkNameSampleText;
    //     }
    // });

    linkHrefInput.addEventListener('click', function(){
        if (linkHrefInput.innerText === linkHrefSampleText) {
            linkHrefInput.innerText = '';
        }
    })

    // linkHrefInput.addEventListener('keyup', function(){
    //     if (linkHrefInput.innerText === '') {
    //         linkHrefInput.innerText = linkHrefSampleText;
    //     }
    // });

}

function open_link_gen() {
    if (linkGenBox.classList.contains('linkGenBox_show')) {
        linkGenBox.classList.remove('linkGenBox_show')
    } else {
        linkGenBox.classList.add('linkGenBox_show')
    }
}

function generate_link() {
    linkName = document.querySelector('.linkName').innerText
    linkHref = document.querySelector('.linkHref').innerText
    if (linkName.trim() === '' || linkHref.trim() === '') {
        console.log('empty');
        linkGenEmptyError.classList.remove('hidden')
        if (!generatorInstructionsBox.classList.contains('hidden')) {
            generatorInstructionsBox.classList.add('hidden')
        }
    } else {
        console.log('<a href="'+linkHref+'">'+linkName+'</a>');
        if (!linkGenEmptyError.classList.contains('hidden')) {
            linkGenEmptyError.classList.add('hidden')
        }
        generatorInstructionsBox.classList.remove('hidden')
        linkOutputText.innerText = linkName;
        linkOutputHref.innerText = linkHref;
        linkGenOutput.innerText = '<a href="'+linkHref+'">'+linkName+'</a>';
    }
}

// ------------------------------------------------------------------------------------------------>
// email preview page
// ------------------------------------------------------------------------------------------------>

emailMsg = document.body.querySelector('.emailMsg')
seeAllWarningBtn = document.body.querySelector('.seeAllWarningBtn')
leaveWarning = document.body.querySelector('.leaveWarning')
noLeave = document.body.querySelector('.noLeave')

if (emailMsg) {
    editedMsg = emailMsg.outerHTML;
    editedMsg = editedMsg.replace(new RegExp('&lt;br&gt;', 'gi'), '</p><p class="emailMsg">');
    emailMsg.outerHTML = editedMsg
    start = editedMsg.search('&lt;a href=') + 13;
    end = editedMsg.search('"&gt;')
}

if (seeAllWarningBtn) {
    seeAllWarningBtn.addEventListener('click', function() {
        leaveWarning.classList.remove('hidden');
    })

    noLeave.addEventListener('click', function() {
        hideLeaveWarning();
    })
}

function hideLeaveWarning() {
    if (!leaveWarning.classList.contains('hidden')) {
        leaveWarning.classList.add('hidden');
    }
}


// ------------------------------------------------------------------------------------------------>
// Run On Load
// ------------------------------------------------------------------------------------------------>

activate_list_btns();












