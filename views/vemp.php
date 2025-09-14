<!-- VISTA EMPRESA ÚNICA PARA ADMIN -->

<div class="container py-5 d-flex justify-content-center">

    <div class="col-md-8">

        <!-- ENCABEZADO -->
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary"><i class="fa-solid fa-building me-2"></i>Mi Empresa</h2>
            <p class="text-muted">Administra los datos de tu empresa</p>
        </div>

        <!-- FORMULARIO / CARD DE EMPRESA -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                
                <form action="index.php?pg=<?=$pg;?>" method="POST">
                    <div class="mb-3">
                        <label for="nomemp" class="form-label fw-semibold">Nombre de la empresa</label>
                        <input type="text" name="nomemp" id="nomemp" class="form-control rounded-3" placeholder="Nombre de la empresa" value="<?php if($datOne && $datOne[0]['nomemp']) echo $datOne[0]['nomemp'];?>">
                    </div>

                    <div class="mb-3">
                        <label for="nitemp" class="form-label fw-semibold">NIT</label>
                        <input type="number" name="nitemp" id="nitemp" class="form-control rounded-3" placeholder="Número de NIT" value="<?php if($datOne && $datOne[0]['nitemp']) echo $datOne[0]['nitemp'];?>">
                    </div>

                    <div class="mb-3">
                        <label for="emaemp" class="form-label fw-semibold">Correo electrónico</label>
                        <input type="email" name="emaemp" id="emaemp" class="form-control rounded-3" placeholder="Email de la empresa" value="<?php if($datOne && $datOne[0]['emaemp']) echo $datOne[0]['emaemp'];?>">
                    </div>

                    <input type="hidden" name="idemp" value="<?php if($datOne && $datOne[0]['idemp']) echo $datOne[0]['idemp'];?>">
                    <input type="hidden" name="idusu" value="<?php if($datOne && $datOne[0]['idusu']) echo $datOne[0]['idusu'];?>">
                    <input type="hidden" name="ope" value="save">

                    <div class="d-flex justify-content-center mt-4 gap-3">
                        <button type="submit" class="btn btn-primary rounded-3 shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                        </button>
                        <button type="reset" class="btn btn-outline-secondary rounded-3 shadow-sm">
                            <i class="fa-solid fa-xmark me-1"></i> Limpiar
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- CARD INFORMACIÓN ACTUAL -->
        <?php if($datOne && $datOne[0]['idemp']): ?>
        <div class="card mt-4 shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($datOne[0]['nomemp']); ?></h5>
                <p class="card-text mb-1"><i class="fa-solid fa-id-badge me-2 text-secondary"></i>NIT: <?= htmlspecialchars($datOne[0]['nitemp']); ?></p>
                <p class="card-text mb-1"><i class="fa-solid fa-envelope me-2 text-secondary"></i>Email: <?= htmlspecialchars($datOne[0]['emaemp']); ?></p>
                <p class="card-text"><i class="fa-solid fa-user me-2 text-secondary"></i>Administrador ID: <?= htmlspecialchars($datOne[0]['idusu']); ?></p>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>
