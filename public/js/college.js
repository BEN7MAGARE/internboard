(function () {

    const collegeCreateForm = document.getElementById("collegeCreateForm"),
        collegeCreateSubmit = document.getElementById("collegeCreateSubmit"),
        collegeUserCreateForm = document.getElementById("collegeUserCreateForm"),
        collegeUserCreateSubmit = document.getElementById("collegeUserCreateSubmit");

    document.getElementById('allCollegeSelect').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="college_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    collegeCreateForm.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        const errors = [],
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/;

        if (formData.get('name').length < 2) {
            errors.push("Invalid company name");
        }
        if (!emailRegex.test(formData.get('email'))) {
            errors.push("Invalid company email");
        }
        if (!phoneNumberRegex.test(formData.get('phone'))) {
            errors.push("Invalid company phone");
        }
        if (formData.get('address').length < 2) {
            errors.push("Invalid company address");
        }
        collegeCreateSubmit.disabled = true;
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value + '<br>';
            });
            showError(p, "#collegeFeedback");
            collegeCreateSubmit.disabled = false;
        } else {
            const response = await fetch("/colleges", {
                method: "POST",
                body: formData,
                headers: {
                    accept: "application/json",
                }
            });
            if (response.ok) {
                collegeCreateSubmit.disabled = false;
                const result = await response.json();
                document.getElementById('collegeID').value = "";
                if (result.status === "success") {
                    showSuccess(result.message, "#collegeFeedback");
                } else {
                    showError("An error occurred during the processing", "#collegeFeedback");
                }
            } else if (response.status === 422) {
                collegeCreateSubmit.disabled = false;
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#collegeFeedback");
            } else if (response.status === 419) {
                collegeCreateSubmit.disabled = false;
                showError("You are not logged in", "#collegeFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                collegeCreateSubmit.disabled = false;
                showError("Error occurred during processing", "#collegeFeedback");
            }
        }
    });

    document.addEventListener('click', function (e) {
        const editCollegeToggle = e.target.closest('#editCollegeToggle');
        if (editCollegeToggle) {
            const id = editCollegeToggle.dataset.id;
            const response = fetch(`/colleges/${id}`);
            response.then((res) => res.json()).then((data) => {
                document.getElementById('collegeID').value = data.id;
                document.getElementById('collegeName').value = data.name;
                document.getElementById('collegeEmail').value = data.email;
                document.getElementById('collegePhone').value = data.phone;
                document.getElementById('collegeAddress').value = data.address;
                document.getElementById('collegeLogo').value = data.logo;
            });
        }
    });

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
        if (!phoneNumberRegex.test(formData.get('phone'))) {
            errors.push("Invalid phone number");
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
            const response = await fetch("/college-users", {
                method: "POST",
                body: formData,
                headers: {
                    accept: "application/json",
                }
            });
            if (response.ok) {
                collegeUserCreateSubmit.disabled = false;
                const result = await response.json();
                document.getElementById('collegeUserID').value = "";
                if (result.status === "success") {
                    showSuccess(result.message, "#collegeUserFeedback");
                } else {
                    showError("An error occurred during the processing", "#collegeUserFeedback");
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

})();
