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
        '<div class="text-center"><span class="loader"></span></div>'
    );
}

function removeSpiner(target) {
    $(target).children().remove();
}


function getCategoriesOptions(target) {
    $.getJSON("/categoriesdata", function (categories) {
        let option = "<option value=''>Select Category/Industry</option>";
        $.each(categories, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function composeJobs(jobs) {
    let job = "";
    $.each(jobs, function (key, value) {
        let skill = '';
        $.each(value.skills, function (kee, item) {
            skill += "<span>" + item.name + "</span>";
        });
        console.log(value);
        
        // Posted:${ moment(value.created_at).fromNow() }
        job += `<a href="/jobs/${value.ref_no}">
                                            <div class="job card bg-white rounded p-3 job-card"
                                                data-id="${value.id}" data-ref_no="${value.ref_no}">

                                                <div class="title">
                                                    <h6>${value.title}</h6>
                                                </div>

                                                <div class="d-flex gap-2">

                                                    <div class="text-center d-none d-md-block">
                                                        ${value.corporate.logo !== null ? `<img src="${'corporate_logos/' + value.corporate.logo}" alt="${value.corporate.name}" class="img-fluid company-logo">` : ''}
                                                        <p class="company-name"><i>${value.corporate.name}</i></p>
                                                        <div class="mt-2">
                                                            <a href="${'jobs/' + value.ref_no + '/apply'}" class="btn btn-primary btn-sm">Apply Now</a>
                                                        </div>
                                                    </div>

                                                    <div class="">
                                                        
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span class="salary-badge p-1 rounded">Level:
                                                                ${value.experience_level}</span>
                                                            <span class="salary-badge p-1 rounded">Salary:
                                                                ${value.salary_range}</span>
                                                            <span class="salary-badge p-1 rounded">Work Type:
                                                                ${value.job_type}</span>
                                                            <span class="salary-badge p-1 rounded">Positions:
                                                                ${value.no_of_positions}</span>
                                                        </div>

                                                        <div class="desciption p-2">
                                                            ${value.description.length > 150 ? `${value.description.slice(0, 150) + ' . . . .'}` : value.description}
                                                        </div>

                                                        <div class="skills ml-2">${skill}</div>

                                                        <div class="location d-flex justify-content-between p-2">

                                                            <div>
                                                                <small>
                                                                    <i class="bi bi-geo-alt-fill text-danger"></i>&nbsp;<span>${value.location}</span>
                                                                </small>
                                                            </div>

                                                            <div>
                                                                <small>Application Deadline:
                                                                    ${value.application_end_date !== null
                                                                        ? "<span class='text-danger'>" + moment(value.application_end_date).format('Do MMM YYYY') + '</span>'
                                                                        : "<span class='text-danger'>Not specified</span>"}</small>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            </a>`
        // job +=
        //     `<a href="/jobs/${value.ref_no}"><div class="job rounded" data-id="${value.id}"><div class="title p-2"><h5 class="translatable">${value.title}</h5></div><div class="salary p-2"><span class="translatable">Monthly: ${value.salary_range}</span></div><div class="desciption"><p class="translatable">${getsubstring(value.description)}</p></div><div class="skills p-2">${skill}</div>
        //     <div class="location d-flex justify-content-between p-2"><div><small><i class="fa fa-map-marker"></i>&nbsp;<span>${value.location}</span></small></div><div><small class="translatable">Application Deadline: ${(value.application_end_date !== null) ? "<span class='text-warning'>" + moment(value.application_end_date).format('Do MMM YYYY') + "</span>" : "<span class='text-warning translatable'>Not specified</span>"}</small></div></div></div></a>`;
    });
    return job;
}


function getsubstring(string) {
    if (string.length > 150) {
        return string.slice(0, 150) + " . . . .";
    } else {
        return string;
    }
}

function getCourses(target) {
    $.getJSON("/courses", function (courses) {
        let option = "<option value=''>Select Course</option>";
        $.each(courses, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getCountiesOptions(target) {
    $.getJSON("/counties", function (counties) {
        let option = "<option value=''>Select County</option>";
        $.each(counties, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getSkillsOption(target) {
    $.getJSON("/skillsdata", function (skills) {
        let option = "<option value=''>Select One</option>";
        $.each(skills, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getSubCategories(categoryid, target) {
    $.getJSON("/categorysubs/" + categoryid, function (subcategories) {
        let option = "<option value=''>Select One</option>";
        $.each(subcategories, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getEmployerOptions(target) {
    $.getJSON("/corporatesdata", function (corporates) {
        let option = "<option value=''>Select Employer</option>";
        $.each(corporates, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getCollegesOptions(target) {
    $.getJSON("/collegesdata", function (colleges) {
        let option = "<option value=''>Select College</option>";
        $.each(colleges, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getCorporatesOptions(target) {
    $.getJSON("/corporatesdata", function (corporates) {
        let option = "<option value=''>Select Corporate</option>";
        $.each(corporates, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function getCourseCategoriesOptions(target) {
    $.getJSON("/coursescategoriesdata", function (coursecategories) {
        let option = "<option value=''>Select Course Category</option>";
        console.log();

        $.each(coursecategories, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}

function isValidKenyanPhone(number) {
    const regex = /^(?:\+254|254|0)?(1[0-2][0-9]{7}|7[0-9]{8})$/;
    return regex.test(number);
}

function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function getCoursesOptions(target) {
    $.getJSON("/coursesdata", function (courses) {
        let option = "<option value=''>Select Course</option>";
        $.each(courses, function (key, value) {
            option +=
                "<option value=" +
                value.id +
                ">" +
                value.name +
                "</option>";
        });
        if (Array.isArray(target)) {
            $.each(target, function (key, value) {
                $(value).html(option);
            });
        } else {
            $(target).html(option);
        }
    });
}