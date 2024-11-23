(function () {
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

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

    const jobApplicationForm = $("#jobApplicationForm"),
        jobID = $("#jobID"),
        applicationReason = $("#applicationReason"),
        cover_letter = $("#cover_letter"),
        curriculumVitae = $("#curriculumVitae")[0],
        otherFiles = $("#otherFiles");

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

    jobApplicationForm.on("submit", function (event) {
        event.preventDefault();
        const data = new FormData(),
            $this = $(this), errors = [];
        let fileSize = 0;
        data.append("job_id", jobID.val());
        data.append("reason", applicationReason.val());
        data.append("cover_letter", cover_letter.val());
        console.log(curriculumVitae);
        data.append("curriculum_vitae", curriculumVitae.files[0]);
        let files = otherFiles[0].files;
        if (curriculumVitae.files[0].size > 1024 * 1024 * 2) {
            errors.push("Curriculum vitae is more than 2mb. ");
        }
        for (var i = 0; i < files.length; i++) {
            fileSize += files[i].size;
            data.append("files[]", files[i]);
        }
        if (applicationReason.val().length <= 5) {
            errors.push('Provide satisfactory reason for your application.');
        }
        if (cover_letter.val().length < 20) {
            errors.push("Provide satisfactory cover letter.")
        }
        if (errors.length > 0) {
            showError(errors.join(', '), '#applyFeedback');
        } else {
            showSpiner("#applyFeedback");
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
                    console.log(params);
                    removeSpiner("#applyFeedback");
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#applyFeedback");
                        $this.trigger("reset");
                    } else {
                        showError(result.message, "#advertFeedback");
                    }
                },
                error: function (error) {
                    console.error(error);
                    removeSpiner("#applyFeedback");
                    showError("Error occurred during processing", "#applyFeedback");
                },
            });
        }
    });
})();
