// public/js/product-edit.js

document.addEventListener('DOMContentLoaded', function() {
    // Initialize optionIndex based on the number of existing option rows
    let optionIndex = document.querySelectorAll('#product-options-section .row').length;
    document.querySelectorAll('.delete-image-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (btn.disabled) return;
            if (!confirm('Are you sure you want to delete this image?')) return;
            const imageId = btn.getAttribute('data-image-id');
            const isMain = btn.getAttribute('data-main-image') === '1';
            const totalImages = document.querySelectorAll('.delete-image-btn').length;
            if (isMain && totalImages === 1) {
                alert('A product must have at least one image. You cannot delete the main image.');
                return;
            }
            if (isMain) {
                alert('You cannot delete the main image. Set another image as main before deleting this one.');
                return;
            }
            fetch(window.deleteImageUrlBase + '/' + imageId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    btn.closest('.d-inline-block').remove();
                } else {
                    alert('Failed to delete image.');
                }
            })
            .catch(() => alert('Failed to delete image.'));
        });
    });
    document.querySelectorAll('.add-option').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const section = document.getElementById('product-options-section');
            const row = document.createElement('div');
            row.className = 'row mb-2';
            row.innerHTML = `
                                        <div class="col-3">
                                            <input type="text" name="options[${optionIndex}][option_type]" class="form-control" placeholder="Option Type (e.g. size)">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="options[${optionIndex}][option_value]" class="form-control" placeholder="Option Value (e.g. M)">
                                        </div>
                                        <div class="col-3">
                                            <input type="number" name="options[${optionIndex}][quantity]" class="form-control" placeholder="Quantity">
                                        </div>
                                        <div class="col-3">
                                            <button type="button" class="btn btn-danger remove-option">-</button>
                                        </div>
                                    `;
            section.appendChild(row);
            row.querySelector('.remove-option').addEventListener('click', function() {
                row.remove();
            });
            optionIndex++;
        });
    });
    document.querySelectorAll('.remove-option').forEach(function(btn) {
        btn.addEventListener('click', function() {
            btn.closest('.row').remove();
        });
    });
});
