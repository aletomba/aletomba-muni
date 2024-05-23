

<body>
<div class="card" color="blue">
    <div class="card-header">
        Lista de Usuarios
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>                                   
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuariosView as $usuario) { ?>
                    <tr>
                        <td scope="row"><?php echo $usuario->getNombre()?></td>
                        <td><?php echo $usuario->getEmail() ?></td>                                            
                        <td>
                            <!-- <div class="btn-group" role="group" aria-label="">
                                <a href="index.php?accion=editar&id=<?php echo $auto->id ?>" class="btn btn-info">Editar</a>
                                <a href="index.php?accion=borrar&id=<?php echo $auto->id ?>" class="btn btn-danger">Borrar</a>
                            </div> -->
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>