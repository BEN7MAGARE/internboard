(async function () {
    const corporateCreateForm = document.getElementById('corporateCreateForm'),
        corporateCreateSubmit = document.getElementById('corporateCreateSubmit');
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
            const response = await fetch("/corporate", {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                corporateCreateSubmit.disabled = false;
                let result = await response.json();
                if (result.status === "success") {
                    showSuccess(result.message, "#corporateFeedback");
                    window.setTimeout(() => {
                        window.location.href = result.url;
                    }, 1000);
                } else {
                    showError(result.message, "#corporateFeedback");
                }
            } else {
                let text = await response.text();
                corporateCreateSubmit.disabled = false;
                showError(text, "#corporateFeedback");
            }
        }
    });

})();
