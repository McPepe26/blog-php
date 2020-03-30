        <h1 class="text-primary">Usuarios</h1>
               
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
        
                </tr>
            </thead>
                
            <tbody>
                <?php
                    for($i = 0; $i < count($datos); $i++){ 
                        ?>
                            <tr>
                                <td><?php echo $datos[$i]["id_usuario"];?></td>
                                <td><?php echo $datos[$i]["usuario"];?></td>
                                <td><?php echo $datos[$i]["nombre"];?></td>
                                <td><?php echo $datos[$i]["apellido"];?></td>
                                <td><?php echo $datos[$i]["correo"];?></td>
                                <td><?php echo $datos[$i]["rol"];?></td>
                                <td><a class='btn btn-success' href='/admin/usuarios.php?accion=edit_usuario&id=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-pencil"></i>Cambiar rol</a></td>
                                <td> <a class='btn btn-danger' href='/admin/usuarios.php?de=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-trash"></i>  Eliminar</a>  </td>
                            </tr>
                        <?php
                    }
                ?>     
            </tbody>
        </table>
            
            
    