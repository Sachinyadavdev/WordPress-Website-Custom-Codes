
// Add this script to your page where the popup and Contact Form 7 are used:
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('wpcf7mailsent', function(event) {
        // Hide the popup after form submission
        document.querySelector('.popup-class').style.display = 'none'; 

        // Show the additional content
        document.querySelector('.success-message').style.display = 'block';
    }, false);
});

// What This Does:
// Listens for the wpcf7mailsent event, which fires when the form is successfully submitted.
// Hides the popup (.popup-class → replace with your actual popup class).
// Displays the hidden success message (.success-message → replace with your actual content class).

// CSS (Ensure the success message is hidden initially)
.success-message {
    display: none;
}
