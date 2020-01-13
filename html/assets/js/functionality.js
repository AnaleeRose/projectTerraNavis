const faqPage = document.body.querySelector('.faqPage')

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
