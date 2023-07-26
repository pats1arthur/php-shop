<?php include("inc/header.php") ?>

    <?php
    if (!empty($_GET['id'])) {
        $category = get_category_from_db($_GET['id']);
    } else {
        $category = null;
    }
    ?>

	<h1 class="h3 mb-3">Категорія</h1>

	<div class="card">
		<div class="card-body">
            
            <form method="post" action="actions/categories/<?php echo $category ? 'update' : 'create' ?>.php" enctype="multipart/form-data">
                <?php if ($category) { ?>
                    <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
                <?php } ?>
                <div class="mb-3">
                    <label class="form-label">Назва категорії</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlentities($category['name'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Зображення</label><br>
                    <img id="preview-image" width="250px" height="250px" src="/uploads/categories/<?php echo htmlentities($category['image']) ?>" class="img-fluid" alt="Не вдалося завантажити картинку">
                </div>
                <div class="mb-3">
                    <label class="form-label">Завантажити</label>
                    <input type="file" name="new_image" class="form-control-file" onchange="previewImage(this)" accept=".jpg, .jpeg, .png">
                </div>
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>

        </div>
    </div>

<?php include("inc/footer.php") ?>

<script src="assets/js/functions.js"></script>
