document.addEventListener('DOMContentLoaded', function () {

    getCoursesOptions(['#courseId', '#studentFilterCourse']);

    const studentCreateForm = document.getElementById('studentCreateForm'),
        studentFilterForm = document.getElementById('studentFilterForm'),
        createStudentToggle = document.getElementById('createStudentToggle'),
        editStudentToggle = document.getElementById('editStudentToggle'),
        allStudentSelect = document.getElementById('allStudentSelect'),
        exportStudent = document.getElementById('exportStudent'),
        deleteStudent = document.getElementById('deleteStudent');

    createStudentToggle.addEventListener('click', function () {
        document.getElementById('userID').value = "";
        document.getElementById('studentID').value = "";
        studentCreateForm.reset();
    });

    allStudentSelect.addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="student_id[]"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });

    getCountiesOptions('#homeCountyId');
    if (document.getElementById('collegeId')) {
        getCollegesOptions(['#collegeId', '#studentFilterCollegeID']);
        getCoursesOptions(['#courseId', '#studentFilterCourse']);
    }

    studentCreateForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(this),
            csrfToken = document.querySelector("input[name='_token']").value,
            errors = [];
        if (formData.get('sponsored') === 'on') {
            formData.set('sponsored', 1);
        } else {
            formData.set('sponsored', 0);
        }
        if (formData.get('phone') !== null || formData.get('phone') !== "") {
            if (formData.get('phone').length < 10 || !isValidKenyanPhone(formData.get('phone'))) {
                errors.push("Invalid phone number");
            }
        }
        if (formData.get('kin_phone') !== null || formData.get('kin_phone') !== "") {
            if (formData.get('kin_phone').length < 10 || !isValidKenyanPhone(formData.get('kin_phone'))) {
                errors.push("Invalid kin phone number");
            }
        }
        if (formData.get('kin_email') !== null || formData.get('kin_email') !== "") {
            if (formData.get('kin_email').length < 2 || !isValidEmail(formData.get('kin_email'))) {
                errors.push("Invalid kin email");
            }
        }
        if (errors.length > 0) {
            showError(errors.join('!\u003cbr\u003e'), "#studentFeedback");
            return;
        } else {
            try {
                const response = await fetch('/students/store', {
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
        }
    });

    document.addEventListener('click', async function (event) {
        const editStudentToggle = event.target.closest('#editStudentToggle');
        if (editStudentToggle) {
            event.preventDefault();
            const studentId = editStudentToggle.getAttribute('data-id');
            const response = await fetch(`/students/${studentId}`);

            if (response.ok) {
                const data = await response.json();

                document.getElementById('userID').value = data.id;
                document.getElementById('studentFirstName').value = data.first_name;
                document.getElementById('studentMiddleName').value = data.middle_name;
                document.getElementById('studentLastName').value = data.last_name;
                document.getElementById('studentEmail').value = data.email;
                document.getElementById('studentPhone').value = data.phone;
                document.getElementById('studentAddress').value = data.address;
                const studentGenderOptions = document.getElementById('studentGender').options;
                for (let i = 0; i < studentGenderOptions.length; i++) {
                    if (studentGenderOptions[i].value == data.gender) {
                        studentGenderOptions[i].selected = true;
                        break;
                    }
                }
                const studentTitleOptions = document.getElementById('studentTitle').options;
                for (let i = 0; i < studentTitleOptions.length; i++) {
                    if (studentTitleOptions[i].value == data.title) {
                        studentTitleOptions[i].selected = true;
                        break;
                    }
                }
                const courseOptions = document.getElementById('courseId').options;                
                for (let i = 0; i < courseOptions.length; i++) {                    
                    if (courseOptions[i].value == data.student.course_id) {
                        courseOptions[i].selected = true;
                        break;
                    }
                }
                if (document.getElementById('collegeId')) {
                    const collegeOptions = document.getElementById('collegeId').options;
                    for (let i = 0; i < collegeOptions.length; i++) {
                        if (collegeOptions[i].value == data.college_id) {
                            collegeOptions[i].selected = true;
                            break;
                        }
                    }
                }
                if (document.getElementById('homeCountyId')) {
                    const countyOptions = document.getElementById('homeCountyId').options;
                    for (let i = 0; i < countyOptions.length; i++) {
                        if (countyOptions[i].value == data.student.county_id) {
                            countyOptions[i].selected = true;
                            break;
                        }
                    }
                }
                if (document.getElementById('yearOfStudy')) {
                    const yearOfStudyOptions = document.getElementById('yearOfStudy').options;
                    for (let i = 0; i < yearOfStudyOptions.length; i++) {
                        if (yearOfStudyOptions[i].value == data.student.year_of_study) {
                            yearOfStudyOptions[i].selected = true;
                            break;
                        }
                    }
                }
                if (document.getElementById('level_of_study')) {
                    const levelOfStudyOptions = document.getElementById('level_of_study').options;
                    for (let i = 0; i < levelOfStudyOptions.length; i++) {
                        if (levelOfStudyOptions[i].value === data.student.level_of_study) {
                            levelOfStudyOptions[i].selected = true;
                            break;
                        }
                    }
                }
                if (data.student !== null) {
                    document.getElementById('studentID').value = data.student.id;
                    document.getElementById('studentIdNumber').value = data.student.id_no;
                    document.getElementById('regNumber').value = data.student.reg_number;
                    document.getElementById('kinName').value = data.student.kin_name;
                    document.getElementById('kinPhone').value = data.student.kin_phone;
                    document.getElementById('kinEmail').value = data.student.kin_email;
                    let kinRelationshipOptions = document.getElementById('kinRelationship').options;
                    for (let i = 0; i < kinRelationshipOptions.length; i++) {
                        if (kinRelationshipOptions[i].value === data.student.kin_relationship) {
                            kinRelationshipOptions[i].selected = true;
                            break;
                        }
                    }
                    if (document.getElementById('admisionNumber')) {
                        document.getElementById('admisionNumber').value = data.student.admision_number;
                    }
                    const courseLevelOptions = document.getElementById('courseLevel').options;
                    for (let i = 0; i < courseLevelOptions.length; i++) {
                        if (courseLevelOptions[i].value === data.student.course_level) {
                            courseLevelOptions[i].selected = true;
                            break;
                        }
                    }
                    if (data.student.sponsored) {
                        document.getElementById('studentSponsored').checked = true;
                    } else {
                        document.getElementById('studentSponsored').checked = false;
                    }
                }
            }
        }
    });

    studentFilterForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const response = await fetch('/students/filter', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("input[name='_token']").value,
            },
            body: formData,
        });
        if (response.ok) {
            const data = await response.json();
            document.getElementById('studentTableBody').innerHTML = "";
            document.getElementById('studentPagination').innerHTML = "";
            let j = 1;
            for (let i = 0; i < data.length; i++) {
                const element = data[i];
                // const row = document.createElement('tr');
                // row.innerHTML = `
                //     <td>${element.id}</td>
                //     <td>${element.first_name}</td>
                //     <td>${element.last_name}</td>
                //     <td>${element.email}</td>
                //     <td>${element.phone}</td>
                //     <td>${element.address}</td>
                //     <td>${element.gender}</td>
                //     <td>${element.title}</td>
                //     <td>${element.college.name}</td>
                //     <td>${element.student.course.name}</td>
                //     <td>${element.student.id_no}</td>
                //     <td>${element.student.reg_number}</td>
                //     <td>${element.student.kin_name}</td>
                //     <td>${element.student.kin_phone}</td>
                //     <td>${element.student.kin_email}</td>
                //     <td>${element.student.kin_relationship}</td>
                //     <td>${element.student.admision_number}</td>
                //     <td>${element.student.course_level}</td>
                //     <td>${element.student.sponsored ? 'Yes' : 'No'}</td>
                //     <td>${element.student.year_of_study}</td>
                // `;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                                    <td><input type="checkbox" name="student_id[]" value="${element.id}"></td>
                                    <td>${j++}</td>
                                    <td>${element.student.admision_number}</td>
                                    <td>${element.first_name + ' ' + element.last_name}</td>
                                    <td>${element.email}</td>
                                    <td>${element.phone}</td>
                                    <td>${element.gender}</td>
                                    <td>${element.college.name}</td>
                                    <td>${element.student.course.name}</td>
                                    <td>${element.student.reg_number}</td>
                                    <td>${element.student.year_of_study}</td>
                                    <td class="d-flex gap-2">
                                        <a href="${'/student/' + element.id}" target="_blank"
                                            class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i></a>
                                        <a href="#" target="_blank" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createStudentModal" id="editStudentToggle" data-id="${element.id}"><i class="bi bi-pencil-square"></i></a>
                                    </td>`;
                document.getElementById('studentTableBody').appendChild(tr);
            }
        }
    });

    exportStudent.addEventListener('click', async function (event) {
        event.preventDefault();
        const formData = new FormData(studentFilterForm);
        const response = await fetch('/students/export', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("input[name='_token']").value,
            },
            body: formData,
        });
        if (response.ok) {
            const data = await response.json();
            console.log(data);
        }
    });
});
