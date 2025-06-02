(function () {

    getCategoriesOptions(['#searchCategoryID', '#categoryID']);

    const jobsSearchForm = $('#jobsSearchForm'),
        searchCategoryID = $('#searchCategoryID'),
        searchEmploymentType = $('#searchEmploymentType'),
        searchJobType = $('#searchJobType'),
        searchExperienceLevel = $('#searchExperienceLevel'),
        jobLocations = $('#jobLocations'),
        jobrendersection = $('#jobrendersection');

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
        $.getJSON('/jobs-get', function (jobs) {
            jobrendersection.html(composeJobs(jobs));
        });
    }

    // getJobs();

    $("body").on("click", ".job", function () {
        let job_id = $(this).data('id');
        let ref_no = $(this).data('ref_no');
        $("#jobDetailsModalToggle").modal("show");
        $.getJSON('/jobs/' + ref_no, function (value) {
            console.log(value);
            
            $("#jobModalTitle").html("<b>" + value?.title + "</b>");
            let skill = '', requirements = JSON.parse(value.requirements), reqdiv = '',
                qualifications = JSON.parse(value.qualifications), qualdiv = '',
                ref_no = (value.ref_no == null) ? value.id : value.ref_no;
            $.each(value.skills, function (kee, item) {
                skill += "<span>" + item.name + "</span>";
            });
            $.each(requirements, function (kee, item) {
                reqdiv += "<li>" + item + "</li>";
            });
            $.each(qualifications, function (kee, item) {
                qualdiv += "<li>" + item + "</li>";
            });
            let details =
                `<div class="job-details-section"><div class="salary mb-2"><span>${value.type}</span><span>Work Type:${value.job_type}</span><span>NO of positions: <b>${value.no_of_positions}</b></span><span>${value.salary_range}</span></div>
                <div class="desciption p-2">${value.description}</div><hr><h5 class="d-flex justify-content-between p-2"><b>Skills</b> <span class="float-right">Level: <b>${value.experience_level}</b></span></h5><hr><div class="skills p-2">
                ${skill}</div><hr><div class="requirements p-2"><p><b>Requirements</b></p><ul>${reqdiv}</ul></div><hr><div class="qualifications p-2"><p><b>Qualifications</b></p><ul>${qualdiv}</ul></div>
                <hr><div class="education d-flex justify-content-between p-2"><span>Education Level: <i class="fa fa-graduation-cap text-primary"></i> <b>${value.education_level}</b></span><span>Starts on: <i class="fa-regular fa-calendar-days text-primary"></i> <b>${moment(value.start_date).format("Do MMMM YYYY")}</b></span></div><hr><div class="location mt-3 d-flex justify-content-between p-2"><div><i class="fa-solid fa-location-dot"></i> <span>Westlands Nairobi, Kenya</span></div><div>Posted: ${moment(value.created_at).fromNow()}</div></div></div>`;
            $('#jobDetailsSection').html(details);
            $("#jobActionSection").html(
                '<a href="/jobs/' + ref_no + '/apply" class="btn btn-primary">Apply Now <i class="fa-solid fa-angles-right"></i></a><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
            );
        });
    });


    $("body").on("click", "#viewJobDetails", function () {
        let job_id = $(this).data('id');
        $("#jobDetailsModalToggle").modal("show");
        $.getJSON('/jobs/' + job_id, function (value) {
            $("#jobModalTitle").html("<b>" + value.title + "</b>");
            let skill = '', ref_no = (value.ref_no == null) ? value.id : value.ref_no;
            $.each(value.skills, function (kee, item) {
                skill += "<span>" + item.name + "</span>";
            });
            let details =
                `<div class="job-details-section"><div class="salary mb-2"><span>${value.type}</span><span>Work Type: ${value.job_type}</span><span>NO of positions: <b>${value.no_of_positions}</b></span><span>${value.salary_range}</span></div>
                <div class="desciption p-2">${value.description}</div><hr><h5 class="d-flex justify-content-between p-2"><b>Skills</b> <span class="float-right">Level: <b>${value.experience_level}</b></span></h5><hr><div class="skills p-2">${skill}</div><hr><div class="education d-flex justify-content-between p-2"><span>Education Level: <i class="fa fa-graduation-cap text-primary"></i> <b>${value.education_level}</b></span><span>Starts on: <i class="fa-regular fa-calendar-days text-primary"></i> <b>${moment(value.start_date).format("Do MMMM YYYY")}</b></span></div><hr><div class="location mt-3 d-flex justify-content-between p-2"><div><i class="fa-solid fa-location-dot"></i> <span>Westlands Nairobi, Kenya</span></div><div>Posted: ${moment(value.created_at).fromNow()}</div></div></div>`;
                value.type +
                "</span><span>Work Type: " +
                value.job_type +
                "</span><span>NO of positions: <b>" +
                value.no_of_positions +
                "</b></span><span>" +
                value.salary_range +
                '</span></div><div class="desciption p-2">' +
                value.description +
                '</div><hr><h5 class="d-flex justify-content-between p-2"><b>Skills</b> <span class="float-right">Level: <b>' +
                value.experience_level +
                '</b></span></h5><hr><div class="skills p-2">' +
                skill +
                '</div><hr><div class="education d-flex justify-content-between p-2"><span>Education Level: <i class="fa fa-graduation-cap text-primary"></i> <b>' +
                value.education_level +
                '</b></span><span>Starts on: <i class="fa-regular fa-calendar-days text-primary"></i> <b>' +
                moment(value.start_date).format("Do MMMM YYYY") +
                '</b></span></div><hr><div class="location mt-3 d-flex justify-content-between p-2"><div><i class="fa-solid fa-location-dot"></i> <span>Westlands Nairobi, Kenya</span></div><div>Posted: ' +
                moment(value.created_at).fromNow() +
                "</div></div></div>";
            $('#jobDetailsSection').html(details);
            $("#jobActionSection").html(
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
            );
        });
    });

    const applicantsSelectForm = $('#applicantsSelectForm'),
        applicantSelectToggle = $('.applicantSelectToggle'),
        invitationLetter = $('#invitationLetter'), submitInvitation = $('#submitInvitation');

    applicantsSelectForm.on('submit', function (event) {
        event.preventDefault();
        const $this = $(this), applicants = [], errors = [];

        applicantSelectToggle.each(function (key, item) {
            if ($(item).is(':checked')) {
                applicants.push({ applicationid: $(item).val() })
            }
        });
        submitInvitation.prop('disabled', true);
        const data = {
            applicants: JSON.stringify(applicants),
            message: invitationLetter.val()
        }
        if (applicants.length <= 0) {
            errors.push("You have not selected applicants to invite");
        }
        if (invitationLetter.val().length < 20) {
            errors.push("Enter a valid invitation letter");
        }
        if (errors.length > 0) {
            showError(errors.join(', '), '#invitationFeedback')
            submitInvitation.prop('disabled', false);
        } else {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $this.find("input[name='_token']").val(),
                },
            });
            $.ajax({
                method: "POST",
                url: "/applications-select",
                data: data,
                success: function (params) {
                    submitInvitation.prop('disabled', false);
                    let result = JSON.parse(params);
                    if (result.status === "success") {
                        showSuccess(result.message, "#invitationFeedback");
                        $this.trigger("reset");
                    } else {
                        showError(result.message, "#invitationFeedback");
                    }
                },
                error: function (error) {
                    submitInvitation.prop('disabled', false);
                    console.error(error);
                    showError("Error occurred during processing", "#invitationFeedback");
                },
            });
        }
    });

    jobsSearchForm.on('submit', function (event) {
        event.preventDefault();
        filterJobs();
    });

    function filterJobs() {
        let experience = $('input[name="experienceLevel"]:checked').map(function () {
            return $(this).val();
        }).get();
        let education = $('input[name="educationLevel"]:checked').map(function () {
            return $(this).val();
        }).get();

        let locations = $('#locations>li.active').map(function () {
            return $(this).data('id');
        }).get();
        const data = {
            _token: jobsSearchForm.find(`input[name="_token"]`).val(),
            category_id: searchCategoryID.val(),
            employment_type: searchEmploymentType.val(),
            experience_level: JSON.stringify(experience),
            job_type: searchJobType.val(),
            education_level: JSON.stringify(education),
            location: JSON.stringify(locations)
        };
        $.post('/jobs-json-search', data).done(function (jobs) {
            if (jobs.length > 0) {
                jobrendersection.html(composeJobs(jobs));
            } else {
                jobrendersection.html(`<p class="text-danger">No results matched your search</p>`);
            }
        });
    }

    function getJobsLocations() {
        $.getJSON('/jobs-locations', function (locations) {
            let li = '';
            $.each(locations, (key, value) => {
                li += `<li data-id="${value}">${value}</li>`;
            });
            let ul = `<ul class="d-flex flex-wrap gap-3" id="locations">${li}</ul>`;
            jobLocations.html(ul);
        });
    }
    getJobsLocations();

    $('body').on('change', "input[name='experienceLevel']", function () {
        filterJobs();
    });

    $('body').on('change', "input[name='educationLevel']", function () {
        filterJobs();
    });

    $('body').on('click', '#locations li', function (event) {
        $(this).addClass('active');
        let location = $(this).data('id');
        filterJobs();
    });
    
})();
