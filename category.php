<?php include("inc/header.php") ?>

<?php $category = db_select_one("categories", ["name"], ["id" => $_GET["id"]]) ?>

<nav aria-label="breadcrumb" class="mb-5">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Головна</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $category["name"] ?? 404 ?></li>
  </ol>
</nav>

   <?php if ($category) { ?>
      <div class="row row-cols-1 row-cols-md-4 g-4">
         <?php 
            $products_select = db_select("products", ["id", "name", "price", "available", "image"], ["category_id" => $_GET["id"]]);
            foreach ($products_select as $product) { ?>
               <div class="col">
                  <div class="card h-100">
                     <img height="200" src="<?php echo img("products/" . $product["image"]) ?>" class="card-img-top" alt="Зображення товару">
                     <div class="card-body">
                        <h6 class="card-title"><?php echo htmlentities($product["name"]) ?></h6>
                        <p class="card-text">Ціна: <?php echo htmlentities($product["price"]) ?></p>
                        <p class="card-text">Наявність: <?php echo $product["available"] == 1 ? '<span class="badge bg-success">Є в наявності</span>' : '<span class="badge bg-danger">Товар відсутній</span>' ?></p>
                     </div>
                     <div class="card-footer d-flex justify-content-between">
                        <a href="/product.php?id=<?php echo $product["id"] ?>" class="btn btn-primary">Детальніше <i class="fas fa-search"></i></a>
                        <button data-product-id="<?php echo $product['id'] ?>" class="btn btn-primary cart-add-product" <?php echo $product["available"] == 1 ? "" : "disabled" ?>>
                           Купити 
                           <i class="fas fa-shopping-cart"></i>
                        </button>
                     </div>
                  </div>
               </div>
            <?php } ?>
      </div>
   <?php }
   else echo "Такої категорії не існує";
   ?>


<?php include("inc/footer.php") ?>