(function () {
    function showSpiner(target) {
        $(target).html(
            '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
        );
    }

    function getCategories() {
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

    getSkills();

    function getJobs() {
        showSpiner("#jobrendersection");
        $.getJSON('/jobs-get', function (jobs) {
            console.log();
            let job = "";
            $.each(jobs, function (key, value) {
                let skill = '';
                $.each(value.skills, function (kee, item) {
                    skill += "<span>" + item.name + "</span>";
                });
                job += "<div class=\"job\"><div class=\"title mt-2 mb-2\"><h3>" + value.title + "</h3></div><div class=\"salary mb-2\"><span>Monthly: "+value.salary_range+"</span></div><div class=\"desciption\"><p>" + value.description + "</p></div><div class=\"skills\">" + skill + "</div><div class=\"location mt-3\"><i class=\"fa-solid fa-location-dot\"></i> <span>" + value.location + "</span></div></div>"
            });
            $("#jobrendersection").html(job);
        });
    }
    getJobs();

})();
