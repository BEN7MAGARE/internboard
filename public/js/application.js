(function () {
    const jobApplicationForm = $("#jobApplicationForm"),
        jobID = $("#jobID"),
        applicationReason = $("#applicationReason"),
        cover_letter = $("#cover_letter"),
        curriculumVitae = $("#curriculumVitae")[0],
        otherFiles = $("#otherFiles"),
        jobApplySubmit = $("#jobApplySubmit"),
        preferredPay = $("#applicationPrefferedPay"),
        editApplicationForm = $('#editApplicationForm');

    $("#curriculumVitae").on("change", function () {
        var file = this.files[0];
        var maxSize = 1024 * 1024 * 2;
        var allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
        if (file) {
            if (file.size > maxSize) {
                showError(
                    "File size exceeds the maximum allowed size." + maxSize,
                    "#cvError"
                );
                this.value = "";
            } else {
                if (allowedTypes.indexOf(file.type) === -1) {
                    showError(
                        "Invalid file type. Allowed types are: " +
                        allowedTypes.join(", "),
                        "#cvError"
                    );
                    this.value = "";
                } else {
                    $("#fileError").text("");
                }
            }
        }
    });

    otherFiles.on("change", function () {
        var input = $(this);
        var files = input[0].files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            var maxSize = 5 * 1024 * 1024;
            var allowedTypes = [
                "jpg",
                "jpeg",
                "png",
                "gif",
                "pdf",
                "doc",
                "docx",
            ];

            if (file.size > maxSize) {
                showError(
                    file.name + " exceeds the maximum file size." + maxSize,
                    "#filesError"
                );
                input.val("");
            } else {
                var fileType = file.name.split(".").pop().toLowerCase();
                if (allowedTypes.indexOf(fileType) === -1) {
                    showError(
                        file.name + " is not an allowed file type.",
                        "#filesError"
                    );
                    input.val("");
                }
            }
        }
    });

    if (jobApplicationForm) {
        jobApplicationForm.on("submit", function (event) {
            event.preventDefault();
            const data = new FormData(),
                $this = $(this), errors = [];
            let fileSize = 0;
            data.append("job_id", jobID.val());
            data.append("preferred_pay", preferredPay.val());
            data.append("reason", applicationReason.val());
            data.append("cover_letter", cover_letter.val());
            if (curriculumVitae) {
                data.append("curriculum_vitae", curriculumVitae.files[0]);
                if (curriculumVitae.files[0].size > 1024 * 1024 * 2) {
                    errors.push("Curriculum vitae is more than 2mb. ");
                }
            }
            jobApplySubmit.prop("disabled", true);
            if (otherFiles) {
                let files = otherFiles[0]?.files;
                if (files) {
                    for (var i = 0; i < files.length; i++) {
                        fileSize += files[i].size;
                        data.append("files[]", files[i]);
                    }
                }
            }
            if (applicationReason.val().length <= 5) {
                errors.push('Provide satisfactory reason for your application.');
            }
            if (cover_letter.val().length < 20) {
                errors.push("Provide satisfactory cover letter.")
            }
            if (errors.length > 0) {
                jobApplySubmit.prop("disabled", false);
                showError(errors.join(', '), '#applyFeedback');
            } else {
                jobApplySubmit.prop("disabled", true);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
                    },
                });
                $.ajax({
                    method: "POST",
                    url: "/job/apply",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (params) {
                        jobApplySubmit.prop("disabled", false);
                        let result = JSON.parse(params);
                        if (result.status === "success") {
                            showSuccess(result.message, "#applyFeedback");
                            $this.trigger("reset");
                        } else {
                            showError(result.message, "#advertFeedback");
                        }
                    },
                    error: function (error) {
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
                            let errorMessages = Object.values(errors).map(error => error[0]).join(', ');
                            showError(errorMessages, "#applyFeedback");
                        } else {
                            showError("Error occurred during processing", "#applyFeedback");
                        }
                        jobApplySubmit.prop("disabled", false);
                    },
                });
            }
        });
    }

    if (editApplicationForm) {
        editApplicationForm.on('submit', async function (event) {
            event.preventDefault();
            const data = new FormData(),
                $this = $(this), errors = [];
            let fileSize = 0;
            data.append("job_id", jobID.val());
            data.append("preferred_pay", preferredPay.val());
            data.append("reason", applicationReason.val());
            data.append("cover_letter", cover_letter.val());
            data.append("_method", "PUT");
            if (curriculumVitae) {
                data.append("curriculum_vitae", curriculumVitae.files[0]);
                if (curriculumVitae.files[0].size > 1024 * 1024 * 2) {
                    errors.push("Curriculum vitae is more than 2mb. ");
                }
            }
            jobApplySubmit.prop("disabled", true);
            if (otherFiles) {
                let files = otherFiles[0]?.files;
                if (files) {
                    for (var i = 0; i < files.length; i++) {
                        fileSize += files[i].size;
                        data.append("files[]", files[i]);
                    }
                }
            }
            if (applicationReason.val().length <= 5) {
                errors.push('Provide satisfactory reason for your application.');
            }
            if (cover_letter.val().length < 20) {
                errors.push("Provide satisfactory cover letter.")
            }
            const applicationid = document.getElementById('applicationID').value;
            if (errors.length > 0) {
                jobApplySubmit.prop("disabled", false);
                showError(errors.join(', '), '#applyFeedback');
            } else {
                jobApplySubmit.prop("disabled", true);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
                    },
                });
                $.ajax({
                    method: "POST",
                    url: "/applications/" + applicationid,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (params) {
                        jobApplySubmit.prop("disabled", false);
                        let result = JSON.parse(params);
                        console.log(result);
                        if (result.status === "success") {
                            showSuccess(result.message, "#applyFeedback");
                            // $this.trigger("reset");
                        } else {
                            showError(result.message, "#advertFeedback");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        jobApplySubmit.prop("disabled", false);
                        showError("Error occurred during processing", "#applyFeedback");
                    },
                });
            }
        });
    }

    const applicantsHireForm = $('#applicantsHireForm'),
        applicantSelectToggle = $('.applicantSelectToggle'),
        applicantsHireSubmit = $('#applicantsHireSubmit'),
        applicantsHireJobID = $('#applicantsHireJobID'),
        applicantsHireStartDate = $('#applicantsHireStartDate'),
        applicantsHireRateType = $('#applicantsHireRateType'),
        applicantsHireRateAmount = $('#applicantsHireRateAmount'),
        applicantsHireTerms = $('#applicantsHireTerms'),
        applicantsHireHireLetter = $('#applicantsHireHireLetter');

    if (applicantsHireForm) {
        applicantsHireForm.on('submit', function (event) {
            event.preventDefault();
            const $this = $(this), errors = [], applicants = [];
            
            applicantSelectToggle.each(function (key, item) {
                if ($(item).is(':checked')) {
                    applicants.push({ application_id: $(item).val() })
                }
            });
            applicantsHireSubmit.prop('disabled', true);
            const data = {
                job_id: applicantsHireJobID.val(),
                applicants: JSON.stringify(applicants),
                start_date: applicantsHireStartDate.val(),
                rate_type: applicantsHireRateType.val(),
                rate_amount: applicantsHireRateAmount.val(),
                terms: applicantsHireTerms.val(),
                hireLetter: applicantsHireHireLetter.val()
            }
            if (applicants.length <= 0) {
                errors.push("You have not selected applicants to hire");
            }
            if (errors.length > 0) {
                showError(errors.join(', '), '#applicantsHireFeedback');
                applicantsHireSubmit.prop('disabled', false);
            } else {
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
                    },
                });
                $.ajax({
                    method: "POST",
                    url: "/applications-hire",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (params) {
                        applicantsHireSubmit.prop("disabled", false);
                        let result = JSON.parse(params);
                        if (result.status === "success") {
                            showSuccess(result.message, "#applicantsHireFeedback");
                            $this.trigger("reset");
                        } else {
                            showError(result.message, "#applicantsHireFeedback");
                        }
                    },
                    error: function (error) {
                        applicantsHireSubmit.prop("disabled", false);
                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
                            let errorMessages = Object.values(errors).map(error => error[0]).join(', ');
                            showError(errorMessages, "#applicantsHireFeedback");
                        } else {
                            showError("Error occurred during processing", "#applicantsHireFeedback");
                        }
                    }
                });
            }
        });
    }

    document.addEventListener("click", async function (event) {
        const editApplicationToggle = event.target.closest('#editApplicationToggle');
        const deleteApplicationToggle = event.target.closest('#deleteApplicationToggle');
        if (editApplicationToggle) {
            event.preventDefault();
            const applicationId = editApplicationToggle.dataset.id;
            const response = await fetch(`/applications/${applicationId}`);
            const data = await response.json();
            if (response.ok) {
                console.log(data);
                document.getElementById('applicationReason').value = data.reason;
                document.getElementById('cover_letter').value = data.cover_letter;
                document.getElementById('applicationPrefferedPay').value = data.preferred_pay;
                document.getElementById('jobID').value = data.job_id;
                document.getElementById('applicationID').value = data.id;
                // document.getElementById('applicationCurriculumVitae').value = data.curriculum_vitae;
                // document.getElementById('applicationOtherFiles').value = data.other_files;
            }
        }

        if (deleteApplicationToggle) {
            event.preventDefault();
            const applicationId = deleteApplicationToggle.dataset.id;
            console.log(applicationId);
            const response = await fetch(`/applications/${applicationId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("input[name='_token']").value,
                }
            });
            if (response.ok) {
                showSuccess("Application deleted successfully", "#applyFeedback");
            }
        }

    });
})();
