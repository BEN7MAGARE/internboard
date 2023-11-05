(function () {
    const profileUpdateForm = $("#profileUpdateForm"),
        firstName = $("#firstName"),
        lastName = $("#lastName"),
        title = $("#title"),
        educationLevel = $("#educationLevel"),
        course = $("#course"),
        specialization = $("#specialization"),
        summary = $("#summary"),
        Address = $("#Address"),
        Phone = $("#Phone"),
        Email = $("#Email"),
        Twitter = $("#Twitter"),
        Facebook = $("#Facebook"),
        Instagram = $("#Instagram"),
        Linkedin = $("#Linkedin"),
        ProfileImage = $("#ProfileImage")[0],
        ProfileInformation = window.sessionStorage;

    firstName.on("change", function () {
        ProfileInformation.setItem("first_name", this.val());
    });
    lastName.on("change", function () {
        ProfileInformation.setItem("last_name", this.val());
    });
    title.on("change", function () {
        ProfileInformation.setItem("title", this.val());
    });
    educationLevel.on("change", function () {
        ProfileInformation.setItem("education_level", this.val());
    });
    course.on("change", function () {
        ProfileInformation.setItem("course", this.val());
    });
    specialization.on("change", function () {
        ProfileInformation.setItem("specialization", this.val());
    });
    summary.on("change", function () {
        ProfileInformation.setItem("summary", this.val());
    });
    Address.on("change", function () {
        ProfileInformation.setItem("address", this.val());
    });
    Phone.on("change", function () {
        ProfileInformation.setItem("phone", this.val());
    });
    Email.on("change", function () {
        ProfileInformation.setItem("email", this.val());
    });
    Twitter.on("change", function () {
        ProfileInformation.setItem("twitter", this.val());
    });
    Facebook.on("change", function () {
        ProfileInformation.setItem("facebook", this.val());
    });
    Instagram.on("change", function () {
        ProfileInformation.setItem("instagram", this.val());
    });
    Linkedin.on("change", function () {
        ProfileInformation.setItem("linkedin".this.val());
    });

    $("#ProfileImage").on("change", function () {
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

    profileUpdateForm.on("submit", function (event) {
        event.preventDefault();
        const data = new FormData();
        data.append("first_name", ProfileInformation.getItem("first_name"));
        data.append("last_name", ProfileInformation.getItem("last_name"));
        data.append("title", ProfileInformation.getItem("title"));
        data.append(
            "education_level",
            ProfileInformation.getItem("education_level")
        );
        data.append("course", ProfileInformation.getItem("course"));
        data.append(
            "specialization",
            ProfileInformation.getItem("specialization")
        );
        data.append("summary", ProfileInformation.getItem("summary"));
        data.append("address", ProfileInformation.getItem("address"));
        data.append("phone", ProfileInformation.getItem("phone"));
        data.append("email", ProfileInformation.getItem("email"));
        data.append("twitter", ProfileInformation.getItem("twitter"));
        data.append("facebook", ProfileInformation.getItem("facebook"));
        data.append("instagram", ProfileInformation.getItem("instagram"));
        data.append("linkedin", ProfileInformation.getItem("linkedin"));
        data.append("image", ProfileImage.files[0]);

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
            method: "PATCH",
            url: "/profile",
            data: data,
            processData: false,
            contentType: false,
            success: function (params) {
                console.log(params);
                removeSpiner("#profileUpdateFeedback");
                let result = JSON.parse(params);
                if (result.status === "success") {
                    showSuccess(result.message, "#profileUpdateFeedback");
                    $this.trigger("reset");
                } else {
                    showError(result.message, "#profileUpdateFeedback");
                }
            },
            error: function (error) {
                console.error(error);
                removeSpiner("#profileUpdateFeedback");
                showError(
                    "Error occurred during processing",
                    "#profileUpdateFeedback"
                );
            },
        });
    });
})();
