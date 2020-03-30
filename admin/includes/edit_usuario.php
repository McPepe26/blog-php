   <?php
      if(isset($_GET["id"])){
         $id = $_GET["id"];
         $usuario = $usuarios->getUsuarioById($id);
      }

      if(isset($_POST["edit_user"])){
         $id = $_GET["id"];
         $nombre = $_POST["user_firstname"];
         $apellido = $_POST["user_lastname"];
         $rol = $_POST["user_role"];
         $imagen = $_FILES["image"]["name"];
         $imagenTemp = $_FILES["image"]["tmp_name"];
         move_uploaded_file($imagenTemp, "../images/img-users/$usuario/$imagen");
         $usuario = $_POST["username"];
         $correo = $_POST["user_email"];
         $contrasenia = $_POST["user_password"];

         $usuarios->editarUsuario($usuario, $contrasenia, $nombre, 
                                 $apellido, $correo, $imagen, $rol, $id);
      }

      if(isset($_GET["i"])){
         switch($_GET["i"]){
            case "1":
               ?>
                  <h2 style = "color:red">El campo está vacío</h2>
               <?php
               break;
            case "2":
               ?>
                  <h2 style = "color:red">Fallo en la consulta</h2>
               <?php
               break;
            case "3":
               ?>
                  <h2 style = "color:green">Se edito el usuario</h2>
               <?php
               break;
            case "4":
               ?>
                  <h2 style = "color:red">No se edito el usuario</h2>
               <?php
               break;
         }
     }
   ?>
   
   <h1 class="text-primary">Editar usuario</h1>
   
   <form action="" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="title">Nombre</label>
         <input type="text" value="<?php echo $usuario[0]["nombre"]?>" class="form-control" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" value="<?php echo $usuario[0]["apellido"]?>" class="form-control" name="user_lastname">
      </div>   
     
      <div class="form-group">
         <select name="user_role" id="">
            <option value='Suscriptor' <?php if(strcmp($usuario[0]["usuario"], "Suscriptor")) echo 'selected'?>>Suscriptor</option>
            <option value='Administrador' <?php if(strcmp($usuario[0]["usuario"], "Administrador")) echo 'selected'?>>Administrador</option>
         </select>
      </div>
      
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Usuario</label>
          <input type="text" value="<?php echo $usuario[0]["usuario"]?>" class="form-control" name="username">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $usuario[0]["correo"]?>" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" value="" class="form-control" name="user_password">
      </div>

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Editar Usuario">
      </div>


</form>
    