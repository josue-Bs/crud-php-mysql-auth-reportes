<?php include "views/layouts/header.php"; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Mantenimiento de Clientes</h2>
    <a href="index.php?action=cliente-create" class="btn btn-success">Nuevo Cliente</a>
</div>
<table class="table table-striped table-hover shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>Código de Cliente</th>
            <th>Nombre</th>
            <th>RUC</th>
            <th>teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $c): ?>
        <tr>
            <td><?php echo htmlspecialchars($c->codCliente); ?></td>
            <td><?php echo htmlspecialchars($c->nombre); ?></td>
            <td><?php echo htmlspecialchars($c->ruc); ?></td>
            <td><?php echo htmlspecialchars($c->telefono); ?></td>
            <td>
                <a href="index.php?action=cliente-edit&id=<?php echo urlencode($c->codCliente); ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="index.php?action=cliente-delete&id=<?php echo urlencode($c->codCliente); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "views/layouts/footer.php"; ?>