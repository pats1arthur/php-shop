<?php include("inc/header.php") ?>


<div class="site-section">
    <div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h6 class="d-flex mb-3">
                <span class="text-muted">Ваша корзина</span>
            </h6>
            <ul class="list-group mb-3 sticky-top order-list">
                
            </ul>
        </div>

        <div class="col-md-8 order-md-1">
            <form method="post" action="actions/order/insert.php" enctype="multipart/form-data">
                <h6 class="mb-3">Контактні дані</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Ім'я</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Артур">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Прізвище</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Пацкун">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="tel" class="form-control" id="phone" name="phoneNumber" placeholder="Введіть номер телефону">
                </div>
                <hr class="mb-4">
                <h6 class="mb-3">Доставка</h6>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="delivery" id="novaposhta" value="novaposhta">
                    <label class="form-check-label" for="novaposhta">
                        Нова пошта
                    </label>
                </div>

                <div class="mb-3" id="novaPoshtaFields">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city-np">Місто</label>
                            <input type="text" class="form-control" id="city-np" name="city-np" placeholder="Вкажіть місто">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="branch-np">Відділення</label>
                            <input type="text" class="form-control" id="branch-np" name="branch-np" placeholder="Вкажіть відділення">
                        </div>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="delivery" id="pickup" value="pickup">
                    <label class="form-check-label" for="pickup">
                        Самовивіз
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="delivery" id="courier" value="courier">
                    <label class="form-check-label" for="courier">
                        Доставка кур'єром
                    </label>
                </div>

                

                <div class="mb-3" id="courierFields">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city-courier">Місто</label>
                            <input type="text" class="form-control" id="city-courier" name="city-courier" placeholder="Вкажіть місто">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="street-courier">Вулиця</label>
                            <input type="text" class="form-control" id="street-courier" name="street-courier" placeholder="Вкажіть вулицю">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="house-courier">Будинок</label>
                            <input type="text" class="form-control" id="house-courier" name="house-courier" placeholder="Вкажіть будинок">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apartment-courier">Квартира</label>
                            <input type="text" class="form-control" id="apartment-courier" name="apartment-courier" placeholder="Вкажіть квартиру">
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <h6 class="mb-3">Оплата</h6>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment" id="cash" value="cash">
                    <label class="form-check-label" for="cash">
                        Готівкою
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment" id="props" value="props">
                    <label class="form-check-label" for="props">
                        Оплата за реквізитами
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment" id="postpaid" value="postpaid">
                    <label class="form-check-label" for="postpaid">
                        Післяоплата
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Оформити замовлення</button>
            </form>
        </div>
    </div>
    </div>
 
</div>


<?php include("inc/footer.php") ?>