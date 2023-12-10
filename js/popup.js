// Get all buttons with id "myBtn" (returns a NodeList)
var btns = document.querySelectorAll("#myBtn");

// Get all modals with class "modal" (returns a NodeList)
var modals = document.querySelectorAll(".modal");

// Get all close buttons with class "close" (returns a NodeList)
var closeButtons = document.querySelectorAll(".close");

// Function to open the modal
function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

// Function to close all modals
function closeModal() {
    modals.forEach(function(modal) {
        modal.style.display = "none";
    });
}

// Assign the click event to each button in the NodeList
btns.forEach(function(btn) {
    btn.onclick = function() {
        // Extract the modal id from the button's data-modal attribute
        var modalId = btn.getAttribute("data-modal");
        openModal(modalId);
    };
});

// When the user clicks on <span> (x), close all modals
// span.onclick = closeModal;
closeButtons.forEach(function(closeBtn) {
    closeBtn.onclick = function() {
        // Extract the modal id from the close button's data-modal attribute
        var modalId = closeBtn.getAttribute("data-modal");
        closeModal(modalId);
    };
});

// When the user clicks anywhere outside of the modal, close all modals
window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
        closeModal();
    }
};
