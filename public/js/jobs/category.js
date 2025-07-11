document.addEventListener('DOMContentLoaded', function () {
    const createCategoryForm = document.getElementById('createCategoryForm');
    const createSubcategoryForm = document.getElementById('createSubcategoryForm');
    const updateCategoryForm = document.getElementById('updateCategoryForm');
    const updateSubcategoryForm = document.getElementById('updateSubcategoryForm');

    const allCategorySelect = document.getElementById('allCategorySelect');
    const allSubcategorySelect = document.getElementById('allSubcategorySelect');


    allCategorySelect.addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="category_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    allSubcategorySelect.addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="subcategory_id[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    createCategoryForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const csrfToken = document.querySelector('input[name="_token"]').value;        
        try {
            const response = await fetch('/categories', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });
            if (response.ok) {
                const result = await response.json();
                if (result.status === "success") {
                    showSuccess(result.message, "#categoryFeedback");
                    getCategoriesOptions('#categoryIDOptions');
                    createCategoryForm.reset();
                } else {
                    showError(result.message || "Submission failed", "#categoryFeedback");
                }
            } else {
                const text = await response.text();

                showError("Unexpected response format:<br><code>" + text.substring(0, 200) + "</code>", "#categoryFeedback");
            }
        } catch (err) {
            console.error(err);
            showError("Something went wrong while submitting the form.", "#categoryFeedback");
        }
    });

    createSubcategoryForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector("input[name='_token']").value;
        console.log(Object.fromEntries(formData.entries()));
        
        try {
            const response = await fetch('/subcategories', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });
            if (response.ok) {
                const data = await response.json();
                if (data.status === 'success') {
                    showSuccess(data.message, "#subcategoryFeedback");
                    createSubcategoryForm.reset();
                } else {
                    showError(data.message, "#subcategoryFeedback");
                }
            } else if (response.status === 422) {
                const errorData = await response.json();
                let errors = '';
                for (const key in errorData.errors) {
                    errors += errorData.errors[key].join(' ') + '!<br>';
                }
                showError(errors, "#subcategoryFeedback");
            } else if (response.status === 419) {
                showError("You are not logged in", "#subcategoryFeedback");
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                showError("Error occurred during processing", "#subcategoryFeedback");
            }
        } catch (error) {
            console.error(error);
            showError("Unexpected error occurred", "#subcategoryFeedback");
        }
    });


    document.addEventListener('click', async function (e) {

        const editCategoryToggle = e.target.closest('#editCategoryToggle');

        if (editCategoryToggle) {
            e.preventDefault();
            const categoryId = editCategoryToggle.dataset.id;
            let response = await fetch(`/categories/${categoryId}`);
            let result = await response.json();
            const category = result.data;
            document.getElementById('categoryID').value = categoryId;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description;
        }

        const editSubcategoryToggle = e.target.closest('#editSubcategoryToggle');

        if (editSubcategoryToggle) {
            e.preventDefault();
            const subcategoryId = editSubcategoryToggle.dataset.id;
            let response = await fetch(`/subcategories/${subcategoryId}`);
            let result = await response.json();
            const subcategory = result.data;
            document.getElementById('subcategoryID').value = subcategoryId;
            document.getElementById('subcategoryName').value = subcategory.name;
            document.getElementById('subcategoryDescription').value = subcategory.description;
            
            const categoryIDOption = document.getElementById('categoryIDOptions').options;
            for (let i = 0; i < categoryIDOption.length; i++) {
                if (categoryIDOption[i].value == subcategory.category_id) {
                    categoryIDOption[i].selected = true;
                    break;
                }
            }
        }
    });

    const createCategoryToggle = document.getElementById('createCategoryToggle');
    const createSubcategoryToggle = document.getElementById('createSubcategoryToggle');

    createCategoryToggle.addEventListener('click', function () {
        createCategoryForm.reset();
        document.getElementById('categoryID').value = '';
    });

    createSubcategoryToggle.addEventListener('click', function () {
        createSubcategoryForm.reset();
        document.getElementById('subcategoryID').value = '';
    });
    
});
