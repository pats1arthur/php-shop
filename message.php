<?php include("inc/header.php") ?>


<div class="site-section">
    <div class="container">
        <?php if (!empty($_SESSION['report'])) { ?>
            <?php foreach ($_SESSION['report'] as $report) { ?>
                <div class="alert alert-<?php echo $report['type'] == 'error' ? 'danger' : $report['type'] ?>" role="alert">
                    <h4 class="alert-heading"><?php echo $report['title'] ?></h4>
                    <p><?php echo $report['text'] ?></p>
                    <hr>
                    <p class="mb-0"><?php echo $report['additional_text'] ?></p>
                </div>
            <?php } ?>
        <?php } ?>
        <?php $_SESSION['report'] = [] ?>
    </div>
 
</div>


<?php include("inc/footer.php") ?>