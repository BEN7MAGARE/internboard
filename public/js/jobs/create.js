(function () {
    getCategoriesOptions(['#categoryIDOptions', '#categoryID', '#jobCategoryID', '#searchJobCategoryID', "#skillCategoryID"]);
    getEmployerOptions(['#jobEmployerID', '#searchEmployerID']);
    getSkillsOption('#skills');

    const jobCreateForm = document.getElementById('jobCreateForm'),
        categoryID = document.getElementById('categoryID'),
        employmentType = document.getElementById('employmentType'),
        experienceLevel = document.getElementById('experienceLevel'),
        locationInput = document.getElementById('location'),
        applicationEndDate = document.getElementById('applicationEndDate'),
        educationLevel = document.getElementById('educationLevel'),
        skillsInput = document.getElementById('skillsInput'),
        salaryRange = document.getElementById('salaryRange'),
        titleInput = document.getElementById('title'),
        descriptionInput = document.getElementById('description'),
        startDate = document.getElementById('startDate'),
        noOfPositions = document.getElementById('noOfPositions'),
        startButton = document.getElementById('startButton'),
        jobSubmit = document.getElementById('jobCreateForm'),
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
        jobSkills = document.getElementById('jobSkills'),
        createJobModal = document.getElementById('createJobModal'),
        addQualificationToggle = document.getElementById('addQualificationToggle'),
        addRequirementToggle = document.getElementById('addRequirementToggle'),
        jobQualification = document.getElementById('jobQualification'),
        jobRequirement = document.getElementById('jobRequirement'),
        jobQualificationsTableBody = document.getElementById('jobQualificationsTableBody'),
        jobRequirementsTableBody = document.getElementById('jobRequirementsTableBody'),
        createSkillForm = document.getElementById('createSkillForm');

    if (categoryID) {
        categoryID.addEventListener('change', function () {
            getSubCategories(this.value, '#subcategoryID');
            getCategorySkills(this.value, '#skills');
        });
    }

    if (createJobModal) {
        $("#skills").select2({
            dropdownParent: $("#skillsOptions"),
            tags: true,
            tokenSeparators: [",", " "],
            maximumSelectionLength: 10,
        });
    } else {
        $("#skills").select2({
            tags: true,
            tokenSeparators: [",", " "],
            maximumSelectionLength: 10,
        });
    }

    if (startButton) {
        startButton.addEventListener("click", function (event) {
            event.preventDefault();
            let $this = $(this),
                errors = [];
            if (categoryID.value === "") {
                errors.push("Industry is required");
            }
            if (employmentType.value === "") {
                errors.push("Employment type is required");
            }
            if (jobType.value === "") {
                errors.push("Job type is required");
            }
            if (experienceLevel.value === "") {
                errors.push("Experience level is required");
            }
            if (locationInput.value === "") {
                errors.push("Location is required");
            }
            if (errors.length > 0) {
                let p = "";
                $.each(errors, function (key, value) {
                    p += value;
                });
                showError(p, "#step1Feedback");
                $this.prop("disabled", false);
            } else {
                $(".step-1").hide();
                $(".step-2").show();
            }
        });
    }

    async function getCategorySkills(categoryID, skillsInput) {
        const response = await fetch(`/skills-by-category/${categoryID}`);
        if (response.ok) {
            const result = await response.json();
            skillsInput.innerHTML = result.map(skill => `<option value="${skill.id}">${skill.name}</option>`).join('');
        }
    }

    const toggleStep2 = document.querySelectorAll('.toggleStep2');
    toggleStep2.forEach(function (toggleStep2) {
        toggleStep2.addEventListener('click', function (event) {
            event.preventDefault();
            $(".step-2").show();
            $(".step-1").hide();
            $(".step-3").hide();
        });
    });

    const toggleStep1 = document.querySelectorAll('.toggleStep1');
    toggleStep1.forEach(function (toggleStep1) {
        toggleStep1.addEventListener('click', function (event) {
            event.preventDefault();
            $(".step-1").show();
            $(".step-2").hide();
            $(".step-3").hide();
        });
    });

    const toggleStep3 = document.querySelectorAll('.toggleStep3');
    toggleStep3.forEach(function (toggleStep3) {
        toggleStep3.addEventListener('click', function (event) {
            event.preventDefault(), errors = [];
            educationLevel.value === "" ? errors.push("Education level is required") : null;
            salaryRange.value === "" ? errors.push("Salary range is required") : null;
            titleInput.value === "" ? errors.push("Title is required") : null;
            // descriptionInput.value === "" ? errors.push("Description is required") : null;
            noOfPositions.value === "" ? errors.push("No of positions is required") : null;
            // applicationEndDate.value === "" ? errors.push("Application end date is required") : null;
            // startDate.value === "" ? errors.push("Start date is required") : null;
            if (errors.length > 0) {
                let p = "";
                $.each(errors, function (key, value) {
                    p += value;
                });
                showError(p, "#step2Feedback");
                $this.prop("disabled", false);
            } else {
                $(".step-2").hide();
                $(".step-1").hide();
                $(".step-3").show();
            }
        });
    });

    if (applicationEndDate) {
        applicationEndDate.addEventListener('change', function () {
            const today = new Date(this.value);
            const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
            startDate.setAttribute('min', formattedDate);
        });
    }

    const toggleprevioussection = document.getElementById('toggleprevioussection');
    if (toggleprevioussection) {
        toggleprevioussection.addEventListener('click', function (event) {
            $(".step-1").show();
            $(".step-2").hide();
        });
    }

    if (jobCategoryID) {
        jobCategoryID.addEventListener('change', function () {
            getSubCategories(this.value, '#jobSubCategoryID');
        });
    }

    const searchJobForm = document.getElementById('searchJobForm');
    if (searchJobForm) {
        searchJobForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const data = new FormData(this);
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
    }

    const createJobForm = document.getElementById('createJobForm');
    if (createJobForm) {
        createJobForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const data = new FormData(this),
                csrfToken = document.querySelector("input[name='_token']").value,
                requirements = [],
                qualifications = [];

            data.append('_token', csrfToken);

            jobQualificationsTableBody.querySelectorAll('tr').forEach(function (tr) {
                qualifications.push(tr.querySelector('td:first-child').textContent);
            });

            jobRequirementsTableBody.querySelectorAll('tr').forEach(function (tr) {
                requirements.push(tr.querySelector('td:first-child').textContent);
            });

            data.append('requirements', JSON.stringify(requirements));
            data.append('qualifications', JSON.stringify(qualifications));

            console.log(Object.fromEntries(data.entries()));
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
                    jobQualificationsTableBody.innerHTML = '';
                    jobRequirementsTableBody.innerHTML = '';
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
    }

    document.addEventListener('click', function (event) {
        const editJobToggle = event.target.closest('#editJobToggle');
        if (editJobToggle) {
            event.preventDefault();
            const jobId = editJobToggle.dataset.id;
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
    });

    if (addQualificationToggle) {
        addQualificationToggle.addEventListener('click', function () {
            const qualification = jobQualification.value;
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>${qualification}</td><td><button type="button" class="btn btn-danger btn-sm" id="deleteQualificationToggle"><i class="bi bi-trash"></i></button></td>`;
            jobQualificationsTableBody.append(tr);
            jobQualification.value = '';
            document.addEventListener('click', function (event) {
                const deleteQualificationToggle = event.target.closest('#deleteQualificationToggle');
                if (deleteQualificationToggle) {
                    event.preventDefault();
                    deleteQualificationToggle.closest('tr').remove();
                }
            });
        });
    }

    if (addRequirementToggle) {
        addRequirementToggle.addEventListener('click', function () {
            const requirement = jobRequirement.value,
                tr = document.createElement('tr');
            tr.innerHTML = `<td>${requirement}</td><td><button type="button" class="btn btn-danger btn-sm" id="deleteRequirementToggle"><i class="bi bi-trash"></i></button></td>`;
            jobRequirementsTableBody.append(tr);
            jobRequirement.value = '';
            document.addEventListener('click', function (event) {
                const deleteRequirementToggle = event.target.closest('#deleteRequirementToggle');
                if (deleteRequirementToggle) {
                    event.preventDefault();
                    deleteRequirementToggle.closest('tr').remove();
                }
            });
        });
    }
    if (createSkillForm) {


        createSkillForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const data = new FormData(this);
            const response = await fetch('/skills', {
                method: 'POST',
                body: data,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector("input[name='_token']").value,
                    'Accept': 'application/json'
                }
            });
            if (response.ok) {
                const result = await response.json();
                if (result.status === "success") {
                    getSkillsOption('#skills');
                    showSuccess(result.message, "#skillFeedback");
                } else {
                    showError(result.message, "#skillFeedback");
                }
            } else if (response.status === 422) {
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#skillFeedback");
            } else if (response.status === 419) {
                showError("You are not logged in", "#skillFeedback");
            } else {
                showError("Error occurred during processing", "#skillFeedback");
            }
        });
    }

    if (document.getElementById('allJobSelect')) {
        document.getElementById('allJobSelect').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[name="job_id[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    }

    const approveJob = document.getElementById('approveJob');
    const allJobSelect = document.getElementById('allJobSelect');
    const jobSelect = document.getElementById('jobSelect');
    if (approveJob) {
        approveJob.addEventListener('click', async function (event) {
            event.preventDefault();
            const checkedBoxes = document.querySelectorAll('input[name="job_id[]"]:checked');
            const ids = Array.from(checkedBoxes).map(checkbox => checkbox.value);
            console.log(ids);

            const response = await fetch('jobs-approve', {
                method: 'POST',
                body: JSON.stringify({ ids: ids }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
            });
            if (response.ok) {
                const result = await response.json();
                if (result.status === "success") {
                    showSuccess(result.message, "#jobActionsFeedback");
                } else {
                    showError(result.message, "#jobActionsFeedback");
                }
            } else {
                const error = await response.json();
                console.log(error);
                showError("Error occurred during processing", "#jobActionsFeedback");
            }
        });
    }

})();
