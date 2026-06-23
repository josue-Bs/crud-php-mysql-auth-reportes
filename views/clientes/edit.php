<?php include "views/layouts/header.php"; ?>
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-body">
        <h4>Editar Cliente</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Código (No editable)</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($cliente->codCliente); ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Nombre del Cliente</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($cliente->nombre); ?>" required>
            </div>
            <div class="mb-3">
                <label>RUC</label>
                <input type="text" name="ruc" class="form-control" value="<?php echo htmlspecialchars($cliente->ruc); ?>" required>
            </div>
            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($cliente->telefono); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="index.php?action=clientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<?php include "views/layouts/footer.php"; ?>