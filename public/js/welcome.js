(function () {

    getCategoriesOptions(['#searchCategoryID']);

    function getCategoriesWithJobsthJobs(target) {
        $.getJSON("/categories-with-jobs", function (categories) {
            let li = "";
            if (categories.length > 0) {
                $.each(categories, function (key, value) {
                    li +=
                        `<li><a href="/category/${value.slug}" class="list-group-item list-group-item-action" data-id="${value.id}">${value.name}</a></li>`;
                });
                $(target).html(`<h5 class="translatable">Get started quickly by industries</h5><div class="mt-2 d-flex flex-wrap gap-3 gy-4">${li}</div>`);
            }
        });
    }
    getCategoriesWithJobsthJobs('#categoriesWithJobs')
})();