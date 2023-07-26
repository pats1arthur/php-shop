<head>
	<link rel="stylesheet" href="css/style.css">
</head>

<?php include("inc/header.php") ?>


	
	<h1 class="h3 mb-3">Категорії</h1>

	<div class="card">
		<div class="card-body">
			<a href="category-form.php" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Нова категорія</a>
								
			<table class="table table-hover my-0" id="categories-table">
				<thead>
					<tr>
						<th>id#</th>
						<th>Картинка</th>
						<th>Назва категорії</th>
						<th>Дія</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$categories = get_categories_from_db();
					foreach ($categories as $category): ?>
						<tr>
							<td><?php echo $category["id"]; ?></td>
							<td><img width="40" height="40" alt="Помилка завантаження" src="<?php echo img("categories/" . $category['image']) ?>"></td>
							<td><?php echo $category["name"]; ?></td>
							<td>
								<a href="category-form.php?id=<?php echo $category['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
								<a href="actions/categories/delete.php?id=<?php echo $category['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
       
<?php include("inc/footer.php") ?>



