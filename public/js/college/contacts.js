document.addEventListener('DOMContentLoaded', function () {
    const collegeUserCreateForm = document.getElementById('collegeUserCreateForm');
    const collegeUserCollegeID = document.getElementById('collegeUserCollegeID');
    const collegeUserFirstName = document.getElementById('collegeUserFirstName');
    const collegeUserMiddleName = document.getElementById('collegeUserMiddleName');
    const collegeUserLastName = document.getElementById('collegeUserLastName');
    const collegeUserEmail = document.getElementById('collegeUserEmail');
    const collegeUserPhone = document.getElementById('collegeUserPhone');
    const collegeUserAddress = document.getElementById('collegeUserAddress');
    const collegeUserCreateSubmit = document.getElementById('collegeUserCreateSubmit'),
        allContactSelect = document.getElementById('allContactSelect');

    if (collegeUserCreateForm) {
        collegeUserCreateForm.addEventListener("submit", async function (event) {
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
            if (formData.get('alt_phone') !== "" && !isValidKenyanPhone(formData.get('alt_phone'))) {
                errors.push("Invalid alternative phone number");
            }
            collegeUserCreateSubmit.disabled = true;
            if (errors.length > 0) {
                let p = "";
                $.each(errors, function (key, value) {
                    p += value + '<br>';
                });
                showError(p, "#collegeUserFeedback");
                collegeUserCreateSubmit.disabled = false;
            } else {
                const response = await fetch("/college-user-store", {
                    method: "POST",
                    body: formData,
                    headers: {
                        accept: "application/json",
                    }
                });
                if (response.ok) {
                    collegeUserCreateSubmit.disabled = false;
                    const result = await response.json();
                    console.log(result);
                    document.getElementById('collegeUserID').value = "";
                    if (result.status === "success") {
                        document.getElementById('collegeUserID').value = "";
                        collegeUserCreateForm.reset();
                        showSuccess(result.message, "#collegeUserFeedback");
                    } else {
                        showError(result.message, "#collegeUserFeedback");
                    }
                } else if (response.status === 422) {
                    collegeUserCreateSubmit.disabled = false;
                    const errorData = await response.json();
                    let errors = '';
                    for (const key in errorData.errors) {
                        errors += errorData.errors[key].join(' ') + '!<br>';
                    }
                    showError(errors, "#collegeUserFeedback");
                } else if (response.status === 419) {
                    collegeUserCreateSubmit.disabled = false;
                    showError("You are not logged in", "#collegeUserFeedback");
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    collegeUserCreateSubmit.disabled = false;
                    showError("Error occurred during processing", "#collegeUserFeedback");
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
        const deleteContact = event.target.closest('#deleteContact');
        if (deleteContact) {
            event.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const contactId = deleteContact.getAttribute('data-id');
                    const response = fetch(`/contacts/${contactId}`);
                    if (response.ok) {
                        const data = response.json();
                        if (data.status === 'success') {
                            showSuccess(data.message, "#collegeUserFeedback");
                        } else {
                            showError(data.message, "#collegeUserFeedback");
                        }
                    }
                }
            });
        }
    })

});
