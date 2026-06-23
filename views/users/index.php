<?php include "views/layouts/header.php"; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestión de Usuarios</h2>
    <a href="index.php?action=user-create" class="btn btn-success">Nuevo Usuario</a>
</div>
<table class="table table-striped table-hover shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u): ?>
        <tr>
            <td><?php echo $u->getId(); ?></td>
            <td><?php echo htmlspecialchars($u->getUsername()); ?></td>
            <td><span class="badge <?php echo $u->getRol()=='administrador'?'bg-danger':'bg-primary';?>"><?php echo ucfirst($u->getRol()); ?></span></td>
            <td>
                <a href="index.php?action=user-delete&id=<?php echo $u->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "views/layouts/footer.php"; ?>
