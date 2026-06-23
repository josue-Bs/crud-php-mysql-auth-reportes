<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema CRUD DAO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=proyects">Sistema DAO</a>
        
        <?php if(isset($_SESSION['user'])): ?>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=proyects">Proyectos</a>
                    </li>
                    
                    <?php if($_SESSION['rol'] === 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=users">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=clientes">Clientes</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <span class="navbar-text me-3 text-white">
                    Usuario: <?php echo htmlspecialchars($_SESSION['user']); ?> (<?php echo ucfirst($_SESSION['rol']); ?>)
                </span>
                <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Salir</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
   

