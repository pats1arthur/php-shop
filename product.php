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

    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Головна</a></li>
            <li class="breadcrumb-item"><a href="category.php?id=<?php echo $product["category_id"] ?>"><?php echo $product["category_name"] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $product["name"] ?></li>
        </ol>
    </nav>

        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-4">
                <img class="card-img-top mb-5 mb-md-0" src="<?php echo img("products/" . $product['image']) ?>" alt="Зображення товару" />
                <div class="carousel-container mt-3">
                <div class="carousel-container mt-3">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" data-bs-theme="dark" style="max-width: 400px; max-height: 50px">
                        <div class="carousel-inner">
                        <?php 
                            $isFirst = true;
                            $images_count = count($extra_images);
                            for ($i = 0; $i < $images_count; $i += 3) { ?>
                            <div class="carousel-item <?php echo $isFirst ? 'active' : '' ?>" data-bs-interval="5000">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="small mb-1"><?php echo $product['category_name'] ?></div>
                <h1 class="display-5 fw-bolder"><?php echo $product['name'] ?></h1>
                <div class="fs-5 mb-3">
                    <span><?php echo $product['price'] ?>$</span>
                    <?php echo $product["available"] == 1 ? '<span class="badge bg-success">Є в наявності</span>' : '<span class="badge bg-danger">Товар відсутній</span>' ?>
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary cart-add-product" data-product-id="<?php echo $product['id'] ?>" <?php echo $product["available"] == 1 ? "" : "disabled" ?>>
                        Купити 
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
                <p class="lead"><?php echo $product['description'] ?></p>
                
            </div>
        </div>

<?php include("inc/footer.php") ?> 