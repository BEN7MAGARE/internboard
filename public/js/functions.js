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
    $.getJSON("/categories", function (categories) {
        let option = "<option value=''>Select Industry</option>";
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
        // Posted:${ moment(value.created_at).fromNow() }
        job +=
            `<div class="job bg-white rounded" data-id="${value.id}"><div class="title p-2"><h5>${value.title}</h5></div><div class="salary p-2"><span>Monthly: ${value.salary_range}</span></div><div class="desciption"><p>${getsubstring(value.description)}</p></div><div class="skills p-2">${skill}</div>
            <div class="location d-flex justify-content-between p-2"><div><small><i class="fa fa-map-marker"></i>&nbsp;<span>${value.location}</span></small></div><div><small>Application Deadline: ${(value.application_end_date !== null) ? "<span class='text-warning'>" + moment(value.application_end_date).format('Do MMM YYYY') + "</span>" : "<span class='text-warning'>Not specified</span>"}</small></div></div></div>`;
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
