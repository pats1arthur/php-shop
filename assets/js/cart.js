
$('#cartModal').on('show.bs.modal', function() {
    $('#cartModal .modal-body').html('Завантажується...');
    loadCart();
});


function loadCart(onFinishedCallback) {
    fetch('/actions/cart/get_products.php')
        .then(response => response.json())
        .then(cart => {
            $('#cartModal .modal-body').html(renderCart(cart));
        })
        .catch(e => {
            $('#cartModal .modal-body').html('<span class="text-danger">Сталася помилка...</span>');
        })
        .finally(() => {
            if (onFinishedCallback) onFinishedCallback();
        });
}

function renderTotalProductsCount() {
    $('body').find('.products-count').html('<i class="fa fa-spinner fa-spin"></i>');
    
    fetch('/actions/cart/get_products.php')
        .then(response => response.json())
        .then(cart => {
            $('body').find('.products-count').html(cart.total_count);
        })
        .catch(e => {
            alert('Сталася помилка!');
        });
}

renderTotalProductsCount();

function renderCart(cart) {
    if (!cart.products.length) {
        return 'В кошику ще немає товарів'
    }
    
    return `
        <table  class="table table-image" id="myTable">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Товар</th>
                    <th scope="col">Ціна</th>
                    <th scope="col">К-ть</th>
                    <th scope="col">Загалом</th>
                    <th scope="col">Дія</th>
                </tr>
            </thead>
            <tbody>
                ${renderProductRows(cart.products)}
            </tbody>
        </table> 

        <div class="d-flex justify-content-end">
            <h5>Загальна ціна: <span class="price text-success">${cart.total_price}$</span></h5>
        </div>
    `;
}

function renderProductRows(products) {
    let rows = '';

    for (let product of products) {
        rows += `
            <tr data-product-id="${product.id}">
                <td class="w-25">
                    <img width="100" height="100" src="${product.image}" class="img-fluid img-thumbnail" alt="Не вдалося завантажити фото">
                </td>
                <td>${product.name}</td>
                <td>${product.price}$</td>
                <td>
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary btn-cart-minus"><i class="fas fa-minus"></i></button>
                            </span>
                            <input type="text" class="form-control cart-product-count" value="${product.count}">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary btn-cart-plus"><i class="fas fa-plus"></i></button>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="part-total-price">
                    ${product.total_price}$
                </td>
                <td>
                    <button class="btn btn-danger btn-sm cart-delete">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
        `;
    }

    return rows;
}


$('#cartModal').on('click', '.btn-cart-minus', function() {
    const product_id = $(this).closest('tr').attr('data-product-id');
    const current_count = parseInt($(this).closest('tr').find('.cart-product-count').val());
    setCartProductCount(product_id, current_count - 1);
});

$('#cartModal').on('click', '.btn-cart-plus', function() {
    const product_id = $(this).closest('tr').attr('data-product-id');
    const current_count = parseInt($(this).closest('tr').find('.cart-product-count').val());
    setCartProductCount(product_id, current_count + 1);
});

$('#cartModal').on('change', '.cart-product-count', function() {
    const product_id = $(this).closest('tr').attr('data-product-id');
    const current_count = parseInt($(this).closest('tr').find('.cart-product-count').val());
    setCartProductCount(product_id, current_count);
});

$('#cartModal').on('click', '.cart-delete', function() {
    const product_id = $(this).closest('tr').attr('data-product-id');
    setCartProductCount(product_id, 0);
});



function setCartProductCount(product_id, count) {
    $('#cartModal').find('.modal-body').css({opacity: '.5'});

    fetch('/actions/cart/set_count.php?product_id=' + product_id + '&count=' + count)
        .then(response => response.json())
        .then(json => {
            loadCart(function() {
                $('#cartModal').find('.modal-body').css({opacity: '1'});
            });
            renderTotalProductsCount();
            
        })
        .catch(e => {
            alert('Сталася помилка!');
            $('#cartModal').find('.modal-body').css({opacity: '1'});
        });
}

function addToCart(button, product_id) {
    const buttonHtml = $(button).html();
    $(button).html('<i class="fa fa-spinner fa-spin"></i>');

    fetch('/actions/cart/add_product.php?product_id=' + product_id)
        .then(response => response.json())
        .then(json => {
            $('#cartModal').modal('show');
            $(button).html(buttonHtml);
            renderTotalProductsCount();
        })
        .catch(e => {
            alert('Сталася помилка!');
            $(button).html(buttonHtml);
        });
}

$('body').on('click', '.cart-add-product', function() {
    addToCart(this, $(this).attr('data-product-id'));
});