document.addEventListener('DOMContentLoaded', function () {
    const createCategoryForm = document.getElementById('createCategoryForm');
    const createSubcategoryForm = document.getElementById('createSubcategoryForm');
    const updateCategoryForm = document.getElementById('updateCategoryForm');
    const updateSubcategoryForm = document.getElementById('updateSubcategoryForm');

    createCategoryForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const response = await fetch(this.action, {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            let result = await response.json();
            if (result.status === "success") {
                showSuccess(result.message, "#categoryFeedback");
            } else {
                showError(result.message, "#categoryFeedback");
            }
        } else {
            let text = await response.text();
            showError(text, "#categoryFeedback");
        }
    });

    createSubcategoryForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const response = await fetch(this.action, {
            method: 'POST',
            body: formData,
        });
        if (response.ok) {
            let result = await response.json();
            if (result.status === "success") {
                showSuccess(result.message, "#categoryFeedback");
            } else {
                showError(result.message, "#categoryFeedback");
            }
        } else {
            let text = await response.text();
            showError(text, "#categoryFeedback");
        }
    });

});
