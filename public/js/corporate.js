(async function () {
    const corporateCreateForm = document.getElementById('corporateCreateForm'),
        corporateCreateSubmit = document.getElementById('corporateCreateSubmit');

    const checkboxes = document.querySelectorAll('input[name="corporate_id[]"]');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = this.checked;
    });
    document.getElementById('allCorporateSelect').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="corporate_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    corporateCreateForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(corporateCreateForm), errors = [],
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/;

        if (formData.get('name').length < 2) {
            errors.push("Invalid company name");
        }
        if (formData.get('email').length < 2 || !emailRegex.test(formData.get('email'))) {
            errors.push("Invalid company email");
        }
        if (formData.get('phone').length < 2 || !phoneNumberRegex.test(formData.get('phone'))) {
            errors.push("Invalid company phone");
        }
        if (formData.get('address').length < 2) {
            errors.push("Invalid company address");
        }
        corporateCreateSubmit.disabled = true;
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value + '<br>';
            });
            showError(p, "#corporateFeedback");
            corporateCreateSubmit.disabled = false;
        } else {
            const response = await fetch("/corporates", {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                corporateCreateSubmit.disabled = false;
                let result = await response.json();
                if (result.status === "success") {
                    showSuccess(result.message, "#corporateFeedback");
                    document.getElementById('corporateID').value = "";
                    corporateCreateForm.reset();
                } else {
                    showError(result.message, "#corporateFeedback");
                }
            } else if (response.status === 422) {
                corporateCreateSubmit.disabled = false;
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#corporateFeedback");
            } else if (response.status === 419) {
                corporateCreateSubmit.disabled = false;
                showError("You are not logged in", "#corporateFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                corporateCreateSubmit.disabled = false;
                showError("Error occurred during processing", "#corporateFeedback");
            }
        }
    });

    document.addEventListener('click', function (e) {
        const editCorporateToggle = e.target.closest('#editCorporateToggle');
        if (editCorporateToggle) {
            const id = editCorporateToggle.dataset.id;
            const response = fetch(`/corporates/${id}`);
            response.then((res) => res.json()).then((data) => {
                document.getElementById('corporateID').value = data.id;
                document.getElementById('corporateName').value = data.name;
                document.getElementById('corporateEmail').value = data.email;
                document.getElementById('corporatePhone').value = data.phone;
                document.getElementById('corporateAddress').value = data.address;
                document.getElementById('corporateLogo').value = data.logo;
            });
        }
    });
})();
