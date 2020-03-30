<?php require_once "includes/admin_header.php";
    require_once "Modelos/Usuarios.php";

    $usuarios = new Usuarios();
    $datos = $usuarios->getUsuarios();

    if(isset($_GET["de"])){
        $id = $_GET["de"];
        $usuarios->eliminarUsuario($id);
    }
?>      
    <div id="wrapper">
        <!-- Navigation -->
        <?php require_once "includes/admin_menu.php" ?>
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">BACKEND - CMS</h1>          
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
                                        <h2 style = "color:red">No existe el registro del usuario</h2>
                                    <?php
                                    break;
                                case "3":
                                    ?>
                                        <h2 style = "color:green">Se ha eliminado el usuario</h2>
                                    <?php
                                    break;
                            }
                        }

                        if(isset($_GET['accion'])){
                            $accion = $_GET['accion'];
                        } else {
                            $accion = '';
                        }
                        switch($accion) {
                            case 'add_usuario';
                                require_once "includes/add_usuario.php";
                                break; 
                            case 'edit_usuario';
                                require_once "includes/edit_usuario.php";
                                break;
                            default:
                                require_once "includes/ver_usuarios.php";
                                break;
                        }
                    ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
     <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>