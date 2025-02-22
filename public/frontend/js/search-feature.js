document.addEventListener("DOMContentLoaded", function () {
    // Get references to the select elements and the button
    const serviceSelector = document.getElementById("service-selector");
    const subServiceSelector = document.getElementById("sub-service-selector");
    const addButton = document.querySelector(".select-service-dropdown-add-btn");
    const openServiceBtn = document.querySelector(".select-service-btn");
    const doneBtn = document.querySelector('.done-btn');
    const selectedServiceContainer = document.querySelector(
        ".selected-service-container"
    );
    const selectServiceDropdown = document.querySelector(
        ".select-service-dropdown"
    );
    const addServiceBtn = document.querySelector(".add-service-btn");
    const cancelBtn = document.querySelector(
        ".select-service-dropdown-cancel-btn"
    );

    doneBtn.addEventListener('click', () => {
        selectedServiceContainer.style.display = "none";
    })

    cancelBtn.addEventListener("click", () => {
        selectServiceDropdown.style.display = "none";
        selectedServiceContainer.style.display = "block";
        addButton.style.display = "none";
        serviceSelector.value = "Select";
        subServiceSelector.value = "Select";
    });

    openServiceBtn.addEventListener("click", () => {
        selectedServiceContainer.style.display = "flex";
    });
    addServiceBtn.addEventListener("click", () => {
        selectedServiceContainer.style.display = "none";
        selectServiceDropdown.style.display = "block";
    });

    // Function to check if both selects have valid selections
    function checkSelection() {
        // If both select elements have a selected value that is not the default "Select" option
        if (
            serviceSelector.value !== "Select" &&
            subServiceSelector.value !== "Select"
        ) {
            addButton.style.display = "block"; // Show the "Add" button
        } else {
            addButton.style.display = "none"; // Hide the "Add" button
        }
    }

    // Add event listeners to both select elements to trigger the check when values change
    serviceSelector.addEventListener("change", checkSelection);
    subServiceSelector.addEventListener("change", checkSelection);

    // Initial check in case values are pre-selected
    checkSelection();
});
