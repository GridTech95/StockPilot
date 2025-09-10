<!-- Vista: Proveedores -->
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-gradient text-white"
             style="background: linear-gradient(135deg, #4e73df, #224abe);">
            <h4 class="mb-0">
                <i class="fa fa-truck me-2"></i> Gestión de Proveedores
            </h4>
        </div>
        <div class="card-body">
            
            <!-- Botón agregar -->
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProveedor">
                    <i class="fa fa-plus me-1"></i> Nuevo Proveedor
                </button>
            </div>

            <!-- Tabla proveedores -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($proveedores)): ?>
                            <?php foreach ($proveedores as $p): ?>
                                <tr>
                                    <td><?= $p['idprov'] ?></td>
                                    <td><?= htmlspecialchars($p['nomprov']) ?></td>
                                    <td><?= htmlspecialchars($p['contacto']) ?></td>
                                    <td><?= htmlspecialchars($p['telefono']) ?></td>
                                    <td><?= htmlspecialchars($p['email']) ?></td>
                                    <td><?= htmlspecialchars($p['direccion']) ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">No hay proveedores registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProveedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fa fa-truck me-2"></i> Nuevo Proveedor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formProveedor">
                    <input type="hidden" name="idprov" id="idprov">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nomprov" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nomprov" id="nomprov" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contacto" class="form-label">Persona de Contacto</label>
                            <input type="text" class="form-control" name="contacto" id="contacto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea class="form-control" name="direccion" id="direccion" rows="2"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i> Cancelar
                </button>
                <button type="submit" form="formProveedor" class="btn btn-primary">
                    <i class="fa fa-save me-1"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
