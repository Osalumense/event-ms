/* DESCRIPTION: CUSTOM JS FILE */

const { AOS } = require("./aos");

/* NAVIGATION*/
// COLLAPSE THE NAVBAR BY ADDING THE TOP-NAV-COLLAPSE CLASS

(function() {
window.onscroll = function () {
	scrollFunction();
	// scrollFunctionBTT(); // back to top button
};

function scrollFunction() {
	let intViewportWidth = window.innerWidth;
	if (
		document.body.scrollTop > 30 ||
		(document.documentElement.scrollTop > 30) & (intViewportWidth > 991)
	) {
		document.getElementById("navbar").classList.add("top-nav-collapse");
	} else if (
		document.body.scrollTop < 30 ||
		(document.documentElement.scrollTop < 30) & (intViewportWidth > 991)
	) {
		document.getElementById("navbar").classList.remove("top-nav-collapse");
	}
}

// NAVBAR ON MOBILE
const showMenu = () => {
    document.querySelector("#navbar").classList.toggle("hidden");
//     let elements = document.querySelector(".offcanvas-collapse");

//     for (let i = 0; i < elements.length; i++) {
//         elements[i].addEventListener("click", () => {
//             document.querySelector(".offcanvas-collapse").classList.toggle("open");
//         });
//     }
}
// 
// document.querySelector(".navbar-toggler").addEventListener("click", () => {
//   document.querySelector(".offcanvas-collapse").classList.toggle("open");
// });

// HOVER ON DESKTOP
// function toggleDropdown(e) {
//     const _d = e.target.closest(".dropdown");
//     let _m = document.querySelector(".dropdown-menu", _d);

//     setTimeout(
//         function () {
//         const shouldOpen = _d.matches(":hover");
//         _m.classList.toggle("show", shouldOpen);
//         _d.classList.toggle("show", shouldOpen);

//         _d.setAttribute("aria-expanded", shouldOpen);
//         },
//         e.type === "mouseleave" ? 300 : 0
//     );
// }

// ON HOVER
const dropdownCheck = document.querySelector(".dropdown");

if (dropdownCheck !== null) {
    document
        .querySelector(".dropdown")
        .addEventListener("mouseleave", toggleDropdown);
    document
        .querySelector(".dropdown")
        .addEventListener("mouseover", toggleDropdown);

    // ON CLICK
    document.querySelector(".dropdown").addEventListener("click", (e) => {
        const _d = e.target.closest(".dropdown");
        let _m = document.querySelector(".dropdown-menu", _d);
        if (_d.classList.contains("show")) {
            _m.classList.remove("show");
            _d.classList.remove("show");
        } else {
            _m.classList.add("show");
            _d.classList.add("show");
        }
    });
}


/* BACK TO TOP BUTTON */
// GET THE BUTTON
// let myButton = document.getElementById("myBtn");

// // WHEN THE USER SCROLLS DOWN 20PX FROM THE TOP OF THE DOCUMENT, SHOW THE BUTTON
// function scrollFunctionBTT() {
//     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//         // myButton.style.display = "block";
//         $(myButton).show();
//     } 
//     $(myButton).hide();
//     // else {
//     //     myButton.style.display = "none";
//     // }
// }


// WHEN THE USER CLICKS ON THE BUTTON, SCROLL TO THE TOP OF THE DOCUMENT
function topFunction() {
    document.body.scrollTop = 0; // for Safari
    document.documentElement.scrollTop = 0; // for Chrome, Firefox, IE and Opera
}

