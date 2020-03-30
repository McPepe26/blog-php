<?php require_once "includes/admin_header.php" ?>

    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php require_once "includes/admin_menu.php" ?>
        
        
    

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Comentarios
                
            </h1>
            


<form action="" method='post'>
               
               <table class="table table-bordered table-hover">
               
       <div id="contenedor_opciones" class="col-xs-4">

        <select class="form-control" name="opciones" id="">
        <option value="">Seleccione Opciones</option>
        <option value="approved">Aprobar</option>
        <option value="unapproved">No Aprobar</option>
        <option value="delete">Eliminar</option>
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
                        <th>No Aprobar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                
            <tbody>
                      

  


   
            </tbody>
            </table>
            
            </form>
            


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>

            
            
            
            
            
            
            
      