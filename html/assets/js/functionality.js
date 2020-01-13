const faqPage = document.body.querySelector('.faqPage')
const newsPage = document.body.querySelector('.newsPage')
const bpaInfoBtn = document.body.querySelector('#bpaChapterInfo-container');
const emailError = document.body.querySelector('.emailError');

if (emailError) {
    window.scrollTo(0,document.body.scrollHeight);
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
        console.log("wasp")
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
    c_openSection.classList.remove("faq_open");
    let openSection = document.body.querySelector(sectionName)
    let c_openSectionContent  = document.querySelector(sectionName + " .mainSection-content")
    openSection.classList.add("faq_open")
}
