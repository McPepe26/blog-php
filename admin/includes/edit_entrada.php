<?php      
      
   if(isset($_POST["editar_entrada"])){
      
      $idEntrada = $_GET["id_entrada"];
      $idCategoriaEntrada = $_POST["entrada_categoria"];
      $entradaTitulo = $_POST["titulo"]; 
      $entradaAutor = $_POST["entrada_usuario"]; 

      $entradaImagen = $_FILES["imagen"]["name"];
      $entradaImagenTemp = $_FILES["imagen"]["tmp_name"];
      move_uploaded_file($entradaImagenTemp, "../images/$entradaImagen");
      
      //Validamos si el campo imagen esta vacio
      if(empty($_FILES["imagen"]["name"])){
         $datos = $entradas->getEntradaById($idEntrada);
         $entradas->imagen = $datos[0]["entrada_imagen"];
         $entradaImagen = $entradas->imagen;
      }

      $entradaContenido = $_POST["entrada_contenido"]; 
      $entradaEtiquetas = $_POST["entrada_etiquetas"];
      $entradaStatus = $_POST["entrada_status"]; 

      //Si se envia el formulario registramos la entrada
      $entradas->editartarEntrada($idEntrada, $idCategoriaEntrada, $entradaTitulo, 
                     $entradaAutor, $entradaImagen, 
                     $entradaContenido, $entradaEtiquetas, 
                     $entradaStatus);
   }



   if(isset($_GET["e"])){
      switch($_GET["e"]){
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
               <h2 style = "color:green">Se editó el registro</h2>
            <?php
            break;
         case "4":
            ?>
               <h2 style = "color:red">No se editó el registro</h2>
            <?php
            break;
      }
   }

   if(isset($_GET["id_entrada"])){

      $idEntrada = $_GET["id_entrada"];
      $datos = $entradas->getEntradaById($idEntrada);
      $entradas->imagen = $datos[0]["entrada_imagen"];
   }
   
?>

<form action="" method="post" enctype="multipart/form-data">    
     
   <div class="form-group">
      <label for="titulo">Titula de Entrada</label>
      <input value="<?php echo $datos[0]["entrada_titulo"];?>"  type="text" class="form-control" name="titulo">
   </div>

   <div class="form-group">
      <label for="categorias">Categorías</label>
      <select name="entrada_categoria" id="">
         <?php
            $datosCat = $categoria->getCategorias();
            for($i = 0; $i<count($datosCat); $i++){

               if(strcasecmp($datosCat[$i]["id_categoria"], $datos[0]["id_categoria_entrada"]) === 0){
                  ?>
                     <option value='<?php echo $datosCat[$i]['id_categoria']; ?>' selected><?php echo $datosCat[$i]['titulo'];?></option>";
                  <?php
               }else{
                  ?>
                     <option value='<?php echo $datosCat[$i]['id_categoria']; ?>'><?php echo $datosCat[$i]['titulo']; ?></option>";
                  <?php
               }
            }
         ?>  
      </select>

   </div>

   <div class="form-group">
      <label for="usuarios">Usuarios</label>
      <select name="entrada_usuario" id="">
         <option value="<?php echo $datos[0]["entrada_autor"];?>" selected><?php echo $datos[0]["entrada_autor"];?></option>
         <option value="">daniel</option>
         <option value="">carlos</option>
      </select>   
   </div>
 
   <div class="form-group">
      <select name="entrada_status" id="">
         <option value='Publicada' <?php if(strcmp($datos[0]["entrada_status"], "Publicada")) echo 'selected' ?>>Publicada</option>
         <option value='Borrador' <?php if(strcmp($datos[0]["entrada_status"], "Publicada")) echo 'selected' ?>>Borrador</option>            
      </select>
   </div>
      
   <div class="form-group">
      <img width="100" src="../images/<?php echo $entradas->imagen;?>" alt="">
      <input  type="file" name="imagen">
   </div>

   <div class="form-group">
      <label for="entrada_etiquetas">Etiquetas de Entrada</label>
      <input value="<?php echo $datos[0]["entrada_etiquetas"];?>"  type="text" class="form-control" name="entrada_etiquetas">
   </div>
      
   <div class="form-group">
      <label for="entrada_contenido">Entrada de Contenido</label>
      <textarea  class="form-control" name="entrada_contenido" id="body" cols="30" rows="10"><?php echo $datos[0]["entrada_contenido"];?></textarea>
   </div>

   <div class="form-group">
      <input class="btn btn-primary" type="submit" name="editar_entrada" value="Editar Entrada">
   </div>

</form>