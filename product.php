<?php include("inc/header.php") ?>

<?php 
    if (!empty($_GET['id'])) {
        $product = get_product_from_db($_GET["id"]);
        $extra_images = db_select("product_images", ["id", "image"], ["product_id" => $_GET["id"]]);
    }
    else {
        $product = null;
        $extra_images = [];
    }
?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="<?php echo img("products/" . $product['image']) ?>" alt="Image" class="img-fluid" width="350"> 
                <div class="carousel-container mt-3">
                    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        <?php 
                        $isFirst = true;
                        $images_count = count($extra_images);
                        for ($i = 0; $i < $images_count; $i += 3) { ?>
                            <div class="carousel-item <?php echo $isFirst ? 'active' : '' ?>">
                            <div class="row align-items-center justify-content-center">
                                <?php foreach (array_slice($extra_images, $i, 3) as $extra_image) { ?>
                                <div class="col-md-4">
                                    <img src="<?php echo img("products/" . $extra_image['image']) ?>" class="d-block w-100 img-fluid" alt="...">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                            <?php $isFirst = false;
                        }
                        ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
        </div>
            </div>
            <div class="col-md-6">
            <h2 class="text-black"><?php echo htmlentities($product['name']) ?></h2>
            <p><strong class="text-primary h4">$<?php echo htmlentities($product['price']) ?></strong></p>
            <div class="row ml-1">
                <a href="#" class="buy-now btn btn-sm btn-primary cart-add-product" data-product-id="<?php echo $product['id'] ?>">Додати у кошик</a>
                <a href='#' title="Подобається"><i class="fas fa-heart text-danger col-md-6"></i></a>
            </div>
            <p class="lead"><?php echo $product['description'] ?></p>
            


        </div>
    </div>
</div>

<?php include("inc/footer.php") ?>