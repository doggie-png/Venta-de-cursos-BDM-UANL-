<?php
    include_once("Model/CategoriaModel.php");
    include_once("Model/SessionControl.php");
    
    $Usuario = new SessionControl();
    $IdUsuario = $Usuario->SessionGetID();
    
    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel->GetCategoriasUsuario($IdUsuario);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Categorías</title>
    <link rel="stylesheet" href="view/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mis Categorías</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Id Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $index => $categoria): ?>
                        <tr>
                            <form action="index.php?control=categoria&accion=Editar" method="POST" class="formRegCat">
                                <td>
                                    <?= htmlspecialchars($categoria['IdCategoria']) ?>
                                    <input type="hidden" name="editIdCat" value="<?= htmlspecialchars($categoria['IdCategoria']) ?>">
                                </td>
                                <td><input class="form-control form-control-sm" type="text" name="editNombCat" value="<?= htmlspecialchars($categoria['Nombre']) ?>"></td>
                                <td><input class="form-control form-control-sm" type="text" name="editDescCat" value="<?= htmlspecialchars($categoria['Descripcion']) ?>"></td>
                                <td><?= htmlspecialchars($categoria['FechaCreacion']) ?></td>
                                <td>
                                    <?= $categoria['Estado'] ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>' ?>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-warning btn-sm" name="EditarCategoria">
                                        <i class="fa fa-pencil"></i> Editar
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm" name="EliminarCategoria" onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No se encontraron categorías.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
