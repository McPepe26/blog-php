<?php

    if(isset($_GET["eliminar"])){
        $idEntrada = $_GET["eliminar"];
        $entradas->eliminarEntrada($idEntrada);
    }
?>

<h1 class="text-primary">Entradas</h1>

<form action="" method='post'>

    <table class="table table-bordered table-hover">

        <div id="contenedor_opciones" class="col-xs-4">
            <select class="form-control" name="opciones" id="">
                <option value="">Seleccione Opciones</option>
                <option value="published">Publicar</option>
                <option value="draft">Borrador</option>
                <option value="delete">Borrar</option>
                <option value="clone">Clonar</option>
            </select>
        </div> 

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Aplicar">
            <a class="btn btn-primary" href="entradas.php?accion=add_entrada">Añadir Nuevo</a>

        </div>

        <thead>
            <tr>
                <th><input id="selecciona_todo" type="checkbox"></th>
                <th>Id</th>
                <th>Usuarios</th>
                <th>Titulo</th>
                <th>Categoría</th>
                <th>Status</th>
                <th>Imagen</th>
                <th>Etiquetas</th>
                <th>Comentarios</th>
                <th>Fecha</th>
                <th>Vista de Entrada</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Vistas</th>
            </tr>
        </thead>

        <tbody>
            <?php
               for($i = 0; $i < count($datos); $i++){ 
                    ?>
                    <tr>
                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='1'></td>
                        <td><?php echo $datos[$i]["id_entrada"];?></td>
                        <td><?php echo $datos[$i]["entrada_autor"];?></td>
                        <td><?php echo $datos[$i]["entrada_titulo"];?></td>
                        <td><?php echo $datos[$i]["titulo"];?></td>
                        <td><?php echo $datos[$i]["entrada_status"];?></td>
                        <td><img width='100' src="../images/<?php echo $datos[$i]["entrada_imagen"];?>" alt=""></td>
                        <td><?php echo $datos[$i]["entrada_etiquetas"];?></td>
                        <td><span class="badge badge-danger"><?php echo $datos[$i]["entrada_coment_count"];?></span></td>
                        <td><?php echo date("d-m-Y",strtotime($datos[$i]["entrada_fecha"]));?></td>
                        <td><a class='btn btn-primary' href='#'><i class="fa fa-eye"></i> Ver Entrada</a></td>
                        <td><a class='btn btn-success' href='entradas.php?accion=edit_entrada&id_entrada=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-pencil"></i>  Editar</a></td>
                        <td> <a class='btn btn-danger' href='entradas.php?eliminar=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-trash"></i>  Eliminar</a>  </td>
                        <td><span class="badge badge-danger">Pendiente</span></td>
                    </tr>   
                    <?php
               }  
            ?>
        </tbody>
    </table>
    
</form>
    

            

            
            
            
            
            
      