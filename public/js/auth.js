(function () {
    const getStartedForm = $("#getStartedForm");
    getStartedForm.on("submit", function (event) {
        event.preventDefault();
        let userroleselection = $("input[name='userroleselection']:checked").val();
        console.log(userroleselection);

        if (userroleselection === "student") {
            window.location.href = '/account-create/student';
        } else if (userroleselection === "corporate") {
            window.location.href = '/account-create/corporate';
        } else if (userroleselection === "college") {
            window.location.href = '/account-create/college';
        }
    });

    const userSignupForm = $("#signupForm"),
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
        studentSubmit = $('#userSubmit');

    userSignupForm.on("submit", function (event) {
        event.preventDefault();
        let $this = $(this),
            password = passwordInput.val(),
            password_confirmation = passwordConfirmation.val(),
            errors = [], college_id = collegeID.val(),
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/,
            token = $this.find("input[name='_token']").val();
        studentSubmit.prop({ disabled: true });
        studentSubmit.text('Processing...');
        let data = {
            _token: token,
            // college_id: college_id,
            first_name: firstName.val(),
            last_name: lastName.val(),
            role: userRole.val(),
            email: emailInput.val(),
            phone: phoneInput.val(),
            password: password,
            password_confirmation: password_confirmation,
        };
        if (password !== password_confirmation) {
            errors.push('Incorrect password confirmation');
        }
        if (!emailRegex.test(data.email)) {
            errors.push("Inalid emai address");
        }
        if (data.first_name.length < 2) {
            errors.push('Invalid first name');
        }
        if (data.last_name.length < 2) {
            errors.push("Invalid last name");
        }
        if (!phoneNumberRegex.test(data.phone)) {
            errors.push("Invalid phone number")
        }
        if (errors.length > 0) {
            let p = ""
            $.each(errors, function (key, value) {
                p += value;
            });
            showError(p, "#userFeedback");
            studentSubmit.prop({ disabled: false });
            studentSubmit.html('<i class="fa fa-server"></i> Submit');
        } else {
            console.log(data);
            
            $.post("/account/store", data)
                .done(function (params) {
                    studentSubmit.prop({ disabled: true });
                    studentSubmit.html('<i class="fa fa-server"></i> Submit');
                    let result = JSON.parse(params);
                    console.log(result.url);
                    if (result.status === "success") {
                        showSuccess(result.message, "#userFeedback");
                        $this.trigger("reset");
                        window.setTimeout(function () {
                            window.location.href = result.url;
                        }, 1000)
                    } else {
                        showError(result.message, "#userFeedback");
                    }
                })
                .fail(function (error) {
                    studentSubmit.prop({ disabled: true });
                    studentSubmit.html('<i class="fa fa-server"></i> Submit');
                    if (error.status == 422) {
                        var errors = "";
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errors += value + "!";
                            }
                        );
                        showError(errors, "#userFeedback");
                    } else {
                        showError(
                            "Error occurred during processing",
                            "#userFeedback"
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
            showRegisterPassword.html('<i class="bi bi-eye-slash"></i>');
        } else {
            passwordInput.attr("type", "password");
            passwordConfirmation.attr("type", "password");
            showRegisterPassword.html('<i class="bi bi-eye"></i>');
        }
    });
})();
