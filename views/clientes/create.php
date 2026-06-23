<?php include "views/layouts/header.php"; ?>
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-body">
        <h4>Crear Nuevo Cliente</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Código del Cliente</label>
                <input type="text" name="codCliente" class="form-control" placeholder="Ej: C01" maxlength="5" required>
            </div>
            <div class="mb-3">
                <label>Nombre del Cliente o Empresa</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
            </div>
            <div class="mb-3">
                <label>RUC</label>
                <input type="text" name="ruc" class="form-control" placeholder="Ej: 20123456789" maxlength="11" required>
            </div>
            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ej: 987654321" maxlength="9" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?action=distritos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<?php include "views/layouts/footer.php"; ?>