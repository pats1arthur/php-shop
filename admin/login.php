<?php require('inc/functions.php') ?>
<?php require('inc/auth.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />

	<title>Вхід | адмінка</title>

	<link href="assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

                        <?php if ($authError) { ?>
                            <div class="alert alert-danger">
                                <?php echo $authError ?>
                            </div>
                        <?php } ?>

						<div class="text-center mt-4">
							<h1 class="h2">Вхід в адмінку</h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="post">
										<div class="mb-3">
											<label class="form-label">Логін</label>
											<input class="form-control form-control-lg" type="text" name="login" placeholder="Введіть свій логін" />
										</div>
										<div class="mb-3">
											<label class="form-label">Пароль</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Введіть свій пароль" />

										</div>

										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Вхід</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

</body>

</html>