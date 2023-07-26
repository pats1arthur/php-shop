<head>
	<link rel="stylesheet" href="css/style.css">
</head>

<?php include("inc/header.php") ?>

	<h1 class="h3 mb-3">Товари</h1>

	<div class="card">
		<div class="card-body">
			<a href="product-form.php" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Новий товар</a>
								
			<table class="table table-hover my-0" id="categories-table">
				<thead>
					<tr>
						<th>id#</th>
						<th>Картинка</th>
						<th>Назва товару</th>
						<th>Назва категорії</th>
						<th>Ціна</th>
						<th>Наявність</th>
						<th class="text-end">Дія</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$products = get_products_from_db();
					foreach ($products as $product): ?>
						<tr>
							<td><?php echo $product["id"]; ?></td>
							<td><img width="40" height="40" alt="Помилка завантаження" src="<?php echo img("products/" . $product['image']) ?>"></td>
							<td><?php echo $product["name"]; ?></td>
							<td><?php echo $product["category_name"]; ?></td>
							<td><?php echo $product["price"]; ?></td>
							<td><?php echo $product["available"]; ?></td>
							<td class="text-end">
								<a href="product-form.php?id=<?php echo $product['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
								<a href="actions/products/delete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
       
<?php include("inc/footer.php") ?>


