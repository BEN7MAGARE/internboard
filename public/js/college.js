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


    const userSignupForm = $("#corporateSignupForm"),
        companyName = $("#companyName"),
        companyEmail = $("#companyEmail"),
        companyPhone = $("#companyPhone"),
        companyAddress = $("#companyAddress"),
        firstName = $("#firstName"),
        userRole = $("#userRole"),
        lastName = $("#lastName"),
        emailInput = $("#email"),
        phoneInput = $("#phone"),
        passwordInput = $("#password"),
        passwordConfirmation = $("#passwordConfirmation"),
        showRegisterPassword = $('.showRegisterPassword');

    userSignupForm.on("submit", function (event) {
        event.preventDefault();
        const $this = $(this),
            companyname = companyName.val(),
            companyemail = companyEmail.val(),
            companyphone = companyPhone.val(),
            companyaddress = companyAddress.val(),
            first_name = firstName.val(),
            last_name = lastName.val(),
            role = userRole.val(),
            email = emailInput.val(),
            phone = phoneInput.val(),
            password = passwordInput.val(),
            password_confirmation = passwordConfirmation.val(),
            errors = [],
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/,
            token = $this.find("input[name='_token']").val(),
            institutionSubmit = $('#institutionSubmit');
        institutionSubmit.prop({ disabled: true });
        institutionSubmit.text('Processing ..');
        let data = {
            _token: token,
            company: {
                name: companyname,
                email: companyemail,
                phone: companyphone,
                address: companyaddress,
            },
            user: {
                first_name: first_name,
                last_name: last_name,
                role: role,
                email: email,
                phone: phone,
                password: password,
                password_confirmation: password_confirmation,
            },
        };
        if (password !== password_confirmation) {
            errors.push("Incorrect password confirmation");
        }
        if (!emailRegex.test(email)) {
            errors.push("Inalid emai address");
        }
        if (companyname.length < 2) {
            errors.push("Invalid company name");
        }
        if (!emailRegex.test(companyemail)) {
            errors.push("Invalid company email");
        }
        if (!phoneNumberRegex.test(companyphone)) {
            errors.push("Invalid company phone");
        }
        if (companyaddress.length < 2) {
            errors.push("Invalid company address");
        }
        if (first_name.length < 2) {
            errors.push("Invalid first name");
        }
        if (last_name.length < 2) {
            errors.push("Invalid last name");
        }
        if (!phoneNumberRegex.test(phone)) {
            errors.push("Invalid phone number");
        }
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value+'<br>';
            });
            showError(p, "#corporateFeedback");
            submit.prop({ disabled: false });
        } else {
            showSpiner("#corporateFeedback");
            $.post("/college", data)
                .done(function (params) {
                    institutionSubmit.prop({ disabled: false });
                    institutionSubmit.html('<i class="fa fa-server"></i> Submit');
                    removeSpiner("#corporateFeedback");
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#corporateFeedback");
                        $this.trigger("reset");
                        window.setTimeout(function () {
                            window.location.href = result.url;
                        }, 1000);
                    } else {
                        showError(result.message, "#corporateFeedback");
                    }
                })
                .fail(function (error) {
                    institutionSubmit.prop({ disabled: false });
                    institutionSubmit.html('<i class="fa fa-server"></i> Submit');
                    removeSpiner("#corporateFeedback");
                    if (error.status == 422) {
                        var errors = "";
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errors += value + "!";
                            }
                        );
                        showError(errors, "#corporateFeedback");
                    } else {
                        showError(
                            "Error occurred during processing",
                            "#corporateFeedback"
                        );
                    }
                });
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
