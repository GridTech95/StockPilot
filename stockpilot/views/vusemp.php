<div class="container mt-4">
    <h2 class="mb-4">Gestión de Usuarios de Empresa</h2>

    <!-- Botón para mostrar/ocultar formulario -->
    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#formUsuario" aria-expanded="false" aria-controls="formUsuario">
        + Nuevo Usuario
    </button>

    <!-- Formulario colapsable -->
    <div class="collapse" id="formUsuario">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <?= $idusu ? "Editar Usuario" : "Nuevo Usuario" ?>
            </div>
            <div class="card-body">
                <form method="post" action="home.php?pg=1004&ope=save<?php if($idusu) echo '&idusu='.$idusu; ?>">
                    <div class="row">
                        <!-- Datos básicos -->
                        <div class="col-md-6 mb-3">
                            <label for="nomusu" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nomusu" name="nomusu" 
                                   value="<?= $datOne[0]['nomusu'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apeusu" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apeusu" name="apeusu" 
                                   value="<?= $datOne[0]['apeusu'] ?? '' ?>" required>
                        </div>

                        <!-- Documento -->
                        <div class="col-md-4 mb-3">
                            <label for="tdousu" class="form-label">Tipo Documento</label>
                            <select class="form-select" id="tdousu" name="tdousu" required>
                                <option value="">Seleccione...</option>
                                <option value="CC" <?= (isset($datOne[0]['tdousu']) && $datOne[0]['tdousu']=="CC")?"selected":""; ?>>Cédula</option>
                                <option value="TI" <?= (isset($datOne[0]['tdousu']) && $datOne[0]['tdousu']=="TI")?"selected":""; ?>>Tarjeta Identidad</option>
                                <option value="CE" <?= (isset($datOne[0]['tdousu']) && $datOne[0]['tdousu']=="CE")?"selected":""; ?>>Cédula Extranjera</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="ndousu" class="form-label">Número Documento</label>
                            <input type="text" class="form-control" id="ndousu" name="ndousu" 
                                   value="<?= $datOne[0]['ndousu'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="celusu" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celusu" name="celusu" 
                                   value="<?= $datOne[0]['celusu'] ?? '' ?>">
                        </div>

                        <!-- Acceso -->
                        <div class="col-md-6 mb-3">
                            <label for="emausu" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="emausu" name="emausu" 
                                   value="<?= $datOne[0]['emausu'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pasusu" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="pasusu" name="pasusu" 
                                   value="">
                        </div>

                        <!-- Relación con empresa -->
                        <div class="col-md-6 mb-3">
                            <label for="idemp" class="form-label">Empresa</label>
                            <input type="number" class="form-control" id="idemp" name="idemp" 
                                   value="<?= $datOne[0]['idemp'] ?? '' ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="idper" class="form-label">Perfil</label>
                            <select class="form-select" id="idper" name="idper" required>
                                <option value="">Seleccione...</option>
                                <option value="2">Empleado</option>
                                <option value="3">Invitado</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="home.php?pg=1004" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Lista de Usuarios de Empresa
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Empresa</th>
                        <th>Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($datAll){ foreach($datAll as $d){ ?>
                        <tr>
                            <td><?= $d['nomusu']." ".$d['apeusu'] ?></td>
                            <td><?= $d['tdousu']." ".$d['ndousu'] ?></td>
                            <td><?= $d['emausu'] ?></td>
                            <td><?= $d['celusu'] ?></td>
                            <td><?= $d['idemp'] ?></td>
                            <td><?= $d['idper'] ?></td>
                            <td>
                                <a href="home.php?pg=1004&ope=edi&idusu=<?= $d['idusu'] ?>" 
                                   class="btn btn-warning btn-sm">Editar</a>
                                <a href="home.php?pg=1004&ope=eli&idusu=<?= $d['idusu'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Seguro que desea eliminar este usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
