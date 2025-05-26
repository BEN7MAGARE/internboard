document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/contact', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showSuccess(data.message, "#contactFeedback");
                contactForm.reset();
            } else {
                showError(data.message, "#contactFeedback");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError("An error occurred. Please try again later.", "#contactFeedback");
        });
    });
});