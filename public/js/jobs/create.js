(function () {
    $("#skills").select2({
        tags: true,
        tokenSeparators: [",", " "],
        maximumSelectionLength: 10,
    });

    getEmployerOptions(['#jobEmployerID', '#searchEmployerID']);
    getSkillsOption('#skills');
    $("#skills").select2({
        dropdownParent: $("#skillsOptions"),
        tags: true,
        tokenSeparators: [",", " "],
        maximumSelectionLength: 10,
    });
    const jobCreateForm = $("#jobCreateForm"),
        categoryID = $("#categoryID"),
        employmentType = $("#employmentType"),
        experienceLevel = $("#experienceLevel"),
        locationInput = $("#location"),
        applicationEndDate = $('#applicationEndDate'),
        educationLevel = $("#educationLevel"),
        skillsInput = $("#skills"),
        salaryRange = $("#salaryRange"),
        titleInput = $("#title"),
        descriptionInput = $("#description"),
        startDate = $("#startDate"),
        noOfPositions = $("#noOfPositions"),
        startButton = $("#startButton"),
        JobObject = window.localStorage,
        jobSubmit = $('#jobSubmit'),
        jobEmployerID = document.getElementById('jobEmployerID'),
        jobCategoryID = document.getElementById('jobCategoryID'),
        jobSubCategoryID = document.getElementById('jobSubCategoryID'),
        jobTitle = document.getElementById('jobTitle'),
        jobDescription = document.getElementById('jobDescription'),
        jobSalaryRange = document.getElementById('jobSalaryRange'),
        jobNoOfPositions = document.getElementById('jobNoOfPositions'),
        jobApplicationEndDate = document.getElementById('jobApplicationEndDate'),
        jobStartDate = document.getElementById('jobStartDate'),
        jobExperienceLevel = document.getElementById('jobExperienceLevel'),
        jobEducationLevel = document.getElementById('jobEducationLevel'),
        jobLocation = document.getElementById('jobLocation'),
        jobType = document.getElementById('jobType'),
        jobSkills = document.getElementById('jobSkills');

    categoryID.on('change', function () {
        JobObject.setItem("category_id", $(this).val());
        getSubCategories($(this).val(), '#subcategoryID');
    });

    // employmentType.on('change', function () {
    //     JobObject.setItem("type", $(this).val());
    // });
    // jobType.on('change', function () {
    //     JobObject.setItem('job_type', $(this).val());
    // });
    // experienceLevel.on('change', function () {
    //     JobObject.setItem('experience_level', $(this).val());
    // });
    // locationInput.on('change', function () {
    //     JobObject.setItem('location', $(this).val());
    // });
    // educationLevel.on('change', function () {
    //     JobObject.setItem('education_level', $(this).val());
    // });
    // skillsInput.on('change', function () {
    //     JobObject.setItem('skills', $(this).val());
    // });
    // salaryRange.on('change', function () {
    //     JobObject.setItem('salary_range', $(this).val());
    // });
    // titleInput.on('change', function () {
    //     JobObject.setItem('title', $(this).val());
    // });
    // descriptionInput.on('change', function () {
    //     JobObject.setItem('description', $(this).val());
    // });
    // startDate.on('change', function () {
    //     JobObject.setItem('start_date', $(this).val());
    // });
    // noOfPositions.on('change', function () {
    //     JobObject.setItem("no_of_positions", $(this).val());
    // });


    startButton.on("click", function (event) {
        event.preventDefault();
        console.log("firt step");
        let $this = $(this),
            errors = [];
        if (JobObject.getItem("category_id").length < 1) {
            errors.push("Industry is required");
        }
        if (JobObject.getItem("type").length < 1) {
            errors.push("Employment type is required");
        }
        if (JobObject.getItem("job_type").length < 1) {
            errors.push("Job type is required");
        }
        if (JobObject.getItem("experience_level").length < 1) {
            errors.push("Experience level is required");
        }
        if (JobObject.getItem("location").length < 1) {
            errors.push("Location is required");
        }
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value;
            });
            showError(p, "#jobFeedback");
            $this.prop("disabled", false);
        } else {
            $(".step-1").hide();
            $(".step-2").show();
        }
    });

    applicationEndDate.on('change', function () {
        const today = new Date($(this).val());
        const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        console.log(formattedDate);
        startDate.attr('min', formattedDate);
    });

    jobCreateForm.on("submit", function (event) {

        event.preventDefault();
        let $this = $(this),
            submit = $this.find("button[type='submit']"), errors = [];
        jobSubmit.prop({ disabled: true });
        jobSubmit.text('Processing ..');
        if (JobObject.getItem("education_level").length < 1) {
            errors.push("Education level is required");
        }
        if (JobObject.getItem("skills").length < 1) {
            errors.push("Selct atleast one skill");
        }
        if (JobObject.getItem("salary_range").length < 1) {
            errors.push("Salary range is required");
        }
        if (JobObject.getItem("title").length < 1) {
            errors.push("Title is required");
        }
        if (JobObject.getItem("description").length < 1) {
            errors.push("Description is required");
        }

        if (JobObject.getItem("start_date").length < 1) {
            errors.push("Start date is required");
        }
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value;
            });
            showError(p, "#jobFeedback");
            jobSubmit.prop({ disabled: false });
            jobSubmit.html('<i class="fa fa-server"></i> Save');
        } else {
            let data = {
                _token: $this.find("input[name='_token']").val(),
                category_id: JobObject.getItem("category_id"),
                type: JobObject.getItem("type"),
                job_type: JobObject.getItem("job_type"),
                experience_level: JobObject.getItem("experience_level"),
                location: JobObject.getItem("location"),
                education_level: JobObject.getItem("education_level"),
                skills: JSON.stringify(JobObject.getItem("skills")),
                salary_range: JobObject.getItem("salary_range"),
                title: JobObject.getItem("title"),
                description: JobObject.getItem("description"),
                application_end_date: applicationEndDate.val(),
                start_date: JobObject.getItem("start_date"),
                no_of_positions: JobObject.getItem("no_of_positions"),
            };
            $.post("/jobs", data)
                .done(function (params) {
                    jobSubmit.prop({ disabled: false });
                    jobSubmit.html('<i class="fa fa-server"></i> Save');
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#jobFeedback");
                        localStorage.clear();
                        window.location.href = '/profile-jobs';
                    } else {
                        showError(
                            "An error occured during processing",
                            "#jobFeedback"
                        );
                    }
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                })
                .fail(function (error) {
                    jobSubmit.prop({ disabled: false });
                    jobSubmit.html('<i class="fa fa-server"></i> Save');
                    if (error.status == 422) {
                        var errors = "";
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errors += value + "!";
                            }
                        );
                        showError(errors, "#jobFeedback");
                    } else {
                        showError(
                            "Error occurred during processing",
                            "#jobFeedback"
                        );
                    }
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                });
        }
    });

    $("#toggleprevioussection").on('click', function (event) {
        $(".step-1").show();
        $(".step-2").hide();
    });

    jobCategoryID.addEventListener('change', function () {
        getSubCategories(this.value, '#jobSubCategoryID');
    });

    const searchJobForm = document.getElementById('searchJobForm');

    searchJobForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const data = new FormData(this);
        console.log(Object.fromEntries(data.entries()));
        const csrfToken = document.querySelector("input[name='_token']").value;
        data.append('_token', csrfToken);
        const response = await fetch('/jobs-json-search', {
            method: 'POST',
            body: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            }
        });
        if (response.ok) {
            const result = await response.json();
            console.log(result);
            let jobList = document.getElementById('jobList'),
                jobPagination = document.getElementById('jobPagination');
            let tr = "", i = 1;
            for (let index = 0; index < result.length; index++) {
                const element = result[index];
                tr += `
                <tr>
                    <th><input type="checkbox" name="job_id[]" value="${element.id}"></th>
                    <th scope="row">${i++}</th>
                    <td>${element.ref_no}</td>
                    <td>${element.type}</td>
                    <td>${element.job_type}</td>
                    <td>${element.experience_level}</td>
                    <td>${element.location}</td>
                    <td>${element.education_level}</td>
                    <td>${element.title}</td>
                    <td>${element.application_end_date}</td>
                    <td>${element.start_date}</td>
                    <td>${element.salary_range}</td>
                    <td>${element.no_of_positions}</td>
                    <td>
                        <button href="#" id="editJobToggle"
                            data-bs-toggle="modal" data-bs-target="#createJobModal"
                            data-id="${element.id}"><i class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
                `;
            }
            $("#jobList").html(tr);
            $('#jobPagination').html('');
        } else {
            console.log(response);
        }
    });

    const createJobForm = document.getElementById('createJobForm');
    createJobForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const data = new FormData(this);
        const csrfToken = document.querySelector("input[name='_token']").value;
        data.append('_token', csrfToken);
        const response = await fetch('/jobs', {
            method: 'POST',
            body: data,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });
        if (response.ok) {
            const result = await response.json();
            if (result.status === "success") {
                showSuccess(result.message, "#jobFeedback");
                createJobForm.reset();
            } else {
                showError(result.message, "#jobFeedback");
            }
        } else if (response.status === 422) {
            const errorData = await response.json();
            let errors = '';
            for (const key in errorData.errors) {
                errors += errorData.errors[key].join(' ') + '!<br>';
            }
            showError(errors, "#jobFeedback");
        } else if (response.status === 419) {
            showError("You are not logged in", "#jobFeedback");
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        } else {
            showError("Error occurred during processing", "#jobFeedback");
        }
    });

    document.addEventListener('click', function (event) {
        const editJobToggle = event.target.closest('#editJobToggle');
        if (editJobToggle) {
            event.preventDefault();
            const jobId = editJobToggle.dataset.id;
            console.log(jobId);
            const response = fetch(`/jobs/${jobId}`)
                .then(response => response.json())
                .then(data => {
                    const employerOption = document.querySelector(
                        '#jobEmployerID option[value="' + data.corporate_id + '"]'
                    );
                    if (employerOption) {
                        employerOption.selected = true;
                    }
                    jobTitle.value = data.title;
                    jobDescription.value = data.description;
                    jobSalaryRange.value = data.salary_range;
                    jobNoOfPositions.value = data.no_of_positions;
                    jobApplicationEndDate.value = data.application_end_date;
                    jobStartDate.value = data.start_date;
                    const categoryOption = document.querySelector(
                        '#jobCategoryID option[value="' + data.category_id + '"]'
                    );
                    if (categoryOption) {
                        categoryOption.selected = true;
                    }
                    const subCategoryOption = document.querySelector(
                        '#jobSubCategoryID option[value="' + data.sub_category_id + '"]'
                    );
                    if (subCategoryOption) {
                        subCategoryOption.selected = true;
                    }
                    jobExperienceLevel.value = data.experience_level;
                    const educationLevelOption = document.querySelector(
                        '#jobEducationLevel option[value="' + data.education_level + '"]'
                    );
                    if (educationLevelOption) {
                        educationLevelOption.selected = true;
                    }
                    jobLocation.value = data.location;

                    jobType.value = data.type;
                    const jobTypeOption = document.querySelector(
                        '#jobType option[value="' + data.type + '"]'
                    );
                    if (jobTypeOption) {
                        jobTypeOption.selected = true;
                    }
                    const jobJobTypeOption = document.querySelector(
                        '#jobJobType option[value="' + data.job_type + '"]'
                    );
                    if (jobJobTypeOption) {
                        jobJobTypeOption.selected = true;
                    }
                    const skillsSelect = document.getElementById("skills");
                    const selectedSkills = data.skills;
                    Array.from(skillsSelect.options).forEach(option => {
                        option.selected = selectedSkills.includes(option.value);
                    });
                })
                .catch(error => console.error(error));
        }

    })

})();
