<?php include "views/layouts/header.php"; ?>

<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-body">
        <h4>Editar Proyecto</h4>
        <form method="POST">
            
            <div class="mb-3">
                <label>Código</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($p->getCodigo()); ?>" disabled>
                <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($p->getCodigo()); ?>">
            </div>
            
            <div class="mb-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($p->getNombre_Proyecto()); ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Estado</label>
                <input type="text" name="estado" class="form-control" value="<?php echo htmlspecialchars($p->getEstado()); ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Tareas</label>
                <input type="text" name="tareas" step="0.01" class="form-control" value="<?php echo $p->getTareas(); ?>" required>
            </div>

            <div class="mb-3">
                <label>Cliente</label>
                <select name="CodCliente" class="form-select" required>
                    <option value="">-- Seleccione un Cliente --</option>
                    <?php foreach ($listaClientes as $cliente): ?>
    <?php
        $selected = ($cliente->codCliente == $p->getIdCliente()) ? 'selected' : '';
    ?>
    <option value="<?php echo htmlspecialchars($cliente->codCliente); ?>" <?php echo $selected; ?>>
        <?php echo htmlspecialchars($cliente->nombre); ?>
    </option>
<?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php?action=proyectos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php include "views/layouts/footer.php"; ?>