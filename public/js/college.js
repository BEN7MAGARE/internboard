(function () {
    getCollegesOptions('#collegeUserCollegeID');
    getCourseCategoriesOptions('#courseCategoryID');

    const collegeCreateForm = document.getElementById("collegeCreateForm"),
        collegeCreateSubmit = document.getElementById("collegeCreateSubmit"),
        collegeUserCreateForm = document.getElementById("collegeUserCreateForm"),
        collegeUserCreateSubmit = document.getElementById("collegeUserCreateSubmit"),
        createCollegeToggle = document.getElementById('createCollegeToggle'),
        createCollegeUserToggle = document.getElementById('createCollegeUserToggle'),
        courseCreateForm = document.getElementById("courseCreateForm"),
        courseCreateSubmit = document.getElementById("courseCreateSubmit"),
        createCourseToggle = document.getElementById('createCourseToggle');


    document.getElementById('allCollegeSelect').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="college_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    createCollegeToggle.addEventListener('click', function () {
        collegeCreateForm.reset();
        document.getElementById('collegeID').value = '';
    });
    createCollegeUserToggle.addEventListener('click', function () {
        collegeUserCreateForm.reset();
        document.getElementById('collegeUserID').value = '';
    });

    createCourseToggle.addEventListener('click', function () {
        courseCreateForm.reset();
        document.getElementById('courseID').value = '';
    });

    collegeCreateForm.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        console.log(Object.fromEntries(formData.entries()));
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
                    document.getElementById('collegeID').value = "";
                    collegeCreateForm.reset();
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

    collegeUserCreateForm.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        console.log(Object.fromEntries(formData.entries()));
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
        // if (!phoneNumberRegex.test(formData.get('phone'))) {
        //     errors.push("Invalid phone number");
        // }
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

    courseCreateForm.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        console.log(Object.fromEntries(formData.entries()));
        const errors = [];
        if (formData.get('name').length < 2) {
            errors.push("Invalid course name");
        }
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value + '<br>';
            });
            showError(p, "#courseFeedback");
        } else {
            const response = await fetch("/courses", {
                method: "POST",
                body: formData,
                headers: {
                    accept: "application/json",
                }
            });
            if (response.ok) {
                courseCreateSubmit.disabled = false;
                const result = await response.json();
                console.log(result);
                document.getElementById('courseID').value = "";
                if (result.status === "success") {
                    document.getElementById('courseID').value = "";
                    courseCreateForm.reset();
                    showSuccess(result.message, "#courseFeedback");
                } else {
                    showError(result.message, "#courseFeedback");
                }
            } else if (response.status === 422) {
                courseCreateSubmit.disabled = false;
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#courseFeedback");
            } else if (response.status === 419) {
                courseCreateSubmit.disabled = false;
                showError("You are not logged in", "#courseFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                courseCreateSubmit.disabled = false;
                showError("Error occurred during processing", "#courseFeedback");
            }
        }
    });


    document.addEventListener('click', function (e) {

        const editCollegeToggle = e.target.closest('#editCollegeToggle');
        if (editCollegeToggle) {
            e.preventDefault();
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

        const editCollegeUserToggle = e.target.closest('#editCollegeUserToggle');
        if (editCollegeUserToggle) {
            e.preventDefault();
            const id = editCollegeUserToggle.dataset.id;
            const response = fetch(`/users/${id}`);
            response.then((res) => res.json()).then((data) => {
                document.getElementById('collegeUserID').value = data.id;
                document.getElementById('collegeUserFirstName').value = data.first_name;
                document.getElementById('collegeUserLastName').value = data.last_name;
                document.getElementById('collegeUserEmail').value = data.email;
                document.getElementById('collegeUserPhone').value = data.phone;
                document.getElementById('collegeUserAddress').value = data.address;
                const collegeIDOption = document.getElementById('collegeUserCollegeID').options;
                for (let i = 0; i < collegeIDOption.length; i++) {
                    if (collegeIDOption[i].value == data.college_id) {
                        collegeIDOption[i].selected = true;
                        break;
                    }
                }
            });
        }

        const editCourseToggle = e.target.closest('#editCourseToggle');
        if (editCourseToggle) {
            e.preventDefault();
            const id = editCourseToggle.dataset.id;
            const response = fetch(`/courses/${id}`);
            response.then((res) => res.json()).then((data) => {
                console.log(data);
                
                document.getElementById('courseID').value = data.id;
                document.getElementById('courseName').value = data.name;
                document.getElementById('courseDescription').value = data.description;
                document.getElementById('courseDuration').value = data.duration;
                // document.getElementById('courseFees').value = data.fees;
                document.getElementById('courseCode').value = data.code;
                const courseCategoryIDOption = document.getElementById('courseCategoryID').options;
                for (let i = 0; i < courseCategoryIDOption.length; i++) {
                    if (courseCategoryIDOption[i].value == data.course_category_id) {
                        courseCategoryIDOption[i].selected = true;
                        break;
                    }
                }
            });
        }

    });
})();
