// Select the header element
var header = document.querySelector(".header");
var profileCard = document.querySelector(".profile-card");
var profileCard2 = document.querySelector(".profile-card2");

// Add a scroll event listener to the window
window.addEventListener("scroll", function () {
    // Get the vertical scroll position
    var scrollPosition = window.scrollY || window.pageYOffset;

    // Check if the scroll position is greater than a certain threshold
    if (scrollPosition > 200) {
        // If the scroll position is greater than 100 pixels, fix the header position and change its style
        if (header.style.position !== "fixed") {
            header.style.transition =
                "transform 0.3s ease-in-out, opacity 0.3s ease-in-out";
            header.style.transform = "translateY(-100%)";
            header.style.opacity = "0";
            setTimeout(function () {
                header.style.position = "fixed";
                header.style.transform = "translateY(0)";
                header.style.opacity = "0.7";
            }, 100);
        }
    } else {
        // If the scroll position is less than 100 pixels, revert the header style
        if (header.style.position !== "relative") {
            header.style.transition =
                "transform 0.3s ease-in-out, opacity 0.3s ease-in-out";
            header.style.transform = "translateY(-100%)";
            header.style.opacity = "0";
            setTimeout(function () {
                header.style.position = "relative";
                header.style.transform = "translateY(0)";
                header.style.opacity = "1";
            }, 100);
        }
    }
    if (window.innerWidth >= 1024) {
        if (scrollPosition > 350) {
            profileCard.style.position = "fixed";
            profileCard.style.top = "10%";
            profileCard.style.width = "28.7%";

            profileCard2.style.position = "fixed";
            profileCard2.style.top = "21%";
            profileCard2.style.width = "28.7%";
        } else {
            profileCard.style.position = "relative";
            profileCard.style.top = "";
            profileCard.style.width = "100%";

            profileCard2.style.position = "relative";
            profileCard2.style.top = "";
            profileCard2.style.width = "100%";
        }
    }
});
