const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 30) {
        header.classList.add('appear');
    } else {
        header.classList.remove('appear');
    }
})


document.addEventListener('DOMContentLoaded', function () {
    const openModalButton = document.querySelector('.header-service-btn');
    const modalContainer = document.querySelector('.explore-items-container');

    openModalButton.addEventListener('click', function () {
        modalContainer.classList.toggle('show');
    });

    // Close modal if clicked outside of it
    document.addEventListener('click', function (event) {
        if (!modalContainer.contains(event.target) &&
            !openModalButton.contains(event.target)) {
            modalContainer.classList.remove('show');

        }
    });
});

// for mobile sidebar
// Toggle menu and body scroll on menu click
document.querySelector('.mobile-menu-icon')?.addEventListener('click', function () {
    document.querySelector('.header-navs').classList.toggle('show');
    document.body.classList.toggle('no-scroll');
});

document.querySelector('.sidebar-close-btn')?.addEventListener('click', function () {
    document.querySelector('.header-navs').classList.remove('show');
    document.body.classList.remove('no-scroll');
});

// Close the sidebar if clicking outside of it
document.addEventListener('click', function (event) {
    // Check if the click is outside the sidebar and the menu button
    if (!event.target.closest('.header-navs') && !event.target.closest('.mobile-menu-icon')) {
        if (document.querySelector('.header-navs').classList.contains('show')) {
            document.querySelector('.header-navs').classList.remove('show');
            document.body.classList.remove('no-scroll');
        }
    }
});



// card selected
const cardNames = document.querySelectorAll('.card-name');

cardNames.forEach(card => {
    card.addEventListener('click', function () {
        // Hide all cardSelectSvg elements
        document.querySelectorAll('.cardSelectSvg').forEach(svg => svg.classList.add('d-none'));

        // Show the cardSelectSvg inside the clicked card
        this.querySelector('.cardSelectSvg').classList.remove('d-none');
    });
});



// Show and hide the dropdown when clicking the profile container
document.querySelector('.header-profile-container')?.addEventListener('click', function (event) {
    event.stopPropagation();
    const dropdown = document.querySelector('.tm-profiledropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
});

// Hide the dropdown if the user clicks outside of the profile container
document.addEventListener('click', function (event) {
    const dropdown = document.querySelector('.tm-profiledropdown');
    const profileContainer = document.querySelector('.header-profile-container');

    // If the click was outside the profile container and dropdown, hide the dropdown
    if (!profileContainer.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});

// Prevent the dropdown from closing when clicking inside the dropdown
document.querySelector('.tm-profiledropdown')?.addEventListener('click', function (event) {
    event.stopPropagation();
});

// notifications toggle
document.addEventListener('DOMContentLoaded', function () {
    const openModalButton = document.querySelector('.notification-icon');
    const modalContainer = document.querySelector('.notification-list-container');

    openModalButton.addEventListener('click', function () {
        console.log('working');
        modalContainer.classList.toggle('open');
    });

    // Close modal if clicked outside of it
    document.addEventListener('click', function (event) {
        if (!modalContainer.contains(event.target) &&
            !openModalButton.contains(event.target)) {
            modalContainer.classList.remove('open');

        }
    });
});


// Function for PIN box validation
function initializePinBoxes() {
    const pinBoxes = document.querySelectorAll(".pin-box");

    // Move to the next box when inputting values
    pinBoxes.forEach((box, index) => {
        box.addEventListener("input", () => {
            if (box.value.length === 1 && index < 3) {
                pinBoxes[index + 1].focus();
            }
        });

        // Move to the previous box on backspace
        box.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && index > 0 && box.value === "") {
                pinBoxes[index - 1].focus();
            }
        });
    });

    // Handle pasting of PIN
    pinBoxes[0].addEventListener("paste", (e) => {
        const pastedData = e.clipboardData.getData("text");
        const pinArray = pastedData.split("");

        pinBoxes.forEach((box, idx) => {
            if (pinArray[idx]) {
                box.value = pinArray[idx];
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".pin-box")) {
        initializePinBoxes(); // For the page that has PIN boxes
    }

    if (document.querySelector("#date") || document.querySelector("#time")) {
        initializeFlatpickr(); // For the page that has date/time pickers
    }
});

// new js added 2025 by tarek
