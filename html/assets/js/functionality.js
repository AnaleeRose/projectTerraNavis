const body=document.body.querySelector("article");body.classList.add("js-enabled");const faqPage=document.body.querySelector(".faqPage"),newsPage=document.body.querySelector(".newsPage"),multiContentPage=document.body.querySelector(".multiContentPage"),contactPage=document.body.querySelector(".contactPage"),resourcesPage=document.body.querySelector(".resourcesPage"),homeMainContent=document.body.querySelector(".homeMainContent"),emailError=document.body.querySelector(".emailError"),bpaInfoBtn=document.body.querySelector("#bpaChapterInfo-container"),intialCheckedJoinChoice=document.body.querySelector(".cf_joinChoice-input:checked ~ span"),c_msg=document.body.querySelector("#c_msg"),characterCounter=document.body.querySelector("#characterCounter"),cursor=document.body.querySelector("#cursor"),allSubheadings=document.body.querySelectorAll(".subheading"),allArticles=document.body.querySelectorAll(".indiArticle"),allJoinChoices=document.body.querySelectorAll(".cf_joinChoice-input"),allJoinText=document.body.querySelectorAll(".cf_joinChoice-text"),allJoinCustomBtns=document.body.querySelectorAll(".customRadioBtn"),characterLimit=1200;let last_scroll_pos=0;if(emailError&&window.scrollTo(0,document.body.scrollHeight),cursor&&(intialize_cursor(),fix_sizing()),bpaInfoBtn.addEventListener("click",function(){let e=document.body.querySelector(".bpa-arrow");document.body.querySelector("#bpaChapterInfo-content").classList.toggle("bpaChapterInfo-content_open"),e.classList.toggle("bpa-arrow_turned"),setTimeout(function(){window.scrollTo(0,document.body.scrollHeight)},200)}),newsPage){document.body.querySelector("#dateSelect");const e=document.body.querySelector("#filterBtn"),t=document.body.querySelector(".filter-container");e.addEventListener("click",function(){t.classList.contains("filter-container_open")?t.classList.remove("filter-container_open"):t.classList.add("filter-container_open")}),setTimeout(function(){intialize_article_animation()},250)}if(faqPage){document.body.querySelectorAll(".mainSection-container");document.body.querySelectorAll(".faqHeadingArrow-container").forEach(function(e){e.addEventListener("click",function(){faq_collapse(e)})})}if(contactPage){if(characterCounter){characterCounter.innerHTML='Characters Remaining: <span id="cc_currentNum">'+characterLimit+"</span>";document.body.querySelector("#cc_currentNum");c_msg.addEventListener("keydown",function(e){update_character_count(e)})}allJoinCustomBtns.forEach(function(e){e.addEventListener("click",function(){update_contact_input(e)})}),allJoinText.forEach(function(e){e.addEventListener("click",function(){update_contact_input(e.previousElementSibling)})}),window.onload=update_contact_input(intialCheckedJoinChoice)}function intialize_cursor(){window.addEventListener("scroll",function(){check_for_cursor()}),window.addEventListener("resize",function(){fix_sizing()}),subheadingsContainer=document.createElement("div"),subheadingsContainer.classList.add("interactiveSubheadings-container"),subheadingsHeader=document.createElement("p"),subheadingsHeader.classList.add("interactiveSubheadings-heading"),subtext=document.createTextNode("Subheadings"),subheadingsHeader.append(subtext),subheadingsContainer.append(subheadingsHeader),allSubheadings.forEach(function(e){let t=document.createElement("p");t.classList.add("interactiveSubheading");let n=e.innerText;t.append(n),t.setAttribute("data-subheading",e.getAttribute("data-subheading")),t.addEventListener("click",function(){run_cursor(e,!0)}),subheadingsContainer.append(t)}),body.append(subheadingsContainer),cursor.addEventListener("click",function(){toggle_subheadingMenu()})}function intialize_article_animation(){let e,t,n=1,o=!0,i=[],c=[],a=[];allArticles.forEach(function(a){a.offsetTop-e>50&&(console.log("run"),animate_articles(i),c.push(i),i=[]),i.push(a),e=a.offsetTop,t=a,!0===o&&(o=!1,n=1e3)}),c.includes(t)||(allArticles.forEach(function(e){offset=e.offsetTop,diff(t.offsetTop,offset)<50&&a.push(e)}),animate_articles(a))}function diff(e,t){return e>t?e-t:t-e}function fix_sizing(){window.innerWidth>1450?subheadingsContainer.style.left="5vw":window.innerWidth<1200&&body.classList.contains("mainContent_subOpen")&&body.classList.remove("mainContent_subOpen")}function is_in_viewport(e){let t,n,o=e.getBoundingClientRect();return multiContentPage?(t=100,n=resourcesPage&&window.pageYOffset>.4*document.body.scrollHeight?window.devicePixelRatio<=1?850:750:500):homeMainContent?window.devicePixelRatio<=1?(t=80,n=420):(t=100,n=700):(t=0,n=0),o.top>=t&&o.top<=n&&o.left>=0&&o.bottom<=(window.innerHeight||document.documentElement.clientHeight)&&o.right<=(window.innerWidth||document.documentElement.clientWidth)}function animate_articles(e){e.forEach(function(e){e.classList.add("indiArticle-animate")})}function toggle_subheadingMenu(){body.classList.contains("mainContent_subOpen")?body.classList.remove("mainContent_subOpen"):body.classList.add("mainContent_subOpen")}function faq_collapse(e){sectionNum=e.getAttribute("data-value"),sectionName="#mainSection-"+sectionNum;let t=document.querySelector(".faq_open"),n=document.body.querySelector(sectionName),o=document.body.querySelector(sectionName+" .mainSection-content"),i=document.querySelector(".faq_open .mainSection-content");if(t&&(t.classList.remove("faq_open"),i.style.height=null),t!==n){n.classList.add("faq_open");let e=document.querySelectorAll(sectionName+" .mainSection-content *:not(li)"),t=0;e.forEach(function(e){t+=e.clientHeight}),o.style.height=t+20+"px"}}function check_for_cursor(){let e;if((e=window.pageYOffset>last_scroll_pos?window.pageYOffset-last_scroll_pos:last_scroll_pos-window.pageYOffset)>25){let e=[];allSubheadings.forEach(function(t){is_in_viewport(t)&&e.push(t)}),window.pageYOffset>last_scroll_pos?newSub=e[e.length-1]:newSub=e[0],newSub&&run_cursor(newSub)}last_scroll_pos=window.pageYOffset}function run_cursor(e,t=!1){console.log("run");let n,o=e;n=o.parentElement.offsetTop+44,cursor.style.top=n,subheadingsContainer.setAttribute("style","top: "+(n+85)+"px"),!0===t&&(newSubheading_num=o.getAttribute("data-subheading"),go_to="#mainSection-"+newSubheading_num,subheading=document.body.querySelector(go_to),homeMainContent?window.scrollTo(0,subheading.offsetTop+750):window.scrollTo(0,subheading.offsetTop))}function update_contact_input(e){let t=e.getAttribute("data-value"),n=document.body.querySelector('.cf_joinChoice-input[value="'+t+'"]'),o=document.body.querySelector('.cf_joinChoice-input[value="'+t+'"] ~ p');allJoinCustomBtns.forEach(function(e){e.classList.contains("checkedCustomRadioBtn")&&e.classList.remove("checkedCustomRadioBtn")}),allJoinText.forEach(function(e){e.style.color="inherit"}),o.style.color="var(--pageColor)",e.classList.add("checkedCustomRadioBtn"),n.checked=!0}function update_character_count(e){let t=e.srcElement.value.length,n=characterLimit-t;cc_currentNum.innerHTML=n}