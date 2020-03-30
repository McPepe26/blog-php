    <h1 class="text-primary">Comentarios</h1>

    <form action="" method='post'>
        <table class="table table-bordered table-hover">
            <div id="contenedor_opciones" class="col-xs-4">
                <select class="form-control" name="opciones" id="">
                <option value="">Seleccione Opciones</option>
                <option value="">Aprobar</option>
                <option value="">No aprobar</option>
                <option value="">Eliminar</option>
                </select>
            </div> 
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Aplicar">
            </div>
            <thead>
                <tr>
                    <th><input id="selecciona_todo" type="checkbox"></th>
                    <th>Id</th>
                    <th>Autor</th>
                    <th>Comentario</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>En respuesta a</th>
                    <th>Fecha</th>
                    <th>Aprobar</th>
                    <th>No aprobar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 0; $i < count($datos); $i++){ 
                        ?>
                        <tr>
                            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='1'></td>
                            <td><?php echo $datos[$i]["id_comentario"];?></td>
                            <td><?php echo $datos[$i]["comentario_autor"];?></td>
                            <td><?php echo $datos[$i]["comentario_contenido"];?></td>
                            <td><?php echo $datos[$i]["comentario_email"];?></td>
                            <td><?php echo $datos[$i]["comentario_status"];?></td>
                            <td><a href='/entrada.php?id=<?php echo $datos[$i]["id_entrada_comentario"];?>'><?php echo $datos[$i]["entrada_titulo"];?></a> </td>
                            <td><?php echo date("d-m-Y", strtotime($datos[$i]["comentario_fecha"]));?></td>
                            <td><a class="btn btn-primary" href="/admin/comentarios.php?ac=1&id=<?php echo $datos[$i]["id_comentario"]?>"><i class="fa fa-check"></i> Aprobar</a></td>
                            <td><a class="btn btn-warning" href="/admin/comentarios.php?ac=2&id=<?php echo $datos[$i]["id_comentario"]?>"><i class="fa fa-times"></i> No aprobar</a></td>
                            <td><a class="btn btn-danger" href="/admin/comentarios.php?ac=3&id=<?php echo $datos[$i]["id_comentario"]?>"><i class="fa fa-trash"></i> Eliminar</a></td>
                        </tr>   
                        <?php
                }  
                ?>  
            </tbody>
        </table>            
    </form>
            
