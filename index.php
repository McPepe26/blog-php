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
                    $conectar = Conectar::conexion();
                    $sql = "select * from entradas";
                    $resultado = $conectar->prepare($sql);

                    if(!$resultado->execute()){
                        die("Fallo en la consulta");
                        exit();
                    }else{
                        while($reg = $resultado -> fetch()){
                            $idEntrada = $reg["id_entrada"];
                            $entradaTitulo = $reg["entrada_titulo"];
                            $entradaAutor = $reg["entrada_autor"];
                            $status = $reg["entrada_status"];
                            $entradaFecha = date("d-m-Y", strtotime($reg["entrada_fecha"]));
                            $entradaImagen = $reg["entrada_imagen"];
                            $entradaContenido = substr($reg["entrada_contenido"], 0, 100);
                            if(strcmp($status, "Publicada") == 0){
                                ?>
                                    <h2>
                                        <a href="entrada.php?id=<?php echo $idEntrada;?>"><?php echo $entradaTitulo; ?></a>
                                    </h2>
                                    <p class="lead">
                                        Por <a href="index.php"><?php echo $entradaAutor;?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $entradaFecha;?></p>
                                    <hr>
                                    <img class="img-responsive" src="images/<?php echo $entradaImagen;?>" alt="">
                                    <hr>
                                    <p><?php echo $entradaContenido;?></p>
                                    <a class="btn btn-primary" href="entrada.php?id=<?php echo $idEntrada;?>">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>

                                    <hr>
                                <?php
                            }
                        }
                    }
               ?>
               <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php require_once "includes/sidebar.php";?>
        </div>
        <!-- /.row -->
        <hr>
        <ul class="pager">
        </ul>

   

<?php require_once "includes/footer.php";?>
