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
                   
                   BACKEND - CMS
                
  </h1>
            
             <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="titulo">Nombre</label>
          <input type="text" value="eyter" class="form-control" name="usuario_nombre">
      </div>
      
      
      

       <div class="form-group">
         <label for="entradas_status">Apellido</label>
          <input type="text" value="Higuera" class="form-control" name="usuario_apellido">
      </div>
     
     
         <div class="form-group">
       
       <select name="usuario_rol" id="">
       
       <option value='administrador'>Administrador</option>
       
       <option value="suscriptor">Suscriptor</option>
           
       </select>
             
      </div>
 

      <div class="form-group">
         <label for="entrada_etiquetas">Usuario</label>
          <input type="text" value="ucevito" class="form-control" name="usuario">
      </div>
      
      <div class="form-group">
         <label for="entrada_contenido">Email</label>
          <input type="email" value="eyter@gmail.com" class="form-control" name="usuario_email">
      </div>
      
      <div class="form-group">
         <label for="entrada_contenido">Password</label>
          <input type="password" value="............" class="form-control" name="usuario_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_usuario" value="Editar Perfil">
      </div>


</form>
    
            
            
            
      
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>
