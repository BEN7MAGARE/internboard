(async function () {
    getCorporatesOptions('#corporateOptionsID');
    getCategoriesOptions('#corporateCategory');

    const corporateCreateForm = document.getElementById('corporateCreateForm'),
        corporateCreateSubmit = document.getElementById('corporateCreateSubmit'),
        contactPersonCreateForm = document.getElementById('contactPersonCreateForm'),
        contactPersonCreateSubmit = document.getElementById('contactPersonCreateSubmit'),
        createCorporateToggle = document.getElementById('createCorporateToggle'),
        createContactPersonToggle = document.getElementById('createContactPersonToggle');

    if (createCorporateToggle) {
        createCorporateToggle.addEventListener('click', function () {
            corporateCreateForm.reset();
            document.getElementById('corporateID').value = '';
        });
    }

    if (createContactPersonToggle) {
        createContactPersonToggle.addEventListener('click', function () {
            contactPersonCreateForm.reset();
            document.getElementById('corporateContactPersonID').value = '';
        });
    }

    if (document.querySelectorAll('input[name="corporate_id[]"]').length > 0) {
        const checkboxes = document.querySelectorAll('input[name="corporate_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    }

    if (document.getElementById('allCorporateSelect')) {
        document.getElementById('allCorporateSelect').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[name="corporate_id[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    }

    if (corporateCreateForm) {
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
                const response = await fetch("/employer", {
                    method: 'POST',
                    body: formData,
                });
                if (response.ok) {
                    corporateCreateSubmit.disabled = false;
                    let result = await response.json();
                    console.log(result);

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
    }

    document.addEventListener('click', function (e) {
        const editCorporateToggle = e.target.closest('#editCorporateToggle');
        if (editCorporateToggle) {
            e.preventDefault();
            const id = editCorporateToggle.dataset.id;
            const response = fetch(`/corporates/${id}`);
            response.then((res) => res.json()).then((data) => {
                console.log(data);
                document.getElementById('corporateID').value = data.id;
                document.getElementById('corporateName').value = data.name;
                document.getElementById('corporateEmail').value = data.email;
                document.getElementById('corporatePhone').value = data.phone;
                document.getElementById('corporateAddress').value = data.address;
                document.getElementById('corporateLogo').value = data.logo;
                document.getElementById('corporateSize').value = data.size;
                document.getElementById('corporateMissionVision').value = data.mission_vision;
                const corporateCategoryOptions = document.getElementById('corporateCategory').options;
                for (let i = 0; i < corporateCategoryOptions.length; i++) {
                    if (corporateCategoryOptions[i].value == data.category_id) {
                        corporateCategoryOptions[i].selected = true;
                        break;
                    }
                }
            });
        }

        const editContactPersonToggle = e.target.closest('#editContactPersonToggle');
        if (editContactPersonToggle) {
            e.preventDefault();
            const id = editContactPersonToggle.dataset.id;
            const response = fetch(`/users/${id}`);
            response.then((res) => res.json()).then((data) => {

                document.getElementById('corporateContactPersonID').value = data.id;
                document.getElementById('corpContactPersonFirstName').value = data.first_name;
                document.getElementById('corpContactPersonMiddleName').value = data.middle_name;
                document.getElementById('corpContactPersonLastName').value = data.last_name;
                document.getElementById('corpContactPersonEmail').value = data.email;
                document.getElementById('corpContactPersonPhone').value = data.phone;
                document.getElementById('corpContactPersonAddress').value = data.address;
                const corporateIDOption = document.getElementById('corporateOptionsID').options;
                for (let i = 0; i < corporateIDOption.length; i++) {
                    if (corporateIDOption[i].value == data.corporate_id) {
                        corporateIDOption[i].selected = true;
                        break;
                    }
                }
            });
        }
    });

    if (contactPersonCreateForm) {
        contactPersonCreateForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const formData = new FormData(contactPersonCreateForm);
            const response = await fetch("/corporate-user-store", {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                let result = await response.json();
                if (result.status === "success") {
                    showSuccess(result.message, "#corporateContactPersonFeedback");
                    document.getElementById('corporateContactPersonID').value = "";
                    contactPersonCreateForm.reset();
                } else {
                    showError(result.message, "#corporateContactPersonFeedback");
                }
            } else if (response.status === 422) {
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#corporateContactPersonFeedback");
            } else if (response.status === 419) {
                showError("You are not logged in", "#corporateContactPersonFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                showError("Error occurred during processing", "#corporateContactPersonFeedback");
            }
        });
    }

})();
