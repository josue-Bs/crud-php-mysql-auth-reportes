<?php include "views/layouts/header.php"; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de proyectos</h2>
    <div>
        <a href="index.php?action=proyecto-pdf" target="_blank" class="btn btn-danger me-2">
            Exportar PDF
        </a>
        <a href="index.php?action=proyecto-create" class="btn btn-success">Nuevo Proyecto</a>
    </div>
</div>
<table class="table table-striped table-hover shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>Código</th>
            <th>Nombre del Proyecto</th>
            <th>Estado</th>
            <th>Tareas</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($proyectos as $p): ?>
        <tr>
            <td><?php echo htmlspecialchars($p->getCodigo()); ?></td>
            <td><?php echo htmlspecialchars($p->getNombre_Proyecto()); ?></td> 
            <td><?php echo htmlspecialchars($p->getEstado()); ?></td> 
            <td><?php echo htmlspecialchars($p->getTareas()); ?></td> 
            <td><?php echo htmlspecialchars($p->getNombreCliente()); ?></td> 
            <td>
                <a href="index.php?action=proyecto-edit&id=<?php echo urlencode($p->getCodigo()); ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="index.php?action=proyecto-delete&id=<?php echo urlencode($p->getCodigo()); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar el proyecto?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "views/layouts/footer.php"; ?>