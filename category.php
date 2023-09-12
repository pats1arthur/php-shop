<?php include("inc/header.php") ?>

<?php 
    $categories = db_select_raw("SELECT * from categories");
?>
<?php 
    if (empty($_GET)) {
        $is_correctly = true;
    }
    else if(isset($_GET['id'])) {
        $is_correctly = db_select_one("categories", ["name"], ["id" => $_GET["id"]]);
    }
    else {
        $is_correctly = false;
    }
?>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Категорії</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1">
                            <a href="category.php" class="d-flex">
                                <span><?php echo empty($_GET) ? '<strong>Усі товари</strong>' : 'Усі товари' ?></span> 
                                <span class="text-black ml-auto">(<?php echo count(db_select_raw('SELECT * FROM products')) ?>)</span>
                            </a>
                        </li>
                        <?php foreach ($categories as $category) { ?>
                            <li class="mb-1">
                                <a href="category.php?id=<?php echo $category['id'] ?>" class="d-flex">
                                    <span><?php echo $is_correctly && isset($_GET['id']) && $_GET['id'] == $category['id'] ? '<strong>' . htmlentities($category['name']) . '</strong>' : htmlentities($category['name']) ?></span> 
                                    <span class="text-black ml-auto">(<?php echo count(db_select('products', ['id'], ['category_id' => $category['id']])) ?>)</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 order-2">
                <div class="row mb-5">
                    <?php if ($is_correctly) { ?>
                        <?php
                        $products = empty($_GET) ? db_select_raw("SELECT * from products") : db_select("products", ["id", "name", "price", "available", "image"], ["category_id" => $_GET["id"]]);

                        if (empty($products)) {
                            echo 'Для цієї категорії не знайдено товарів';
                        }
                        else {

                            foreach ($products as $product) { ?>
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="card h-100">
                                        <img src="<?php echo img("products/" . $product['image']) ?>" alt="Image placeholder" class="card-img-top">
                                        <div class="card-body">
                                            <h6 class="card-title"><a href="product.php?id=<?php echo $product['id'] ?>"><?php echo htmlentities($product['name']) ?></a></h6>
                                            <p class="card-text mb-0"><?php echo $product["available"] == 1 ? "Є в наявності" : "Немає в наявності" ?></p>
                                            <p class="card-text text-primary font-weight-bold">$<?php echo htmlentities($product['price']) ?></p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="product.php?id=<?php echo $product['id'] ?>" title="Інформація про товар"><i class="fas fa-search"></i></a>
                                            <a href='#' title="Додати у кошик" data-product-id="<?php echo $product['id'] ?>" class="cart-add-product" <?php echo $product["available"] == 1 ? "" : "hidden" ?>>
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                            <a href='#' title="Подобається"><i class="fas fa-heart text-danger"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } else {
                        echo 'Такої категорії не існує';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    
</div>


<?php include("inc/footer.php") ?>