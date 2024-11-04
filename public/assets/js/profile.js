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
            $("#skillsSelect").html(option);

            $("#skillsSelect").select2({
                tags: true,
                tokenSeparators: [",", " "],
                maximumSelectionLength: 10,
                dropdownParent: $("#updateProdileDetailsModal"),
            });
        });
    }
    getSkills();


    const profileUpdateForm = $("#profileUpdateForm"),
        firstName = $("#firstName"),
        lastName = $("#lastName"),
        studentTitle = $('#studentTitle'),
        studentFirstName = $('#studentFirstName'),
        studentLastName = $('#studentLastName'),
        title = $("#title"),
        jobTittle = $('#jobTittle'),
        jobCompanyName = $('#jobCompanyName'),
        jobStartDate = $('#jobStartDate'),
        jobEndDate = $('#jobEndDate'),
        jobAddToggle = $('#jobAddToggle'),
        jobsListSection = $('#jobsListSection'),

        educationCourse = $('#educationCourse'),
        educationInstitution = $('#educationInstitution'),
        educationLevel = $('#educationLevel'),
        educationStartDate = $('#educationStartDate'),
        educationEndDate = $('#educationEndDate'),
        educationAddToggle = $('#educationAddToggle'),
        educationListSection = $('#educationListSection'),
        specialization = $("#specialization"),

        summary = $("#summary"),
        Address = $("#Address"),
        Phone = $("#Phone"),
        Email = $("#Email"),
        Twitter = $("#Twitter"),
        Facebook = $("#Facebook"),
        Instagram = $("#Instagram"),
        Linkedin = $("#Linkedin"),

        studentAddress = $('#studentAddress'),
        studentPhone = $('#studentPhone'),
        studentEmail = $('#studentEmail'),
        studentTwitter = $('#studentTwitter'),
        studentFacebook = $('#studentFacebook'),
        studentInstagram = $('#studentInstagram'),
        studentLinkedin = $('#studentLinkedin'),

        studentProfileImage = $("#studentProfileImage")[0],
        ProfileInformation = window.sessionStorage,
        jobLevel = $("#jobLevel"),
        yearsOfExperience = $("#yearsOfExperience"),
        skills = $("#skillsSelect"),

        userUpdateForm = $('#userUpdateForm'),
        userId = $('#userId'),
        userphone = $('#userphone'),
        useremail = $('#useremail'),
        userAddress = $('#userAddress'),
        profilePhoto = $('#userProfilePhoto')[0];



    firstName.on("change", function () {
        ProfileInformation.setItem("first_name", $(this).val());
    });
    lastName.on("change", function () {
        ProfileInformation.setItem("last_name", $(this).val());
    });
    title.on("change", function () {
        ProfileInformation.setItem("title", $(this).val());
    });
    educationLevel.on("change", function () {
        ProfileInformation.setItem("education_level", $(this).val());
    });
    specialization.on("change", function () {
        ProfileInformation.setItem("specialization", $(this).val());
    });
    summary.on("change", function () {
        ProfileInformation.setItem("summary", $(this).val());
    });
    studentAddress.on("change", function () {
        ProfileInformation.setItem("address", $(this).val());
    });
    Phone.on("change", function () {
        ProfileInformation.setItem("phone", $(this).val());
    });
    Email.on("change", function () {
        ProfileInformation.setItem("email", $(this).val());
    });
    Twitter.on("change", function () {
        ProfileInformation.setItem("twitter", $(this).val());
    });
    Facebook.on("change", function () {
        ProfileInformation.setItem("facebook", $(this).val());
    });
    Instagram.on("change", function () {
        ProfileInformation.setItem("instagram", $(this).val());
    });
    Linkedin.on("change", function () {
        ProfileInformation.setItem("linkedin", $(this).val());
    });

    yearsOfExperience.on("change", function () {
        ProfileInformation.setItem("years_of_experience", $(this).val());
    });
    skills.on("change", function () {
        ProfileInformation.setItem("skills", $(this).val());
    });

    $("#ProfileImage").on("change", function () {
        var file = this.files[0];
        var maxSize = 1024 * 1024 * 2;
        var allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
        if (file) {
            if (file.size > maxSize) {
                showError(
                    "File size exceeds the maximum allowed size." + maxSize,
                    "#imageError"
                );
                this.value = "";
            } else {
                if (allowedTypes.indexOf(file.type) === -1) {
                    showError(
                        "Invalid file type. Allowed types are: " +
                        allowedTypes.join(", "),
                        "#imageError"
                    );
                    this.value = "";
                }
            }
        }
    });

    jobAddToggle.on('click', function (event) {
        event.preventDefault();
        const data = {
            title: jobTittle.val(),
            company: jobCompanyName.val(),
            start_date: jobStartDate.val(),
            end_date: jobEndDate.val()
        }, errors = [];
        if (data.title == "" || data.title.length < 3) {
            errors.push('Provide a valid Job Title');
        }
        if (data.company == "" || data.company.length < 3) {
            errors.push('Provide a valid company name');
        }
        if (data.start_date == "") {
            errors.push('Provide a valid start date');
        }
        if (errors.length > 0) {
            showError(errors.join(', '), '#jobsAddFeedback')
        } else {
            jobsListSection.append(`<div class="jobExperience row p-2">
            <div class="col-md-4"><p class="title">${data.title}</p></div>
            <div class="col-md-4"><p class="company">${data.company}</p></div>
            <div class="col-md-3"><p><span class="startDate">${data.start_date}</span> - <span class="endDate">${data.end_date}</span></p></div>
            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm" id="deleteJobToggle"><i class="bi bi-trash-fill"></i></button></div>
            </div>`);
            jobTittle.val("");
            jobCompanyName.val("");
            jobStartDate.val("");
            jobEndDate.val("");
        }
    });

    $('body').on('click', '#deleteJobToggle', function (event) {
        event.preventDefault();
        $(this).parents().closest('.jobExperience').remove();
    });

    educationAddToggle.on('click', function (event) {
        event.preventDefault();
        const data = {
            course: educationCourse.val(),
            institution: educationInstitution.val(),
            level: educationLevel.val(),
            start_date: educationStartDate.val(),
            end_date: educationEndDate.val(),
        }, errors = [];
        if (data.course == "" || data.course < 3) {
            errors.push("Valid course is required");
        }
        if (data.level == "") {
            errors.push("Valid course leve is required");
        }
        if (data.start_date == "") {
            errors.push("Start date is required");
        }
        if (errors.length > 0) {
            showError(errors.join(', '), '#educationFeedback')
        } else {
            educationListSection.append(`<div class="educationExperience row  p-2">
            <div class="col-md-4"><p class="title p-0 m-0"><span class="level">${data.level}</span>&nbsp;<span class="course">${data.course}</span></p></div>
            <div class="col-md-4"><p class="institution  p-0 m-0">${data.institution}</p></div>
            <div class="col-md-3"><p class="p-0 m-0"><span class="startDate">${data.start_date}</span> - <span class="endDate">${data.end_date}</span></p></div>
            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm" id="deleteEducationToggle"><i class="bi bi-trash-fill"></i></button></div>
            </div>`)
            educationCourse.val("")
            educationInstitution.val("")
            educationLevel.val("")
            educationStartDate.val("")
            educationEndDate.val("")
        }
    });

    profileUpdateForm.on("submit", function (event) {
        event.preventDefault();
        const data = new FormData(),
            $this = $(this), education = [], work = [];

        if ($('.educationExperience') !== undefined && $('.educationExperience').length > 0) {
            $('.educationExperience').each(function (key, div) {
                education.push({
                    course: $(div).find('.course').text(),
                    institution: $(div).find('.institution').text(),
                    level: $(div).find('.level').text(),
                    start_date: $(div).find('.startDate').text(),
                    end_date: $(div).find('.endDate').text()
                });
            });
        } else {
            const minierrors = [];
            if (educationCourse.val() == "" || educationCourse.val() < 3) {
                minierrors.push("Valid course is required");
            }
            if (educationInstitution.val() == "") {
                minierrors.push("Valid institution of study is required");
            }
            if (educationLevel.val() == "") {
                minierrors.push("Education level is required");
            }
            if (educationStartDate.val() == "") {
                minierrors.push("Education start is required");
            }
            if (educationEndDate.val() == "") {
                minierrors.push("Education end is required");
            }
            if (minierrors.length <= 0) {
                education.push({
                    course: educationCourse.val(),
                    institution: educationInstitution.val(),
                    level: educationLevel.val(),
                    start_date: educationStartDate.val(),
                    end_date: educationEndDate.val(),
                });
            } else {
                errors.push(minierrors);
            }
        }
        if ($('.jobExperience') !== undefined && $('.jobExperience').length > 0) {
            $('.jobExperience').each(function (key, div) {
                work.push({
                    title: $(div).find('.title').text(),
                    company: $(div).find('.company').text(),
                    start_date: $(div).find('.startDate').text(),
                    end_date: $(div).find('.endDate').text()
                });
            });
        } else {
            const minierrors = [];
            if (jobTittle.val() == "" || jobTittle.val() < 3) {
                minierrors.push("Job title is required");
            }
            if (jobCompanyName.val() == "") {
                minierrors.push("Valid company name is required");
            }
            if (jobStartDate.val() == "") {
                minierrors.push("Job start is required");
            }
            if (minierrors.length <= 0) {
                work.push({
                    title: jobTittle.val(),
                    company: jobCompanyName.val(),
                    start_date: jobStartDate.val(),
                    end_date: jobEndDate.val(),
                });
            } else {
                errors.push(minierrors);
            }
        }
        data.append("first_name", studentFirstName.val());
        data.append("last_name", studentLastName.val());
        data.append("title", studentTitle.val());
        data.append("specialization", specialization.val());
        data.append("years_of_experience", yearsOfExperience.val());
        data.append("skills", ProfileInformation.getItem("skills"));
        data.append("summary", ProfileInformation.getItem("summary"));
        data.append("address", studentAddress.val());
        data.append("phone", studentPhone.val());
        data.append("email", studentEmail.val());
        data.append("twitter", studentTwitter.val());
        data.append("facebook", studentFacebook.val());
        data.append("instagram", studentInstagram.val());
        data.append("linkedin", studentLinkedin.val());
        data.append("image", studentProfileImage.files[0]);
        data.append('education', JSON.stringify(education));
        data.append('work', JSON.stringify(work));
        data.append('level', jobLevel.val());

        showSpiner("#profileUpdateFeedback");
        for (var pair of data.entries()) {
            console.log(pair[0] + ": " + pair[1]);
        }
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
            },
        });
        $.ajax({
            method: "POST",
            url: "/profile",
            data: data,
            processData: false,
            contentType: false,
            success: function (params) {
                console.log(params);
                removeSpiner("#studentProfileUpdateFeedback");
                let result = JSON.parse(params);
                if (result.status === "success") {
                    showSuccess(result.message, "#studentProfileUpdateFeedback");
                    $this.trigger("reset");
                } else {
                    showError(result.message, "#studentProfileUpdateFeedback");
                }
            },
            error: function (error) {
                console.error(error);
                removeSpiner("#studentProfileUpdateFeedback");
                if (error.status == 422) {
                    var errors = "";
                    $.each(error.responseJSON.errors, function (key, value) {
                        errors += value + "!";
                    });
                    showError(errors, "#studentProfileUpdateFeedback");
                } else {
                    showError(
                        "Error occurred during processing",
                        "#studentProfileUpdateFeedback"
                    );
                }
            },
        });
    });



    userUpdateForm.on('submit', function (event) {
        event.preventDefault();
        const data = new FormData(), $this = $(this);
        data.append('user_id', userId.val());
        data.append('first_name', firstName.val());
        data.append('last_name', lastName.val());
        data.append('phone', userphone.val());
        data.append('email', useremail.val());
        data.append('address', userAddress.val());
        data.append('image', profilePhoto.files[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
            },
        });
        $.ajax({
            method: "POST",
            url: "/profile",
            data: data,
            processData: false,
            contentType: false,
            success: function (params) {
                console.log(params);
                removeSpiner("#userProfileFeedback");
                let result = JSON.parse(params);
                if (result.status === "success") {
                    showSuccess(result.message, "#userProfileFeedback");
                    $this.trigger("reset");
                } else {
                    showError(result.message, "#userProfileFeedback");
                }
            },
            error: function (error) {
                console.error(error);
                removeSpiner("#userProfileFeedback");
                if (error.status == 422) {
                    var errors = "";
                    $.each(error.responseJSON.errors, function (key, value) {
                        errors += value + "!";
                    });
                    showError(errors, "#userProfileFeedback");
                } else {
                    showError(
                        "Error occurred during processing",
                        "#userProfileFeedback"
                    );
                }
            },
        });
    });

})();
