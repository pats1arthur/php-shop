<?php include("inc/header.php") ?>

<?php 
    $categories = db_select_raw("SELECT * from categories");
?>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="h3 mb-4 mb-md-5 text-black"><i>Категорії товарів</i></h3>
            </div>
        </div>
        <div class="row">
        <?php foreach ($categories as $category) { ?>
            <div class="col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="block-4 text-center border flex-fill" data-aos="fade-up">
                    <figure class="block-4-image">
                        <a href="category.php?id=<?php echo $category['id'] ?>"><img src="<?php echo img('categories/' . $category['image']) ?>" alt="Image placeholder" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                        <h6><a href="category.php?id=<?php echo $category['id'] ?>"><i><?php echo htmlentities($category['name']) ?></i></a></h6>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<?php include("inc/footer.php") ?>