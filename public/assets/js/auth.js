(function () {

    const getStartedForm = $("#getStartedForm");
    getStartedForm.on("submit", function (event) {
        event.preventDefault();
        let userroleselection = $("input[name='userroleselection']:checked").val();
        console.log(userroleselection);

        if (userroleselection === "student") {
            window.location.href = '/student/create';
        } else if (userroleselection === "corporate") {
            window.location.href = "/employer/create";
        } else if (userroleselection === "college") {
            window.location.href = "/college/create";
        }
    });

    const userSignupForm = $("#studentSignupForm"),
        firstName = $("#firstName"),
        userRole = $("#userRole"),
        lastName = $("#lastName"),
        emailInput = $("#email"),
        phoneInput = $("#phone"),
        passwordInput = $("#password"),
        passwordConfirmation = $("#passwordConfirmation"), collegeID = $('#college_id');

    userSignupForm.on("submit", function (event) {
        event.preventDefault();
        let $this = $(this),
            first_name = firstName.val(),
            last_name = lastName.val(),
            role = userRole.val(),
            email = emailInput.val(),
            phone = phoneInput.val(),
            password = passwordInput.val(),
            password_confirmation = passwordConfirmation.val(),
            submit = $this.find("button[type='submit']"),
            errors = [], college_id = collegeID.val(),
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/,
            token = $this.find("input[name='_token']").val();
        submit.prop({ disabled: false });
        let data = {
            _token: token,
            college_id:college_id,
            first_name: first_name,
            last_name: last_name,
            role: role,
            email: email,
            phone: phone,
            password: password,
            password_confirmation: password_confirmation,
        };
        console.log(data);
        if (password !== password_confirmation) {
            errors.push('Incorrect password confirmation');
        }
        if (!emailRegex.test(email)) {
            errors.push("Inalid emai address");
        }
        if (first_name.length < 2) {
            errors.push('Invalid first name');
        }
        if (last_name.length < 2) {
            errors.push("Invalid last name");
        }
        if (!phoneNumberRegex.test(phone)) {
            errors.push("Invalid phone number")
        }
        if (errors.length > 0) {
            let p = ""
            $.each(errors, function (key, value) {
                p += value;
            });
            showError(p, "#studentfeedbackfeedback");
            submit.prop({ disabled: false });
        } else {
            showSpiner("#studentfeedbackfeedback");
            $.post("/register", data)
                .done(function (params) {
                    console.log(params);
                    submit.prop({ disabled: false });
                    removeSpiner("#studentfeedbackfeedback");
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#studentfeedbackfeedback");
                        $this.trigger("reset");
                        window.setTimeout(function() {
                            window.location.href = result.url;
                        }, 1000)
                    } else {
                        showError(result.message, "#studentfeedbackfeedback");
                    }
                })
                .fail(function (error) {
                    console.log(error);
                    submit.prop({ disabled: false });
                    removeSpiner("#studentfeedbackfeedback");
                    if (error.status == 422) {
                        var errors = "";
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errors += value + "!";
                            }
                        );
                        showError(errors, "#studentfeedbackfeedback");
                    } else {
                        showError(
                            "Error occurred during processing",
                            "#studentfeedbackfeedback"
                        );
                    }
                });
        }
    });
})();
