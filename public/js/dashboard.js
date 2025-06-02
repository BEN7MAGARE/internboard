(function () {
    const pageLoadTime = moment();

    function updateTimes() {
        $('.updatedText').each(function (key, item) {
            $(item).text(`Updated ${pageLoadTime.fromNow()}`);
        })
    }
    window.setTimeout(function () {
        updateTimes()
    }, 6000);
    updateTimes();

    function getJobs() {
        $.getJSON('/jobs-get', function (jobs) {
            let job = "";
            $.each(jobs, function (key, value) {
                if (key < 10) {
                    let skill = '';
                    $.each(value.skills, function (kee, item) {
                        skill += "<span>" + item.name + "</span>";
                    });
                    job +=
                        '<div class="col-md-6"><div class="job bg-white" data-id=' +
                        value.id +
                        '><div class="title mt-2 mb-2 p-2"><h3>' +
                        value.title +
                        '</h3></div><div class="salary mb-2 p-2"><span>Monthly: ' +
                        value.salary_range +
                        '</span></div><div class="skills p-2">' +
                        skill +
                        '</div><div class="location mt-3 d-flex justify-content-between  p-2"><div><i class="fa-solid fa-location-dot"></i> <span>' +
                        value.location +
                        "</span></div><div>" +
                        moment(value.created_at).fromNow() +
                        "</div></div></div></div>";
                }
            });
            $("#latestJobsSection").html(job);
        });
    }
    getJobs();


    $("body").on("click", ".job", function () {
        console.log('here we are');
        let job_id = $(this).data('id');
        $("#jobDetailsModalToggle").modal("show");
        $.getJSON('/jobs/' + job_id, function (value) {
            $("#jobModalTitle").html("<b>" + value.title + "</b>");
            let skill = '', ref_no = (value.ref_no == null) ? value.id : value.ref_no;
            $.each(value.skills, function (kee, item) {
                skill += "<span>" + item.name + "</span>";
            });
            let details =
                '<div class="job-details-section"><div class="salary mb-2"><span>' +
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
                '<a href="/jobs/' + ref_no + '/apply" class="btn btn-primary">Apply Now <i class="fa-solid fa-angles-right"></i></a><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
            );
        });
    });
})()
