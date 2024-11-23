(function () {
    function showSuccess(message, target) {
        iziToast.success({
            title: "OK",
            message: message,
            position: "center",
            timeout: 7000,
            target: target,
        });
    }

    function showError(message, target) {
        iziToast.error({
            title: "Error",
            message: message,
            position: "center",
            timeout: 7000,
            target: target,
        });
    }

    function showSpiner(target) {
        $(target).html(
            '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
        );
    }

    function removeSpiner(target) {
        $(target).children().remove();
    }

    $("#skills").select2({
        tags: true,
        tokenSeparators: [",", " "],
        maximumSelectionLength: 10,
    });

    function getCategories() {
        $.getJSON("/categories", function (categories) {
            let option = "<option value=''>Select One</option>";
            $.each(categories, function (key, value) {
                option +=
                    "<option value=" +
                    value.id +
                    ">" +
                    value.name +
                    "</option>";
            });
            $("#categoryID").html(option);
        });
    }

    getCategories();

    function getSkills() {
        $.getJSON("/skills", function (skills) {
            let option = "<option value=''>Select One</option>";
            $.each(skills, function (key, value) {
                option +=
                    "<option value=" +
                    value.id +
                    ">" +
                    value.name +
                    "</option>";
            });
            $("#skills").html(option);
        });
    }

    getSkills();

    const jobCreateForm = $("#jobCreateForm"),
        categoryID = $("#categoryID"),
        employmentType = $("#employmentType"),
        jobType = $("#jobType"),
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
        jobSubmit = $('#jobSubmit');

    categoryID.on('change', function () {
        JobObject.setItem("category_id", $(this).val());
    });
    employmentType.on('change', function () {
        JobObject.setItem("type", $(this).val());
    });
    jobType.on('change', function () {
        JobObject.setItem('job_type', $(this).val());
    });
    experienceLevel.on('change', function () {
        JobObject.setItem('experience_level', $(this).val());
    });
    locationInput.on('change', function () {
        JobObject.setItem('location', $(this).val());
    });
    educationLevel.on('change', function () {
        JobObject.setItem('education_level', $(this).val());
    });
    skillsInput.on('change', function () {
        JobObject.setItem('skills', $(this).val());
    });
    salaryRange.on('change', function () {
        JobObject.setItem('salary_range', $(this).val());
    });
    titleInput.on('change', function () {
        JobObject.setItem('title', $(this).val());
    });
    descriptionInput.on('change', function () {
        JobObject.setItem('description', $(this).val());
    });
    startDate.on('change', function () {
        JobObject.setItem('start_date', $(this).val());
    });
    noOfPositions.on('change', function () {
        JobObject.setItem("no_of_positions", $(this).val());
    });


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
            showSpiner("#jobFeedback");

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
                    removeSpiner("#jobFeedback");
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


})();
