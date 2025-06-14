document.addEventListener("DOMContentLoaded", function () {
    // Initialize Flatpickr on the input element
    const dateInput = document.getElementById('date-input');
    const flatpickrInstance = flatpickr(dateInput, {
        dateFormat: "d/m/y",
        minDate: "today" // Disable past dates
    });

    // Add event listener to open Flatpickr on container click
    document.querySelector('.date-picker-container').addEventListener('click', function () {
        flatpickrInstance.open();
    });
});

function copyMarqueeNode() {
    var heroMarquee = document.querySelectorAll(".rk--hero--marquee .slide");
    var ParentContainer = document.querySelectorAll(".rk--hero--marquee");

    var storiesMarqueeWrapper = document.querySelectorAll(
        ".stories--marquee--slider"
    );

    if (heroMarquee) {
        ParentContainer.forEach((container) => {
            heroMarquee.forEach((marquee) => {
                let copySlide = marquee.cloneNode(true);
                container.appendChild(copySlide);
            });
        });
    }

    if (storiesMarqueeWrapper) {
        storiesMarqueeWrapper.forEach((storiesMarquee) => {
            var copyStroriesSlide = storiesMarquee
                .querySelector(".slide")
                .cloneNode(true);
            storiesMarquee.appendChild(copyStroriesSlide);
        });
    }
}
copyMarqueeNode();
