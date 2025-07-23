document.addEventListener('DOMContentLoaded', function () {
    const createProductForm = document.getElementById('createProductForm'),
        imagePreview = document.getElementById('imagePreview'),
        productImages = document.getElementById('productImages'),
        addProductToggle = document.getElementById('addProductToggle'),
        productId = document.getElementById('productId');

    addProductToggle.addEventListener('click', function (e) {
        e.preventDefault();
        createProductForm.reset();
        imagePreview.innerHTML = '';
        productId.value = '';
        $('#createProductModal').modal('show');
    });

    createProductForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const response = await fetch('/employer-product-store', {
            method: 'POST',
            body: formData
        })
        if (response.ok) {
            const data = await response.json();
            console.log(data);
            if (data.status === 'success') {
                showSuccess(data.message, "#productFeedback");
                createProductForm.reset();
                imagePreview.innerHTML = '';
            } else {
                showError(data.message, "#productFeedback");
            }
        } else if (response.status === 422) {
            const errorData = await response.json();
            let errors = '';
            for (const key in errorData.errors) {
                errors += errorData.errors[key].join(' ') + '!<br>';
            }
            showError(errors, "#productFeedback");
        } else {
            const error = await response.text();
            console.error('Error:', response);
            showError("An error occurred. Please try again later.", "#productFeedback");
        }
    });

    productImages.addEventListener('change', function (e) {
        displayImages(e.target.files, imagePreview);
    });

    function displayImages(files, preview) {
        preview.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const imageWrapper = document.createElement('div');
                imageWrapper.classList.add('image-preview');
                const img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add('image-preview');
                imageWrapper.appendChild(img);
                const deleteBtn = document.createElement('button');
                deleteBtn.classList.add('delete-btn');
                deleteBtn.innerHTML = '<i class="bi bi-trash"></i>';
                deleteBtn.addEventListener('click', () => {
                    imageWrapper.remove();
                });
                imageWrapper.appendChild(deleteBtn);
                preview.appendChild(imageWrapper);
            };
            reader.readAsDataURL(files[i]);
        }
    }

    document.addEventListener('click', async function (e) {
        const editProductToggle = e.target.closest('#editProductToggle');
        if (editProductToggle) {
            e.preventDefault();
            const productId = editProductToggle.dataset.productid;
            const response = fetch(`/employer-product/${productId}`);
            response.then((res) => res.json()).then((data) => {
                document.getElementById('productId').value = data.id;
                document.getElementById('productName').value = data.name;
                document.getElementById('productDescription').value = data.description;
                document.getElementById('productPrice').value = data.price;
                let images = JSON.parse(data.image),
                    image = '';
                for (let i = 0; i < images.length; i++) {
                    image += `<div class="preview-image text-center"><img src="/productimages/${images[i]}" alt="Background"
                                            class="img-thumbnail">
                                        <button type="button" class="delete-btn"
                                            data-image="${images[i]}" id="deleteImageToggle" data-productid="${data.id}">
                                            <i class="bi bi-trash"></i>
                                        </button></div>`;
                }
                imagePreview.innerHTML = image;
                $('#createProductModal').modal('show');
            });
        }

        const deleteProductToggle = e.target.closest('#deleteProductToggle');
        if (deleteProductToggle) {
            e.preventDefault();
            const productId = deleteProductToggle.dataset.productId;
            new swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then(async (willDelete) => {
                    if (willDelete) {
                        const deleteProductForm = document.getElementById('deleteProductForm');
                        const productid = deleteProductToggle.dataset.productid;
                        const response = await fetch(`/employer-product-destroy/${productid}`,
                            {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                }
                            }
                        );
                        if (response.ok) {
                            const data = await response.json();
                            Swal.fire({
                                title: "Deleted!",
                                text: data.message,
                                icon: "success"
                            });
                            window.setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            const error = await response.text();
                            Swal.fire({
                                title: "Error!",
                                text: error,
                                icon: "error"
                            });
                        }
                    }
                });
        }

        const deleteImageToggle = e.target.closest('#deleteImageToggle');
        if (deleteImageToggle) {
            e.preventDefault();
            const image = deleteImageToggle.dataset.image;
            const productId = deleteImageToggle.dataset.productid;

            const formData = new FormData();
            formData.append('image', image);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            const response = await fetch(`/employer-product-image-destroy/${productId}`, {
                method: 'POST', // Change this from DELETE to POST
                body: formData,
            });

            if (response.ok) {
                const data = await response.json();
                deleteImageToggle.closest('.preview-image').remove();
            } else {
                const error = await response.text();
                console.log(error);
            }
        }

    });
});
