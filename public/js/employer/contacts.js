document.addEventListener('DOMContentLoaded', function () {
    const corporateUserCreateForm = document.getElementById('corporateUserCreateForm');
    const corporateUserID = document.getElementById('corporateUserID');
    const corporateUserFirstName = document.getElementById('corporateUserFirstName');
    const corporateUserMiddleName = document.getElementById('corporateUserMiddleName');
    const corporateUserLastName = document.getElementById('corporateUserLastName');
    const corporateUserEmail = document.getElementById('corporateUserEmail');
    const corporateUserPhone = document.getElementById('corporateUserPhone');
    const corporateUserAddress = document.getElementById('corporateUserAddress');
    const corporateUserCreateSubmit = document.getElementById('corporateUserCreateSubmit'),
        allContactSelect = document.getElementById('allContactSelect'),
        createCorporateUserToggle = document.getElementById('createCorporateUserToggle');

    createCorporateUserToggle.addEventListener('click', function () {
        corporateUserCreateForm.reset();
        corporateUserID.value = "";
    });

    if (corporateUserCreateForm) {
        corporateUserCreateForm.addEventListener("submit", async function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            const errors = [],
                emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
                phoneNumberRegex = /^\+254[17]\d{8}$/;

            if (formData.get('first_name').length < 2) {
                errors.push("Invalid first name");
            }
            if (formData.get('last_name').length < 2) {
                errors.push("Invalid last name");
            }
            if (!emailRegex.test(formData.get('email'))) {
                errors.push("Invalid email");
            }
            if (!isValidKenyanPhone(formData.get('phone'))) {
                errors.push("Invalid phone number");
            }
            corporateUserCreateSubmit.disabled = true;
            if (errors.length > 0) {
                let p = "";
                $.each(errors, function (key, value) {
                    p += value + '<br>';
                });
                showError(p, "#corporateUserFeedback");
                corporateUserCreateSubmit.disabled = false;
            } else {
                const response = await fetch("/corporate-user-store", {
                    method: "POST",
                    body: formData,
                    headers: {
                        accept: "application/json",
                    }
                });
                if (response.ok) {
                    corporateUserCreateSubmit.disabled = false;
                    const result = await response.json();
                    console.log(result);
                    document.getElementById('corporateUserID').value = "";
                    if (result.status === "success") {
                        document.getElementById('corporateUserID').value = "";
                        corporateUserCreateForm.reset();
                        showSuccess(result.message, "#corporateUserFeedback");
                    } else {
                        showError(result.message, "#corporateUserFeedback");
                    }
                } else if (response.status === 422) {
                    corporateUserCreateSubmit.disabled = false;
                    const errorData = await response.json();
                    let errors = '';
                    for (const key in errorData.errors) {
                        errors += errorData.errors[key].join(' ') + '!<br>';
                    }
                    showError(errors, "#corporateUserFeedback");
                } else if (response.status === 419) {
                    corporateUserCreateSubmit.disabled = false;
                    showError("You are not logged in", "#corporateUserFeedback");
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    corporateUserCreateSubmit.disabled = false;
                    showError("Error occurred during processing", "#corporateUserFeedback");
                }
            }
        });
    }

    allContactSelect.addEventListener("change", function () {
        const checkboxes = document.querySelectorAll("input[name='contact_id[]']");
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });

    document.addEventListener('click', async function (event) {
        const editContactToggle = event.target.closest('#editContactToggle');
        if (editContactToggle) {
            event.preventDefault();
            const contactId = editContactToggle.dataset.id;
            const response = await fetch(`/employer-contact-detail/${contactId}`);
            if (response.ok) {
                const data = await response.json();
                corporateUserID.value = data.id;
                corporateUserFirstName.value = data.first_name;
                corporateUserMiddleName.value = data.middle_name;
                corporateUserLastName.value = data.last_name;
                corporateUserEmail.value = data.email;
                corporateUserPhone.value = data.phone;
                collegeUseraltPhone.value = data.alt_phone;
                corporateUserAddress.value = data.address;
            }
        }

        const deleteContact = event.target.closest('#deleteContactToggle');
        if (deleteContact) {
            event.preventDefault();
            const contactId = deleteContact.dataset.contactid;
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const response = await fetch(`/employer-contacts-delete/${contactId}`);
                    if (response.ok) {
                        const data = await response.json();
                        if (data.status === 'success') {
                            swal.fire({
                                title: "Deleted!",
                                text: "Your contact has been deleted.",
                                icon: "success",
                                confirmButtonText: "OK"
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        } else {
                            swal.fire({
                                title: "Error!",
                                text: "Your contact has not been deleted.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                }
            });
        }
    })

});
