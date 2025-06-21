document.addEventListener("DOMContentLoaded", () => {
  const tourForm = document.getElementById("tour-form");
  const tourLocations = document.getElementById("tour-locations");
  const addLocationButton = document.getElementById("add-location");

  const locations = ["Sigiriya", "Kandy", "Galle"];
  let locationCount = 1;

  addLocationButton.addEventListener("click", () => {
    locationCount++;
    const newLocationGroup = document.createElement("div");
    newLocationGroup.className = "location-group";

    const newLabel = document.createElement("label");
    newLabel.htmlFor = `package-${locationCount}`;
    newLabel.textContent = `Select Location ${locationCount}:`;

    const newSelect = document.createElement("select");
    newSelect.id = `package-${locationCount}`;
    newSelect.name = `package-${locationCount}`;
    newSelect.className = "package-select";
    newSelect.innerHTML = '<option value="">Select a location</option>';

    locations.forEach((location) => {
      const option = document.createElement("option");
      option.value = location.toLowerCase();
      option.textContent = location;
      newSelect.appendChild(option);
    });

    newLocationGroup.appendChild(newLabel);
    newLocationGroup.appendChild(newSelect);
    tourLocations.appendChild(newLocationGroup);
  });

  tourForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(tourForm);
    const tourPlan = [];
    for (let [key, value] of formData.entries()) {
      if (value) {
        tourPlan.push(value);
      }
    }
    console.log("Tour Plan:", tourPlan);
    alert(`Tour Plan: ${tourPlan.join(", ")}`);
  });

  let currentIndex = 0;
  const slides = document.querySelectorAll(".slider-image");
  const totalSlides = slides.length;

  // Function to change slides
  function changeSlide(direction) {
    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
    updateSlider();
  }

  // Function to update slider position
  function updateSlider() {
    const slider = document.querySelector(".slider");
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  // Initialize the first slide
  updateSlider();

  function submitForm() {
    // Get the email input value
    var email = document.getElementById("email").value;

    // Perform basic validation (you can add more checks)
    if (email === "") {
      alert("Please enter a valid email address.");
      return false;
    }

    // Send the email data to the server (using AJAX or a form submission)
    // Replace this with your actual server-side processing logic
    alert("Email submitted successfully!");
    return false; // Prevent default form submission
  }
});
