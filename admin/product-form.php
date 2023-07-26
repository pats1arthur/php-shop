<?php include("inc/header.php") ?>

<?php
    if (!empty($_GET['id'])) {
        $product = get_product_from_db($_GET['id']);
        $extra_images = db_select("product_images", ["id", "image"], ["product_id" => $product["id"]]);
    } else {
        $product = null;
        $extra_images = [];
    }

    
    
?>

<h1 class="h3 mb-3">Товар</h1>

<div class="card">
    <div class="card-body">

        <form method="post" action="actions/products/<?php echo $product ? 'update' : 'create' ?>.php" enctype="multipart/form-data">
            <?php if ($product) { ?>
                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Назва товару</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlentities($product['name'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Ціна</label>
                <input type="number" name="price" class="form-control" value="<?php echo $product ? $product['price'] : '' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Зображення</label><br>
                <img id="preview-image" width="250px" height="250px" src="/uploads/products/<?php echo htmlentities($product['image']) ?>" class="img-fluid" alt="Не вдалося завантажити картинку">
            </div>
            <div class="mb-3">
                <label class="form-label">Завантажити головне зображення</label>
                <input type="file" name="new_image" class="form-control-file" onchange="previewImage(this)" accept=".jpg, .jpeg, .png">
            </div>

            <div class="mb-3" id="extra-images">
                <label class="form-label">Додаткові зображення</label><br>
                <input type="file" name="extra_images[]" class="form-control-file" accept=".jpg, .jpeg, .png" multiple>
            </div>
            <div class="mb-3">
                <div class="row g-3">
                    <?php foreach ($extra_images as $image) { ?>
                        <div class="col-2" style="position: relative; display: inline-block;">
                            <img src="/uploads/products/<?php echo htmlentities($image['image']) ?>" class="rounded-2 w-100 border">
                            <a href="actions/products/delete-extra-image.php?image_id=<?php echo $image['id'] ?>" onclick="return confirm('Видалити це зображення: <?php echo htmlentities($image['image']) ?>?')" title="Видалити зображення" style="position: absolute; top: 0; right: 0; margin-top: -10px;"><i class="fa fa-times text-danger"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Опис</label>
                <textarea id="editor" name="description" rows="4" class="form-control"><?php echo $product ? htmlentities($product['description']) : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Категорія</label>
                <select name="category_id" class="form-select">
                    <?php foreach (get_categories_from_db() as $category) { ?>
                        <option value="<?php echo $category['id'] ?>" <?php echo ($product && $category['id'] === $product['category_id']) ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Наявність</label>
                <select name="available" class="form-select">
                    <option value="1" <?php echo ($product && $product['available'] === 1) ? 'selected' : '' ?>>В наявності</option>
                    <option value="0" <?php echo ($product && $product['available'] === 0) ? 'selected' : '' ?>>Немає</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>

    </div>
</div>

<?php include("inc/footer.php") ?>
<script src="js/functions.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor'));

</script>
