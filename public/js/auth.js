(function () {
    const getStartedForm = $("#getStartedForm");
    getStartedForm.on("submit", function (event) {
        event.preventDefault();
        let userroleselection = $("input[name='userroleselection']:checked").val();
        console.log(userroleselection);

        if (userroleselection === "student") {
            window.location.href = '/student-create';
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
        passwordConfirmation = $("#passwordConfirmation"),
        collegeID = $('#college_id'),
        showLoginPassword = $('#showLoginPassword'),
        showRegisterPassword = $('.showRegisterPassword'),
        studentSubmit = $('#studentSubmit');

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
        studentSubmit.prop({ disabled: true });
        studentSubmit.html('<i class="fa fa-server"></i> Save');
        let data = {
            _token: token,
            college_id: college_id,
            first_name: first_name,
            last_name: last_name,
            role: role,
            email: email,
            phone: phone,
            password: password,
            password_confirmation: password_confirmation,
        };
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
            $.post("/register", data)
                .done(function (params) {
                    studentSubmit.prop({ disabled: true });
                    studentSubmit.html('<i class="fa fa-server"></i> Save');
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#studentfeedbackfeedback");
                        $this.trigger("reset");
                        window.setTimeout(function () {
                            window.location.href = result.url;
                        }, 1000)
                    } else {
                        showError(result.message, "#studentfeedbackfeedback");
                    }
                })
                .fail(function (error) {
                    studentSubmit.prop({ disabled: true });
                    studentSubmit.html('<i class="fa fa-server"></i> Save');
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

    showLoginPassword.on("click", function () {
        if (passwordInput.attr("type") == "password") {
            passwordInput.attr("type", "text");
            showLoginPassword.html('<i class="bi bi-eye-slash-fill"></i>');
        } else {
            passwordInput.attr("type", "password");
            showLoginPassword.html('<i class="bi bi-eye-fill"></i>');
        }
    });

    showRegisterPassword.on("click", function () {
        if (passwordInput.attr("type") == "password") {
            passwordInput.attr("type", "text");
            passwordConfirmation.attr("type", "text");
            showRegisterPassword.html('<i class="fa fa-eye-slash"></i>');
        } else {
            passwordInput.attr("type", "password");
            passwordConfirmation.attr("type", "password");
            showRegisterPassword.html('<i class="fa fa-eye"></i>');
        }
    });
})();
