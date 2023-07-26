<?php include("inc/header.php") ?>

<?php
    if (!empty($_GET['id'])) {
        $order = db_select_one("orders", ["*"], ["id" => $_GET['id']]);
        $products = db_select("order_products", ["*"], ["order_id" => $_GET['id']]);
    } else {
        $order = null;
        $products = null;
    }
?>

<h1 class="h3 mb-3">Замовлення</h1>

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h6 class="d-flex mb-3">
                    <span class="text-muted">Товари</span>
                </h6>
                <ul class="list-group mb-3 sticky-top order-list">
                    <?php foreach ($products as $product) { ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo db_select_one("products", ["name"], ["id" => $product["product_id"]])["name"] ?></h6>
                                <small class="text-muted">Кількість товару - <?php echo $product['count'] ?></small>
                            </div>
                            <span class="text-muted"><?php echo $product['total_price'] ?>$</span>
                        </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Загалом (UAH)</span>
                        <strong><?php echo $order['total_price'] ?>$</strong>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 order-md-1">
                <form method="post" action="actions/orders/update.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $order['id'] ?>">
                    <h6 class="mb-3">Контактні дані</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Ім'я</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Вкажіть ім'я" value="<?php echo htmlentities($order['first_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Прізвище</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Вкажіть прізвище" value="<?php echo htmlentities($order['last_name'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="Введіть номер телефону" value="<?php echo htmlentities($order['phone_number'] ?? '') ?>">
                    </div>
                    <hr class="mb-4">
                    <h6 class="mb-3">Доставка та оплата</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Вид доставки</label>
                            <select id="delivery" name="delivery" class="form-select">
                                <option value="novaposhta" <?php echo selected_if("novaposhta", $order['delivery']) ?>>Нова пошта</option>
                                <option value="pickup" <?php echo selected_if("pickup", $order['delivery']) ?>>Самовивіз</option>
                                <option value="courier" <?php echo selected_if("courier", $order['delivery']) ?>>Доставка кур'єром</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment">Вид оплати</label>
                            <select id="payment" name="payment" class="form-select">
                                <option value="cash" <?php echo selected_if("cash", $order['payment']) ?>>Готівка</option>
                                <option value="props" <?php echo selected_if("props", $order['payment']) ?>>Оплата за реквізитами</option>
                                <option value="postpaid" <?php echo selected_if("postpaid", $order['payment']) ?>>Післяоплата</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="delivery-details" class="form-label">Деталі доставки</label>
                        <input type="text" class="form-control" id="delivery-details" name="delivery_details" placeholder="Вкажіть деталі доставки" value="<?php echo htmlentities($order['delivery_details'] ?? '') ?>">
                    </div>
                    
                    <hr class="mb-4">
                    <h6 class="mb-3">Інформація про замовлення</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">Статус</label>
                            <select id="status" name="status" class="form-select">
                                <option value="new" <?php echo selected_if("new", $order['status']) ?>>Нове</option>
                                <option value="in_progress" <?php echo selected_if("in_progress", $order['status']) ?>>В процесі</option>
                                <option value="completed" <?php echo selected_if("completed", $order['status']) ?>>Виконано</option>
                                <option value="canceled" <?php echo selected_if("canceled", $order['status']) ?>>Скасовано</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="commentAdmin" class="form-label">Коментар</label>
                        <input type="text" class="form-control" id="commentAdmin" name="comment" placeholder="Вкажіть коментар до замовлення" value="<?php echo htmlentities($order['comment'] ?? '') ?>">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="create_at">Дата створення</label>
                            <span id="create_at" class="d-block">
                                <h4><strong><i><?php echo $order['created_at'] ?></i></strong></h4>
                            </span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="update_at">Остання зміна</label>
                            <span id="update_at" class="d-block">
                                <h4><strong><i><?php echo $order['updated_at'] ?></i></strong></h4>
                            </span>
                        </div>
                        
                    </div>

                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include("inc/footer.php") ?>

					

			