<?php require_once "includes/admin_header.php" ?>
<?php require_once "Modelos/Comentarios.php" ?>

    <?php
        $comentarios = new Comentarios();

        if(isset($_GET["ac"])){
            $id = $_GET["id"];
            switch($_GET["ac"]){
                case 1:
                    $comentarios->cambiarStatus($id, "Aprobado");
                    break;
                case 2:
                    $comentarios->cambiarStatus($id, "Desaprobado");
                    break;
                case 3:
                    $comentarios->eliminarComentario($id);
                    break;
            }
        }
        $datos = $comentarios->getComentarios();
    ?>

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
            
                        <?php

                            if(isset($_GET["m"])){
                                switch($_GET["m"]){
                                    case "1":
                                        ?>
                                            <h2 style = "color:red">Fallo en la consulta</h2>
                                        <?php
                                        break;
                                    case "2":
                                        ?>
                                            <h2 style = "color:red">No existe el comentario</h2>
                                        <?php
                                        break;
                                    case "3":
                                        ?>
                                            <h2 style = "color:green">Cambiado el status del comentario</h2>
                                        <?php
                                        break;
                                    case "4":
                                        ?>
                                            <h2 style = "color:green">Se ha eliminado el comentario</h2>
                                        <?php
                                        break;
                                }
                            }

                            require_once "includes/ver_comentarios.php";
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
            
        <?php require_once "includes/admin_footer.php" ?>
