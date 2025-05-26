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

  doneBtn.addEventListener('click', ()=>{
    selectedServiceContainer.style.display = "none";
  })

  cancelBtn.addEventListener("click", () => {
    selectServiceDropdown.style.display = "none";
    selectedServiceContainer.style.display = "block";
    addButton.style.display ="none";
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

document.addEventListener("DOMContentLoaded", function () {
  let selectedServices = [];

  // References to elements
  const selectedServiceContainer = document.querySelector(
    ".selected-service-container"
  );
  const serviceSelector = document.getElementById("service-selector");
  const subServiceSelector = document.getElementById("sub-service-selector");
  const addButton = document.querySelector(".select-service-dropdown-add-btn");
  const selectedContainer = document.querySelector(
    ".selected-service-container-list"
  );
  const selectServiceDropdown = document.querySelector(
    ".select-service-dropdown"
  );
  const serviceCount = document.getElementById("service-count");
  const personCount = document.querySelector(".selected-person-count");

  // Function to render the selected services
  const renderSelectedServices = () => {
    selectedContainer.innerHTML = ""; // Clear the container
    selectedServices.forEach((service, index) => {
      const serviceItem = document.createElement("div");
      serviceItem.classList.add("service-item");
      serviceItem.innerHTML = `
          <div class="item-left">
            <div class="item-title">${index + 1}. ${service.service}</div>
            <div class="item-sub-title">${service.subService}</div>
          </div>
          <div class="item-right">
            <span style="cursor:pointer" class="item-delete-btn" data-index="${index}">
              <svg fill="#6b6b6b" width="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg>
            </span>
          </div>
        `;
      selectedContainer.appendChild(serviceItem);
    });

    // Update service count
    serviceCount.innerText = selectedServices.length;

    // Update person count text
    if (selectedServices.length > 0) {
      personCount.innerText = `${selectedServices.length} Person${
        selectedServices.length > 1 ? "s" : ""
      }`;
    } else {
      personCount.innerText = "Select";
    }

    // Attach delete functionality
    document.querySelectorAll(".item-delete-btn").forEach((btn) => {
      btn.addEventListener("click", (event) => {
        const index = event.target.getAttribute("data-index");
        selectedServices.splice(index, 1); // Remove from array
        renderSelectedServices(); // Re-render UI

        // Show dropdown and add button if no services are selected
        if (selectedServices.length === 0) {
          addButton.style.display = "block";
          selectServiceDropdown.style.display = "block";
        }
      });
    });
  };

  // Add button click event
  addButton.addEventListener("click", () => {
    const selectedService = serviceSelector.value;
    const selectedSubService = subServiceSelector.value;

    // Validation for proper selection
    if (selectedService === "Select" || selectedSubService === "Select") {
      alert("Please select a valid service and sub-service.");
      return;
    }

    // Add to the array
    selectedServices.push({
      service: selectedService,
      subService: selectedSubService,
    });
    addButton.style.display = "none";
    selectedServiceContainer.style.display = 'block';
    // Re-render the UI
    renderSelectedServices();

    // Reset the selectors
    serviceSelector.selectedIndex = 0;
    subServiceSelector.selectedIndex = 0;

    // Hide add button and dropdown container
    addButton.style.display = "none";
    selectServiceDropdown.style.display = "none";
  });
});
