<?php include "views/layouts/header.php"; ?>
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-body">
        <h4>Crear Usuario</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                   <label>Email</label>
                   <input type="email" name="email" class="form-control" required>
           </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Rol</label>
                <select name="rol" class="form-select">
                    <option value="empleado">Empleado</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php?action=users" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<?php include "views/layouts/footer.php"; ?>
