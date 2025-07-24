document.addEventListener('DOMContentLoaded', function () {
    getCourseCategoriesOptions('#categoryId');
    const categoryId = document.getElementById('categoryId');
    const courseName = document.getElementById('courseName');
    const courseCode = document.getElementById('courseCode');
    const duration = document.getElementById('duration');
    const fee = document.getElementById('fee');
    const levelOfStudy = document.getElementById('levelOfStudy'),
        createCourseToggle = document.getElementById('createCourseToggle'),
        courseId = document.getElementById('courseId');

    courseCreateForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        createCourseToggle.disabled = true;
        const formData = new FormData(this);
        console.log(Object.fromEntries(formData.entries()));
        const response = await fetch('/courses', {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            const data = await response.json();
            courseCreateForm.reset();
            createCourseToggle.disabled = false;
            if (data.status === 'success') {
                showSuccess(data.message, '#courseCreateForm');
            } else {
                showError(data.message, '#courseCreateForm');
            }
        } else if (response.status === 422) {
            createCourseToggle.disabled = false;
            const errorData = await response.json();
            let errors = '';
            for (const key in errorData.errors) {
                errors += errorData.errors[key].join(' ') + '!<br>';
            }
            showError(errors, '#courseCreateForm');
        } else if (response.status === 419) {
            createCourseToggle.disabled = false;
            showError("You are not logged in", '#courseCreateForm');
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        } else {
            createCourseToggle.disabled = false;
            showError("An error occurred while creating course", '#courseCreateForm');
        }
    });

    document.addEventListener('click', async function (event) {
        const editCourseToggle = event.target.closest('#editCourseToggle');
        if (editCourseToggle) {
            event.preventDefault();
            const id = editCourseToggle.dataset.id;
            const response = await fetch(`/courses/${id}`);
            if (response.ok) {
                const data = await response.json();
                console.log(data);
                courseName.value = data.name;
                courseCode.value = data.code;
                duration.value = data.duration;
                fee.value = data.fees;
                levelOfStudy.value = data.level_of_study;
                description.value = data.description;
                courseId.value = data.id;
                const categoryOptions = document.getElementById('categoryId').options;
                for (let i = 0; i < categoryOptions.length; i++) {
                    if (categoryOptions[i].value == data.course_category_id) {
                        categoryOptions[i].selected = true;
                        break;
                    }
                }
            }
            $('#createCourseModal').modal('show');
        }
    });
});
