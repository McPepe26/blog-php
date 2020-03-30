    <form action="" method="post">
      <div class="form-group">
        <label for="cat-titulo">Editar Categoría</label>  

        <?php
          $idCategoria = $_GET["editar"];
          $categoria->getCategoriaById($idCategoria);
        ?>       

      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editarCategoria" value="Editar Categoria">
      </div>

    </form>
