<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - Sistema CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 text-primary fw-bold">Crear Cuenta</h3>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?action=register" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-semibold text-muted">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ej: mauricio99" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold text-muted">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold text-muted">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4">
                            <label for="rol" class="form-label small fw-semibold text-muted">Rol asignado *ojo solo los administradores pueden insertar clientes*</label>
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="" disabled selected>Selecciona un rol...</option>
                                <option value="administrador">Administrador</option>
                                <option value="empleado">Empleado</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm fw-bold">Registrar Usuario</button>
                    </form>

                    <div class="text-center mt-3">
                    <a href="/crud_productosV2/crud_productos/index.php?action=login"
                    class="small text-decoration-none">
                    ¿Ya tienes cuenta? Inicia Sesión
                    </a>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>