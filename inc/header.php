<?php include('functions.php') ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ledif</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>
  <body>

    <div class="container py-4">

        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Магазин</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Головна</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Категорії
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach (get_categories_from_db() as $category) { ?>
                                <li><a class="dropdown-item" href="/category.php?id=<?php echo htmlentities($category["id"]) ?>"><?php echo htmlentities($category["name"]) ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" data-bs-target="#cartModal" <?php echo $_SERVER['REQUEST_URI'] == "/order.php" ? "hidden" : "" ?>>
                        Кошик
                        <span class="badge text-bg-secondary products-count">
                            0
                        </span>
                    </button>
                </div>
                </div>
            </div>
        </nav>

        <?php if (!empty($_SESSION['messages'])) { ?>
            <?php foreach ($_SESSION['messages'] as $message) { ?>
                <div class="alert alert-<?php echo $message['type'] == 'error' ? 'danger' : $message['type'] ?>">
                    <?php echo $message['text'] ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php $_SESSION['messages'] = [] ?>

        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Кошик</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">

                    

                </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                        <a class="btn btn-success" href="order.php">Покупка</a>
                    </div>
                </div>
            </div>
        </div>


