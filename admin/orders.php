<?php include("inc/header.php") ?>

	<h1 class="h3 mb-3">Замовлення</h1>
	
	<div class="card">
		<div class="card-body">
			
		<table class="table table-hover my-0" id="categories-table">
				<thead>
					<tr>
						<th>id#</th>
						<th>Ім'я</th>
						<th>Прізвище</th>
						<th>Номер телефону</th>
						<th>Доставка</th>
						<th>Деталі доставки</th>
						<th>Оплата</th>
						<th>Загальна ціна</th>
						<th>Статус</th>
						<th>Дія</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$orders = db_select_raw('SELECT * FROM orders');
						foreach ($orders as $order) { ?>
							<tr>
								<td><?php echo $order['id'] ?></td>
								<td><?php echo $order['first_name'] ?></td>
								<td><?php echo $order['last_name'] ?></td>
								<td><?php echo $order['phone_number'] ?></td>
								<td><?php echo get_delivery_cyrilic($order['delivery']) ?></td>
								<td><?php echo $order['delivery_details'] ?></td>
								<td><?php echo get_payment_cyrilic($order['payment']) ?></td>
								<td><?php echo $order['total_price'] ?>$</td>
								<td>
									<span class="badge text-bg-<?php echo get_status_style($order['status']) ?>">
										<?php echo get_status_cyrilic($order['status']) ?>
									</span>
								</td>
								<td>
									<a href="order-form.php?id=<?php echo $order['id'] ?>">Переглянути</a>
								</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

<?php include("inc/footer.php") ?>

					

			