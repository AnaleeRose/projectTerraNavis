console.log("animations.js is active")

const navBars = document.body.querySelector("#navBars")
const mainNav = document.body.querySelector("#mainNav")


function toggleMenu(e) {
	console.log(e.srcElement)
	if (!mainNav.classList.contains("mainNav-visible")) {
		mainNav.classList.add("mainNav-visible");
		navBars.classList.add("navBars-open")
	} else {
		mainNav.classList.remove("mainNav-visible");
		navBars.classList.remove("navBars-open")
	}
	
}

navBars.addEventListener('click', function(e){
	toggleMenu(e)
})