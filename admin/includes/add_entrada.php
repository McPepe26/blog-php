   <?php
      
      
      if(isset($_POST["crear_entrada"])){
         $idCategoriaEntrada = $_POST["entrada_categoria"];
         $entradaTitulo = $_POST["titulo"]; 
         $entradaAutor = $_POST["entrada_usuario"]; 

         $entradaImagen = $_FILES["imagen"]["name"];
         $entradaImagenTemp = $_FILES["imagen"]["tmp_name"];
         move_uploaded_file($entradaImagenTemp, "../images/$entradaImagen");
         
         $entradaContenido = $_POST["entrada_contenido"]; 
         $entradaEtiquetas = $_POST["entrada_etiquetas"]; 
         $entradaComent = 0; 
         $entradaStatus = $_POST["entrada_status"]; 

         //Si se envia el formulario registramos la entrada
         $entradas->insertarEntrada($idCategoriaEntrada, $entradaTitulo, 
                         $entradaAutor, $entradaImagen, 
                         $entradaContenido, $entradaEtiquetas, 
                         $entradaComent, $entradaStatus);
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
                  <h2 style = "color:green">Se inserto el registro</h2>
               <?php
               break;
            case "4":
               ?>
                  <h2 style = "color:red">No se inserto el registro</h2>
               <?php
               break;
         }
      }
   ?>
   
   <h1 class="text-primary">Crear Entrada</h1>
   
   <form action="" method="post" enctype="multipart/form-data">    

      <div class="form-group">
         <label for="titulo">Titulo de la entrada</label>
         <input type="text" class="form-control" name="titulo">
      </div>

      <div class="form-group">
         <label for="categoria">Categoría</label>
         <select name="entrada_categoria" id="">
            <option value="">seleccione</option>

            <?php
               //Llenar las categorias
               $cat = $categoria->getCategorias();

               for($i = 0; $i < count($cat); $i++){
                  ?>
                     <option value="<?php echo $cat[$i]["id_categoria"]?>"><?php echo $cat[$i]["titulo"]?></option>
                  <?php
               }
            ?>
            

         </select>
      </div>

      <div class="form-group">
         <label for="usuarios">Usuarios</label>
         <select name="entrada_usuario" id="">
            <option value="">seleccione</option>
            <option value="ucevito">ucevito</option>
            <option value="daniel">daniel</option>
            <option value="carlos">carlos</option>
         </select>
      </div>

      <div class="form-group">
         <select name="entrada_status" id="">
            <option value="">Status de la entrada</option>
            <option value="publicado">Publicado</option>
            <option value="borrador">Borrador</option>
         </select>
      </div>
      
      <div class="form-group">
         <label for="entrada_imagen">Imagen de la entrada</label>
         <input type="file"  name="imagen">
      </div>

      <div class="form-group">
         <label for="entrada_etiquetas">Etiquetas de la entrada</label>
         <input type="text" class="form-control" name="entrada_etiquetas">
      </div>
      
      <div class="form-group">
         <label for="entrada_contenido">Contenido de la entrada</label>
         <textarea class="form-control" name="entrada_contenido" id="body" cols="30" rows="10"></textarea>
      </div>

      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="crear_entrada" value="Publicar entrada">
      </div>
   </form>
    