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
const headerImgContainer = document.body.querySelector('.headerImg-container');
const eShip = document.body.querySelector(".eShip")
const mainFooter = document.querySelector(".mainFooter")
const navBars = document.querySelector(".navBars")
const mainNav = document.querySelector(".mainNav")
const init_width = getWidth();

const allHeaderImgPieces = document.body.querySelectorAll('[data-hoverable="true"]');
const allSubheadings = document.body.querySelectorAll(".subheading");
const allArticles = document.body.querySelectorAll(".indiArticle");
const allJoinChoices = document.body.querySelectorAll('.cf_joinChoice-input')
const allJoinText = document.body.querySelectorAll('.cf_joinChoice-text')
const allJoinCustomBtns = document.body.querySelectorAll('.customRadioBtn');
const allTBoxes = document.body.querySelectorAll(".headerImg-textBox")

const characterLimit = 1200
let last_scroll_pos = 0, tBox_container, turbines_Y_offset;
let page_c_width = document.body.clientWidth;

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

if (document.body.querySelector(".noArticles_error") && window.innerWidth ) {
    console.log("error!")
    if (document.body.clientHeight < window.outerHeight && document.body.clientWidth > 750) {
        mainFooter.style.bottom = "0"
        mainFooter.style.position = "fixed"
        mainFooter.style.width = "100vw"
    } else {
        if (mainFooter.style.position = "fixed") {
            mainFooter.style.bottom = "0"
            mainFooter.style.position = null
            mainFooter.style.width = "100vw"
        }
    }
}

if (navBars) {
    navBars.addEventListener("click", function(){
        if (mainNav.classList.contains("mainNav-visible")) {
            mainNav.classList.remove("mainNav-visible")
        } else {
            mainNav.classList.add("mainNav-visible")
        }
    })
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

if (headerImgContainer) {
    allHeaderImgPieces.forEach(function(e) {
        e.addEventListener('mouseover', function(){
            if (!e.classList.contains("eShip")) {
                headerImgContainer.classList.add("headerImg-container_hover")
                e.classList.add("headerImg-indi_hover")
            }
        })
    })
    allHeaderImgPieces.forEach(function(e) {
        e.addEventListener('mouseleave', function(){
            if (e.classList.contains("headerImg-indi_hover") && !e.classList.contains("eShip")) {
                headerImgContainer.classList.remove("headerImg-container_hover")
                e.classList.remove("headerImg-indi_hover")
            }
        })
    })

    allTBoxes.forEach(function(e) {
        e.addEventListener('mouseover', function(){
            tBox_container = e.parentElement
            tBox_container.childNodes.forEach(function(c){
                if (c != e && c.clientHeight) {
                    c.classList.add("headerImg-indi_hover")
                }
            })
            if (!tBox_container.classList.contains("headerImg-container_hover")) {
                headerImgContainer.classList.add("headerImg-container_hover")
                e.classList.add("headerImg-indi_hover")
            }
        })
    })

    eShip.addEventListener('mousemove', function(e){
        tBox_container = document.body.querySelector(".turbines")
        if (window.innerWidth < 1400) {
            turbines_Y_offset = e.srcElement.clientHeight*.785
        } else {
            turbines_Y_offset = e.srcElement.clientHeight*.7
        }
        if (e.clientX < (e.srcElement.clientWidth/1.9)
            && e.clientX > 200
            && e.clientY < turbines_Y_offset) {
            headerImgContainer.classList.add("headerImg-container_hover")
            tBox_container.classList.add("headerImg-indi_hover")
        } else {
            headerImgContainer.classList.remove("headerImg-container_hover")
            if (tBox_container.classList.contains("headerImg-indi_hover")) {
                tBox_container.classList.remove("headerImg-indi_hover")
            }

        }
    })

    eShip.addEventListener('mouseout', function(e){
        tBox_container = document.body.querySelector(".turbines")
        tBox_container.classList.remove("headerImg-indi_hover")
        headerImgContainer.classList.remove("headerImg-container_hover")
    })

    init_tBoxes();
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
    cursor.style.left = "4vw"
    window.addEventListener('scroll', function() {
        check_for_cursor();
    })

    window.addEventListener('resize', function() {
        fix_sizing();
        if (homeMainContent && (diff(init_width, getWidth()) > 200) && document.body.clientWidth >= 1200)  {
            location.reload();
        }
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

function getWidth() {
  if (self.innerWidth) {
    return self.innerWidth;
  }

  if (document.documentElement && document.documentElement.clientWidth) {
    return document.documentElement.clientWidth;
  }

  if (document.body) {
    return document.body.clientWidth;
  }
}

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
                top_2 = 750
            } else {
                top_2 = 650
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

        cursor.style.left = "4vw";
        body.classList.remove("mainContent_subOpen")
    } else {
        if (window.innerWidth < 1400) {
            cursor.style.left = "2vw";
        } else if (window.innerWidth < 1600) {
            cursor.style.left = "2.35vw";
        } else if (window.innerWidth < 1950) {
            cursor.style.left = "2.8vw";
        } else {
            cursor.style.left = "3vw";
        }
        body.classList.add("mainContent_subOpen")
    }
}


function faq_collapse(e) {
    sectionNum = e.getAttribute("data-value");
    sectionName = "#mainSection-" + sectionNum;
    let c_openSection = document.querySelector(".faq_open")
    let openSection = document.body.querySelector(sectionName)
    let openSectionContent = document.body.querySelector(sectionName + " .mainSection-content")
    let c_openSectionContent  = document.querySelector(".faq_open .mainSection-content")

    if (c_openSection) {
        c_openSection.classList.remove("faq_open");
        c_openSectionContent.style.height = null;
    }

    if (c_openSection !== openSection) {
        openSection.classList.add("faq_open")
        let allOpenSectionContent  = document.querySelectorAll(sectionName + " .mainSection-content *:not(li)")
        let totalHeight = 0;
        allOpenSectionContent.forEach(function(e){
            totalHeight = totalHeight + e.clientHeight
        })
        openSectionContent.style.height = (totalHeight + 20) + "px";

    }
}

function init_tBoxes() {
    allTBoxes.forEach(function(e){
        let allTBoxesContent  = e.childNodes
        let t_height = 0

        allTBoxesContent.forEach(function(e){
            if (e.offsetHeight) {
                t_height += e.offsetHeight
                e.setAttribute("style", "height: " + e.offsetHeight + "px;width: " + e_width + "px;");
            }
        })

        e.classList.add("headerImg-textBox_prepped")
        e.setAttribute("style", "height: " + (t_height + 45) + "px;transition: width .3s;");
    })
}

function check_for_cursor() {
    console.log("run")
    let diff, pixel_diff, newSub = false;
    if (window.pageYOffset > last_scroll_pos) {
        diff = window.pageYOffset - last_scroll_pos
    } else {
        diff = last_scroll_pos - window.pageYOffset
    }
    if (diff > 15) {
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
    topOffset = newSubheading.parentElement.offsetTop + 44
    cursor.style.top = topOffset
    subheadingsContainer.setAttribute("style", "top: " + (topOffset + 130) + "px")
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
    checkedJoinChoice_text.style.color = "var(--pageColor-link)";
    e.classList.add("checkedCustomRadioBtn")
    checkedJoinChoice.checked = true;
}

function update_character_count(e) {
    let textarea = e.srcElement
    let c_length = textarea.value.length
    let c_limit =  characterLimit - c_length
    cc_currentNum.innerHTML = c_limit;
}


