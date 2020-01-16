//============================================================>
// global variables ============================================================>
    // mostly used to check what page we're on, also holds variables used through the doc
//============================================================>

const body = document.body.querySelector('article')
body.classList.add("js-enabled")

const faqPage = document.body.querySelector('.faqPage')
const newsPage = document.body.querySelector('.newsPage')
const multiContentPage = document.body.querySelector(".multiContentPage");
const contactPage = document.body.querySelector(".contactPage");
const resourcesPage = document.body.querySelector(".resourcesPage");
const homeMainContent = document.body.querySelector(".homeMainContent");
const emailError = document.body.querySelector('.emailError');
const bpaInfoBtn = document.body.querySelector('#bpaChapterInfo-container');
const intialCheckedJoinChoice = document.body.querySelector('.cf_joinChoice-input:checked ~ span')
const c_msg = document.body.querySelector("#c_msg");
const characterCounter = document.body.querySelector("#characterCounter");
const cursor = document.body.querySelector('#cursor');

const allSubheadings = document.body.querySelectorAll(".subheading");
const allArticles = document.body.querySelectorAll(".indiArticle");
const allJoinChoices = document.body.querySelectorAll('.cf_joinChoice-input')
const allJoinText = document.body.querySelectorAll('.cf_joinChoice-text')
const allJoinCustomBtns = document.body.querySelectorAll('.customRadioBtn');

const characterLimit = 1200
let last_scroll_pos = 0;

// `END variables ============================================================>



//============================================================>
// intialization + specific page work ============================================================>
//============================================================>
if (emailError) {
    window.scrollTo(0,document.body.scrollHeight);
}

if (cursor) {
    intialize_cursor();
    fix_sizing();
}

bpaInfoBtn.addEventListener('click', function() {
    let bpaArrow = document.body.querySelector('.bpa-arrow');
    let bpaInfoContent = document.body.querySelector('#bpaChapterInfo-content');
    bpaInfoContent.classList.toggle("bpaChapterInfo-content_open")
    bpaArrow.classList.toggle("bpa-arrow_turned")
    setTimeout (function(){
        window.scrollTo(0,document.body.scrollHeight);
    }, 200)
})

if (newsPage) {
    const dateSelect = document.body.querySelector("#dateSelect");
    const filterBtn = document.body.querySelector("#filterBtn")
    const filterContainer = document.body.querySelector(".filter-container")
    filterBtn.addEventListener('click', function(){
        if (filterContainer.classList.contains("filter-container_open")) {
            filterContainer.classList.remove("filter-container_open")
        } else {
            filterContainer.classList.add("filter-container_open")
        }
    })

    setTimeout(function(){
        intialize_article_animation();
    }, 250)
}



if (faqPage) {
    const allFaqSections = document.body.querySelectorAll('.mainSection-container')
    const allFaqQuestions = document.body.querySelectorAll('.faqHeadingArrow-container')
    allFaqQuestions.forEach(function(e){
        e.addEventListener('click', function() {
            faq_collapse(e);
        })
    })
}

if (contactPage) {
    if (characterCounter) {
        characterCounter.innerHTML = "Characters Remaining: <span id=\"cc_currentNum\">" + characterLimit + "</span>";
        let cc_currentNum = document.body.querySelector("#cc_currentNum");
        c_msg.addEventListener('keydown', function(e) {
            update_character_count(e)
        })
    }

    allJoinCustomBtns.forEach(function(e){
        e.addEventListener('click', function(){
            update_contact_input(e);
        })
    })

    allJoinText.forEach(function(e) {
        e.addEventListener('click', function() {
            update_contact_input(e.previousElementSibling);
        })
    })

    window.onload = update_contact_input(intialCheckedJoinChoice);
}


//===========================================>
//============================================================>
// FUNCTIONS ============================================================>
//============================================================>
//===========================================>

//============================================================>
// intialization functions ============================================================>
//============================================================>

function intialize_cursor() {
    window.addEventListener('scroll', function() {
        check_for_cursor();
    })

    window.addEventListener('resize', function() {
        fix_sizing();
    })
    subheadingsContainer = document.createElement('div')
    subheadingsContainer.classList.add("interactiveSubheadings-container")

    subheadingsHeader = document.createElement('p')
    subheadingsHeader.classList.add("interactiveSubheadings-heading")
    subtext = document.createTextNode("Subheadings")
    subheadingsHeader.append(subtext)
    subheadingsContainer.append(subheadingsHeader)

    allSubheadings.forEach(function(e){
        let newText = document.createElement('p')
        newText.classList.add('interactiveSubheading')
        let textNode = e.innerText
        newText.append(textNode)
        newText.setAttribute('data-subheading', e.getAttribute('data-subheading'))
        newText.addEventListener('click', function() {
            run_cursor(e, true)
        });
        subheadingsContainer.append(newText)
    })

    body.append(subheadingsContainer)


    cursor.addEventListener('click', function(){
        toggle_subheadingMenu();
    })
}

function intialize_article_animation() {
    let prev_top, lowest_top, timeout = 1, first = true, c_list = [], all_list = [], altC_list = [];
    allArticles.forEach(function(e){
        if ((e.offsetTop - prev_top) > 50) {
            console.log("run")
            // setTimeout(function(){
            //     animate_articles(c_list)
            //     all_list.push(c_list);
            //     c_list = [];
            // }, timeout)
                animate_articles(c_list)
                all_list.push(c_list);
                c_list = [];
        }
        c_list.push(e);
        prev_top = e.offsetTop;
        lowest_top = e;
        if (first === true) {
            first = false;
            timeout = 1000
        }
    })

    if (!(all_list.includes(lowest_top))) {
        allArticles.forEach(function(e){
            offset = e.offsetTop;
            if (diff(lowest_top.offsetTop, offset) < 50) {
                altC_list.push(e);
            }
        })
        animate_articles(altC_list)
    } 
}


//============================================================>
// general use functions ============================================================>
//============================================================>



function diff(num1, num2) {
  if (num1 > num2) {
    return num1 - num2
  } else {
    return num2 - num1
  }
}

function fix_sizing() {
    if (window.innerWidth > 1450) {
        subheadingsContainer.style.left = "5vw"
    } else if (window.innerWidth < 1200 && body.classList.contains("mainContent_subOpen")) {
        body.classList.remove("mainContent_subOpen")
    }
}

function is_in_viewport(e) {
    let bounding = e.getBoundingClientRect()
    let top_1, top_2;
    if (multiContentPage) {
            top_1 = 100
        if (resourcesPage && (window.pageYOffset > (document.body.scrollHeight * .4))) {
            if (window.devicePixelRatio <= 1) {
                top_2 = 850
            } else {
                top_2 = 750
            }
        } else {
            top_2 = 500
        }
    } else if (homeMainContent) {
        if (window.devicePixelRatio <= 1) {
            top_1 = 80
            top_2 = 420
        } else {
            top_1 = 100
            top_2 = 700
        }
    } else {
        top_1 = 0
        top_2 = 0
    }

    return (
        bounding.top >= top_1 &&
        bounding.top <= top_2 &&
        bounding.left >= 0 &&
        bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        bounding.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
}

//============================================================>
// on use functions ============================================================>
//============================================================>

function animate_articles(array) {
    array.forEach(function(article){
        article.classList.add("indiArticle-animate")
    })
}

function toggle_subheadingMenu() {
    if (body.classList.contains("mainContent_subOpen")) {
        body.classList.remove("mainContent_subOpen")
    } else {
        body.classList.add("mainContent_subOpen")
    } 
}


function faq_collapse(e) {
    sectionNum = e.getAttribute("data-value");
    sectionName = "#mainSection-" + sectionNum;
    let c_openSection = document.querySelector(".faq_open")
    let openSection = document.body.querySelector(sectionName)
    let c_openSectionContent  = document.querySelector(sectionName + " .mainSection-content")

    if (c_openSection) {
        c_openSection.classList.remove("faq_open");
    }
    if (c_openSection !== openSection) {
        openSection.classList.add("faq_open")
    }
}

function check_for_cursor() {
    let diff, pixel_diff;
    if (window.pageYOffset > last_scroll_pos) {
        diff = window.pageYOffset - last_scroll_pos
    } else {
        diff = last_scroll_pos - window.pageYOffset
    }
    if (diff > 25) {
        // console.log("pd: " + pixel_diff)
        let temp = [];
        allSubheadings.forEach(function(e){
            if (is_in_viewport(e)) {
                temp.push(e)
            }
        })
        if (window.pageYOffset > last_scroll_pos) {
            // going down
            newSub = temp[temp.length - 1]
        } else {
            // going up
            newSub = temp[0]
        }

        if (newSub) {
            run_cursor(newSub)
        }
    }

    last_scroll_pos = window.pageYOffset;
}


function run_cursor(e, clicked = false) {
    let newSubheading = e, topOffset;
    // if (screen.width > 1199) {
    //     if (homeMainContent) {
    //         if (window.devicePixelRatio > 1) {
    //             topOffset = newSubheading.parentElement.offsetTop - 965
    //         } else {
    //             topOffset = newSubheading.parentElement.offsetTop - (screen.width * .5035)
    //         }
    //         // topOffset = newSubheading.parentElement.offsetTop - (screen.width * .2516)
    //         // topOffset = newSubheading.parentElement.offsetTop - 590
    //     } else {
    //         topOffset = newSubheading.parentElement.offsetTop - 45
    //     }
    // } else {
    //     topOffset = newSubheading.parentElement.offsetTop - 167
    // }

    topOffset = newSubheading.parentElement.offsetTop + 44
    cursor.style.top = topOffset
    subheadingsContainer.style.top = topOffset + 85
    if (clicked === true) {
        newSubheading_num = newSubheading.getAttribute("data-subheading");
        go_to = "#mainSection-" + newSubheading_num;
        subheading = document.body.querySelector(go_to)

        if (homeMainContent) {
            window.scrollTo(0, subheading.offsetTop + 750)
        } else {
            window.scrollTo(0, subheading.offsetTop)
        }
    }
}


function update_contact_input(e) {
    let value = e.getAttribute("data-value")
    let checkedJoinChoice = document.body.querySelector('.cf_joinChoice-input[value="' + value + '"]')
    let checkedJoinChoice_text = document.body.querySelector('.cf_joinChoice-input[value="' + value + '"] ~ p')
    allJoinCustomBtns.forEach(function(e) {
        if (e.classList.contains("checkedCustomRadioBtn")) {
            e.classList.remove("checkedCustomRadioBtn")
        }
    })

    allJoinText.forEach(function(e) {
        e.style.color = 'inherit';
    })
    checkedJoinChoice_text.style.color = "var(--pageColor)";
    e.classList.add("checkedCustomRadioBtn")
    checkedJoinChoice.checked = true;
}

function update_character_count(e) {
    let textarea = e.srcElement
    let c_length = textarea.value.length
    let c_limit =  characterLimit - c_length
    cc_currentNum.innerHTML = c_limit;
}


