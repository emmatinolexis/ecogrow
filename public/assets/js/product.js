    $(document).ready(function () {
            function showToast(message, type = 'success') {
                let bgClass = type === 'success' ? 'alert-success' : 'alert-danger';
                let toast = $('<div></div>')
                    .addClass(`alert ${bgClass} position-fixed top-0 end-0 m-4`)
                    .css('z-index', 9999)
                    .text(message);
                $('body').append(toast);
                setTimeout(() => {
                    toast.remove();
                }, 2500);
            }
            $('.add-to-cart-btn').on('click', function (e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let productOptionId = $(this).closest('.mn-product-card').find('.option-item.active').data(
                    'option-id') || null;
                let productQuantity = 1;
                axios.post(window.routes.addToCart, {
                    product_id: productId,
                    quantity: productQuantity,
                    product_option_id: productOptionId
                }, {
                    headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') }
                })
                    .then(function (response) {
                        showToast('Product added to cart!', 'success');
                    })
                    .catch(function (error) {
                        if (error.response && error.response.status === 401) {
                            showToast(error.response.data.message, 'danger');
                        } else {
                            showToast('An error occurred.', 'danger');
                        }
                    });
            });
        });
    