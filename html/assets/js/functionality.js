const body = document.body.querySelector('article')
const faqPage = document.body.querySelector('.faqPage')
const newsPage = document.body.querySelector('.newsPage')
const multiContentPage = document.body.querySelector(".multiContentPage");
const homeMainContent = document.body.querySelector(".homeMainContent");
const emailError = document.body.querySelector('.emailError');
const cursor = document.body.querySelector('#cursor');
const bpaInfoBtn = document.body.querySelector('#bpaChapterInfo-container');
const allSubheadings = document.body.querySelectorAll(".subheading");
let last_scroll_pos = 0;


if (emailError) {
    window.scrollTo(0,document.body.scrollHeight);
}

if (cursor) {
    intialize_subheadings();
    // intialize_cursor();
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

function intialize_subheadings() {
    window.addEventListener('scroll', function() {
        check_bounding();
    })
    subheadingsContainer = document.createElement('div')
    subheadingsContainer.classList.add("interactiveSubheadings-container")
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
}

function diff(num1, num2) {
  if (num1 > num2) {
    return num1 - num2
  } else {
    return num2 - num1
  }
}

function check_bounding() {
    let diff;
    if (window.pageYOffse > last_scroll_pos) {
        diff = window.pageYOffset - last_scroll_pos
    } else {
        diff = last_scroll_pos - window.pageYOffset
    }
    if (diff > (.015 * screen.height)) {
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

function is_in_viewport(e) {
    let bounding = e.getBoundingClientRect()
    let top_1, top_2;
    if (multiContentPage) {
        top_1 = 100
        top_2 = 500
    } else if (homeMainContent) {
        top_1 = 80
        top_2 = 420
    } else {
        top_1 = 0
        top_2 = 0
    }

    // console.log(window.pageYOffset)
    return (
        bounding.top >= top_1 &&
        bounding.top <= top_2 &&
        bounding.left >= 0 &&
        bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        bounding.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
}

// function intialize_cursor() {
//     console.log("Cursor is active");
// }

function run_cursor(e, clicked = false) {
    let newSubheading = e, topOffset;
    console.log(newSubheading.parentElement)
    if (screen.width > 1199) {
        if (homeMainContent) {
            // topOffset = newSubheading.parentElement.offsetTop - 965
            topOffset = newSubheading.parentElement.offsetTop - (screen.width * .5035)
            // topOffset = newSubheading.parentElement.offsetTop - 590
        } else {
            topOffset = newSubheading.parentElement.offsetTop - 45
        }
    } else {
        topOffset = newSubheading.parentElement.offsetTop - 167
    }

    cursor.style.top = topOffset

    console.log(topOffset)
    if (clicked === true) {
        window.scrollTo(0, newSubheading.parentElement.offsetTop)
    }
}


