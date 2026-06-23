<?php include "views/layouts/header.php"; ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-body">
        <h4>Crear Proyecto</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" placeholder= "Ingrese el codigo del proyecto" maxlength="10" required>
            </div>
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" placeholder= "Ingrese el nombre del proyecto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Estado</label>
                <input type="text" name="estado" placeholder= "Ingrese el estado del proyecto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tareas</label>
                <input type="text" name="tareas" placeholder= "Ingrese las tareas asignadas" step="0.01" class="form-control" required>
            </div>
            
            <div class="mb-3">
    <label class="form-label">Cliente</label>
    <select name="CodCliente" class="form-select" required>
        <option value="">-- Seleccione un Cliente --</option>
        
        <?php if (!empty($listaClientes) && is_array($listaClientes)): ?>
            <?php foreach ($listaClientes as $cliente): ?>
                <option value="<?php echo htmlspecialchars($cliente->codCliente); ?>">
                    <?php echo htmlspecialchars($cliente->nombre); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled>Error: No se cargaron los clientes en la vista</option>
        <?php endif; ?>

    </select>
</div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?action=proyects" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php"; ?>