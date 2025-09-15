<?php
include("controllers/cmen.php"); 
?>

<?php if ($datm && count($datm) > 0) { ?>
<div class="dropdown m-2">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bars"></i> Menú
    </button>
    <ul class="dropdown-menu" aria-labelledby="menuDropdown">
        <?php foreach ($datm as $dm) { ?>
            <li>
                <a class="dropdown-item" href="home.php?pg=<?= $dm['idpag']; ?>">
                    <i class="<?= $dm['icopag']; ?>"></i> <?= $dm['nompag']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
<?php } ?>
