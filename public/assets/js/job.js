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

    function getCategories() {
        console.log("hete");

        $.getJSON("/categories", function (categories) {
            console.log("hete");
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

    let JOB = {};

    let jobCreateForm = $("#jobCreateForm"),
        startButton = $("#startButton"),
        categoryID = $("#categoryID"),
        employmentType = $("#employmentType"),
        jobType = $("#jobType"),
        experienceLevel = $("#experienceLevel"),
        locationInput = $("#location");
    startButton.on("click", function (event) {
        event.preventDefault();
        let category_id = categoryID.val(),
            type = employmentType.val(),
            job_type = jobType.val(),
            experience_level = experienceLevel.val(),
            location = locationInput.val(),
            errors = [],
            $this = $(this),
            token = $("input[name='_token']").val();
        $this.prop({ disabled: true });

        if (category_id.length < 1) {
            errors.push("industry is required");
        }
        if (type.length < 1) {
            errors.push("employment type is required");
        }
        if (job_type.length < 1) {
            errors.push("job type is required");
        }
        if (experience_level.length < 1) {
            errors.push("experience level is required");
        }
        if (location.length < 1) {
            errors.push("location is required");
        }
        if (errors.length > 0) {
        } else {
            let data = {
                _token: token,
                category_id: category_id,
                type: type,
                job_type: job_type,
                experience_level: experience_level,
                location: location,
            };
            console.log(data);

            showSpiner("#jobFeedback");
            $.post("/jobs/start", data)
                .done(function (params) {
                    $this.prop({ disabled: false });
                    let result = JSON.parse(params);
                    removeSpiner("#jobFeedback");
                    if (result.status === "success") {
                        JOB = result.job;
                        jobCreateForm.prepend(
                            "<input type='hidden' id='jobID' value=" +
                                result.job.id +
                                ">"
                        );
                        $("#jobFormSection").html(
                            '<div class="col-md-12 form-group"><label for="educationLevel">Education Level</label><select name="education_level" id="educationLevel" class="form-select" required><option value="">Select One</option><option value="Certificate">Certificate</option><option value="Diploma">Diploma</option><option value="Degree">Degree</option><option value="Masters">Masters</option><option value="Doctorate">Doctorate</option></select></div><div class="col-md-12 form-group"><label for="skills">Skills</label><select name="skills" id="skills" class="form-select" required><option value="">Select One</option></select></div><div class="col-md-12 form-group"><label for="lastName">Salary range</label><input type="text" class="form-control form-control" name="salary_range" id="salaryRange" required></div><div class="col-md-12 form-group"><label for="title">Title</label><input type="text" class="form-control form-control" name="title" id="title" required></div><div class="col-md-12 form-group"><label for="description">Description</label><textarea name="description" id="description" class="form-control form-control-lg"></textarea></div><div class="col-md-12 form-group"><label for="description">Start Date</label><input type="date" name="start_date" id="startDate" class="form-control form-control-lg"></div>'
                        );
                        $("#toggleprevioussection").prop({ disabled: false });
                        $this.text("Submit");
                        $this.attr("type", "submit");
                    } else {
                        showError(
                            "An error occured during processing",
                            "#jobFeedback"
                        );
                    }
                    console.log(JOB);
                })
                .fail(function (error) {
                    console.error(error);
                    $this.prop({ disabled: false });
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
                });
        }

        let educationLevel = $("#educationLevel"),
            skillsInput = $("#skills"),
            salaryRange = $("#salaryRange"),
            titleInput = $("#title"),
            descriptionInput = $("#description"),
            startDate = $("#startDate");

        jobCreateForm.on("submit", function (event) {
            event.preventDefault();
            let $this = $(this),
                education_level = educationLevel.val(),
                skills = skillsInput.val(),
                salary_range = salaryRange.val(),
                title = titleInput.val(),
                description = descriptionInput.val(),
                start_date = startDate.val(),
                token = $this.find("input[name='_token']").val();

            let data = {
                _token: token,
                education_level: education_level,
                skills: skills,
                salary_range: salary_range,
                title: title,
                description: description,
                start_date: start_date,
            };
            $this.find("button[type='submit']").prop({ disabled: true });
            showSpiner("#jobFeedback");

            $.post('/jobs', data).done(function(params) {
                console.log(params);
                let result = JSON.parse(params);
                $this.find("button[type='submit']").prop({ disabled: false });
                removeSpiner("#jobFeedback");

                if (result.status === "success") {
                    showSuccess(result.message, "#jobFeedback");
                    window.location.href = '/jobs';
                } else {
                    showSuccess('An error occured during processing. Ensure all fields are filled and retry. ', "#jobFeedback");
                }
            }).fail(function(error) {
                console.log(error);
                $this.find("button[type='submit']").prop({ disabled: false });
                removeSpiner("#jobFeedback");
                if (error.status == 422) {
                    var errors = "";
                    $.each(error.responseJSON.errors, function (key, value) {
                        errors += value + "!";
                    });
                    showError(errors, "#jobFeedback");
                } else {
                    showError(
                        "Error occurred during processing",
                        "#jobFeedback"
                    );
                }
            })
        });
    });
})();
