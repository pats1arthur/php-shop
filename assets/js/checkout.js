$(document).ready(function() {
    toggleDeliveryFields();
    loadOrderList();
    $('input[name="delivery"]').on('change', function() {
        toggleDeliveryFields();
    });
});

function toggleDeliveryFields() {
    if ($('#novaposhta').is(':checked')) {
        $('#novaPoshtaFields').show();
        $('#courierFields').hide();
    } 
    else if ($('#courier').is(':checked')) {
        $('#novaPoshtaFields').hide();
        $('#courierFields').show();
    } 
    else {
        $('#novaPoshtaFields').hide();
        $('#courierFields').hide();
    }
}

function loadOrderList() {
    $('body').find('.order-list').html('Завантаження...');

    fetch('/actions/cart/get_products.php')
        .then(response => response.json())
        .then(cart => {
            $('body').find('.order-list').html(renderOrderList(cart));
        })
        .catch(e => {
            $('.order-list').html('<span class="text-danger">Сталася помилка...</span>');
        })
}

function renderOrderList(cart) {
    if (!cart.products.length) {
        return 'Ви не обрали товари';
    }

    let rows = '';

    for (let product of cart.products) {
        rows += `
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">${product.name}</h6>
                    <small class="text-muted">Кількість товару - ${product.count}</small>
                </div>
                <span class="text-muted">${product.total_price}$</span>
            </li>
        `;
    }

    rows += `
        <li class="list-group-item d-flex justify-content-between">
            <span>Загалом (UAH)</span>
            <strong>${cart.total_price}$</strong>
        </li>
    `;

    return rows;
}