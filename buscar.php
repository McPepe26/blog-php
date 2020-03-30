<?php  require_once "includes/conexion.php"; ?>
 <?php  require_once "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  require_once "includes/menu.php"; ?>

    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               <?php
                    if(isset($_POST["submit"])){
                        $buscar = $_POST["buscar"];
                    }

                    $conectar = Conectar::conexion();
                    $sql = "select * from entradas where entrada_etiquetas like '%$buscar%'";

                    $resultado = $conectar->prepare($sql);

                    if(!$resultado->execute()){
                        die("fallo en la consulta");
                    }else{
                        if($resultado->rowCount()==0){
                            echo "No hay resultados";
                        }else{    
                            while($reg = $resultado -> fetch()){
                                $entradaTitulo = $reg["entrada_titulo"];
                                $entradaAutor = $reg["entrada_autor"];
                                $entradaFecha = $reg["entrada_fecha"];
                                $entradaImagen = $reg["entrada_imagen"];
                                $entradaContenido = $reg["entrada_contenido"];
                                ?>
                                    <h2>
                                        <a href="#"><?php echo $entradaTitulo; ?></a>
                                    </h2>
                                    <p class="lead">
                                        Por <a href="index.php"><?php echo $entradaAutor;?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $entradaFecha;?></p>
                                    <hr>
                                    <img class="img-responsive" src="images/<?php echo $entradaImagen;?>" alt="">
                                    <hr>
                                    <p><?php echo $entradaContenido;?></p>
                                    <a class="btn btn-primary" href="#">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>

                                    <hr>
                                <?php
                            }
                        }
                    }
               ?>
                    
            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php require_once "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>


        <ul class="pager">

       

        </ul>

   

<?php require_once "includes/footer.php";?>
