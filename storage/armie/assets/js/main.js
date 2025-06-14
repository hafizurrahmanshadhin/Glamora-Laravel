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
