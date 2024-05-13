function toggleSuccess() {
    document.getElementById("popup-1").classList.toggle("active");
}
function toggleFail() {
    document.getElementById("popup-0").classList.toggle("active");
}

// Function to check if the URL contains a specific message parameter
function checkURLForMessage() {
    var urlParams = new URLSearchParams(window.location.search);
    var messageParam = urlParams.get('message');

    if (messageParam === '1') {
        toggleSuccess();
    }
    else if (messageParam === '0') {
        toggleFail();
    }
}

// Call the checkURLForMessage function when the page is loaded
window.addEventListener('DOMContentLoaded', checkURLForMessage);