


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
                    <th>Acciones</th>                                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td scope="row"><?php echo $usuario->getNombre()?></td>
                        <td><?php echo $usuario->getEmail() ?></td>  
                                                                                 
                        <td class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="">
                                <a href="index.php?accion=updateUsuario&id=<?php echo $usuario->getId()?>" class="btn btn-info">Editar</a>
                                <a href="index.php?accion=deleteUsuario&id=<?php echo $usuario->getId() ?>" class="btn btn-danger">Borrar</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>


