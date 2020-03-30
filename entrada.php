<?php require_once "includes/conexion.php"?>
<?php require_once "includes/header.php"?>
<?php require_once "admin/Modelos/Entradas.php"?>
<?php require_once "admin/Modelos/Comentarios.php"?>

<?php
    $comentarios = new Comentarios();
    if(isset($_GET["id"])){
        $idEntrada = $_GET["id"];
        $entrada = new Entradas();

        $datos = $entrada->getEntradaByIdUser($idEntrada);
        $comentariosDatos =   $comentarios->getComentariosById($idEntrada);
    }

    if(isset($_POST["crear_comentario"])){
        $idEntrada = $_GET["id"];
        $autor = $_POST["comentario_autor"];
        $email = $_POST["comentario_email"];
        $contenido = $_POST["comentario_contenido"];
        $comentarios->insertarComentario($idEntrada, $autor, $email, $contenido);
    }  
?>


<!-- MENU -->

<?php require_once "includes/menu.php"?>

<!-- Page content-->
<div class="container">

    <div class="row">
        <!-- Blog Entries Column-->

        <div class="col-md-8">
            <!--<h1 class="page-header"> Entrada</h1>--/>
            <!-- First Blog Post-->
            <h2>
                <a href="#"><?php echo $datos[0]["entrada_titulo"] ?></a>
            </h2>
            <p>
                por <a href="index.php"><?php echo $datos[0]["entrada_autor"] ?></a>
            </p>
            <p>
                <span class="glyphicon glyphicon-time"></span>
                <?php echo date("d-m-Y", strtotime($datos[0]["entrada_fecha"]))?>
            </p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $datos[0]["entrada_imagen"] ?>" alt="">
            <hr>
            <p><?php echo $datos[0]["entrada_contenido"] ?></p>
            <hr>

            <!--Blog Comments-->
            <!--Posted Comments-->
            <!--Comments Form-->
            <div class="well">
                <?php
                    if(isset($_GET["e"])){
                        switch( $_GET["e"]){
                            case 1: 
                                ?>
                                <h2 style = "color:red">Ingresa todos los datos para insertar tu comentario</h2>
                                <?php
                                break;
                            case 2: 
                                ?>
                                <h2 style = "color:red">Fallo al insertar comentario en la base de datos</h2>
                                <?php
                                break;
                            case "3":
                                ?>
                                    <h2 style = "color:green">El comentario debe ser aprobado por el administrador</h2>
                                <?php
                                break;
                            case "4":
                                ?>
                                    <h2 style = "color:red">No se inserto el comentario</h2>
                                <?php
                                break;
                        }
                    }
                ?>
                <h4>Deja un Comentario</h4>
                <form action="#" method="post" role="form">
                    <div class="form-group">
                        <label for="comentario_autor">Autor</label>
                        <input type="text" name="comentario_autor" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comentario_email">Email</label>
                        <input type="email" name="comentario_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comentario_contenido">Comentario</label>
                        <textarea name="comentario_contenido" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" name="crear_comentario" class="btn btn-primary">Enviar</button>
                </form>

                <hr>

                <!--Comentario-->
                <?php
                    for($i = 0; $i < count($comentariosDatos); $i++){
                        if(strcmp($comentariosDatos[$i]["comentario_status"], "Aprobado") == 0){
                            ?>
                                <div>
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                                    </a>

                                    <div class="media-body" style="padding: 10px;">
                                        <h4 class="media-heading">
                                            <?php echo $comentariosDatos[$i]["comentario_autor"];?>
                                            <small><?php echo date("d-m-Y", strtotime($comentariosDatos[$i]["comentario_fecha"]));?></small>
                                        </h4>
                                        <?php echo $comentariosDatos[$i]["comentario_contenido"];?>
                                    </div>
                                </div> 
                                <br>
                                <br>
                            <?php
                        }
                    }
                ?>
                
            </div>
        </div>
        
        <?php require_once "includes/sidebar.php"?>
        
    </div>
<?php require_once "includes/footer.php";?>

