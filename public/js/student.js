document.addEventListener('DOMContentLoaded', function () {
    const studentCreateForm = document.getElementById('studentCreateForm');

    studentCreateForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector("input[name='_token']").value;

        try {
            const response = await fetch('/students', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });

            if (response.ok) {
                const data = await response.json();
                if (data.status === 'success') {
                    showSuccess(data.message, "#studentFeedback");
                    studentCreateForm.reset();
                } else {
                    showError(data.message, "#studentFeedback");
                }
            } else if (response.status === 422) {
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#studentFeedback");
            } else if (response.status === 419) {
                showError("You are not logged in", "#studentFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                showError("Error occurred during processing", "#studentFeedback");
            }
        } catch (error) {
            console.error(error);
            showError("Unexpected error occurred", "#studentFeedback");
        }
    });
    
});
