(function () {

    const collegeCreateForm = document.getElementById("collegeCreateForm"),
        collegeCreateSubmit = document.getElementById("collegeCreateSubmit");
    collegeCreateForm.addEventListener("submit", async function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        const errors = [],
            emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
            phoneNumberRegex = /^(\+254|0)[17]\d{8}$/;

        if (formData.get('name').length < 2) {
            errors.push("Invalid company name");
        }
        if (!emailRegex.test(formData.get('email'))) {
            errors.push("Invalid company email");
        }
        if (!phoneNumberRegex.test(formData.get('phone'))) {
            errors.push("Invalid company phone");
        }
        if (formData.get('address').length < 2) {
            errors.push("Invalid company address");
        }
        collegeCreateSubmit.disabled = true;
        if (errors.length > 0) {
            let p = "";
            $.each(errors, function (key, value) {
                p += value + '<br>';
            });
            showError(p, "#collegeFeedback");
            collegeCreateSubmit.disabled = false;
        } else {
            const response = await fetch("/college", {
                method: "POST",
                body: formData,
            });
            if (response.ok) {
                collegeCreateSubmit.disabled = false;
                let result = await response.json();
                console.log(result);
                
                if (result.status === "success") {
                    showSuccess(result.message, "#collegeFeedback");
                } else {
                    showError(result.message, "#collegeFeedback");
                }
            } else {
                let text = await response.text();
                console.log(text);
                
                collegeCreateSubmit.disabled = false;
                showError(text, "#collegeFeedback");
            }
        }
    });

})();
