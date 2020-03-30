<?php
    class Categorias extends Conectar{
        //Atributos
        private $db;
        private $categorias;

        //Metodos
        public function Categorias(){
            $this->db = Conectar::conexion();
            $this->categorias = array();
        }

        public function getCategorias(){
            $conectar = $this->db;

            $sql = "select * from categorias";

            $resultado = $conectar->prepare($sql);

            if(!$resultado->execute()){
                die("fallo en la consulta");
            }else{
                while($reg = $resultado->fetch()){
                    $this->categorias[] = $reg;
                }
            }
            
            return $this->categorias;
        }

        public function insertarCategoria($catTitulo){

            $catTitulo = $_POST["catTitulo"];

            if(empty($_POST["catTitulo"])){
                header("Location:categorias.php?m=1");
                //exit();
            }else{
                //Validar si existe la categoria
                $sql = "select * from categorias where titulo = ?";

                $resultado = $this->db->prepare($sql);

                $resultado->bindValue(1, $catTitulo);

                if(!$resultado->execute()){
                    header("Location:categorias.php?m=2");
                }else{
                    if($resultado->rowCount()>0){
                        header("Location:categorias.php?m=3");
                        echo "<h2 style = 'color: red'>Ya existe la categoria</h2>"; 
                    }else{
                        $sql = "insert into categorias values(null, ?)";

                        $resultado = $this->db->prepare($sql);

                        $resultado->bindValue(1, $catTitulo);
                        if(!$resultado->execute()){
                            header("Location:categorias.php?m=2");
                        }else{
                            if($resultado->rowCount()>0){
                                header("Location:categorias.php?m=4");
                            }else{
                                header("Location:categorias.php?m=5");
                            }
                        }
                    }
                }  
            }
        }

        public function eliminarCategoria($idCategoria){
            /*Validamos que exista el id_categorias en la base de datos*/
            
            $idCategoria = $_GET["eliminar"];

            $sql = "select * from categorias where id_categoria = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $idCategoria);

            if(!$resultado->execute()){
                header("Location:categorias.php?m=2");
            }else{
                /*Existe el idCategoria*/
                if($resultado->rowCount()>0){
                    $sql = "delete from categorias where id_categoria = ?; ALTER TABLE categorias AUTO_INCREMENT = 1";
                    $resultado = $this->db->prepare($sql);
                    $resultado->bindValue(1, $idCategoria);

                    if(!$resultado->execute()){
                        header("Location:categorias.php?m=2");
                    }else{
                        /*Validacion de si se ha eliminado la categoria */
                        if($resultado->rowCount()>0){
                            header("Location:categorias.php?m=6");
                        }else{
                            header("Location:categorias.php?m=7");
                        }
                    }
                }else{
                    /*No existe la categoria */
                    header("Location:categorias.php?m=7"); 
                }
            }
        }

        public function getCategoriaById($idCategoria){
            $sql = "select * from categorias where id_categoria = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $idCategoria);

            if(!$resultado->execute()){
                header("Location:categorias.php?m=2");
            }else{
                /*Existe el idCategoria*/
                if($resultado->rowCount()>0){
                    while($reg = $resultado->fetch()){
                        $catTitulo = $reg["titulo"];

                        echo "<input value='$catTitulo' type='text' class='form-control' name='catTitulo'>";
                    }
                }else{
                    header("Location:categorias.php?m=2"); 
                }
            }
        }

        public function editarCategoria($idCategoria, $catTitulo){
            if(empty($_POST["catTitulo"])){
                header("Location:categorias.php?editar=$idCategoria&m=1");
                exit();
            }

            /*Valido que la categoria no se repita*/
            $sql = "select * from categorias where titulo = ?";
            $resultado = $this->db->prepare($sql);
            $resultado->bindValue(1, $catTitulo);

            if(!$resultado->execute()){
                header("Location:categorias.php?editar=$idCategoria&m=2");
            }else{
                if($resultado->rowCount()>0){
                    //Existe la categoria en los registros
                    header("Location:categorias.php?editar=$idCategoria&m=3");
                }else{
                    //Edito la categoria
                    $sql = "update categorias set titulo = ? where id_categoria = ?";
                    $resultado = $this->db->prepare($sql);
                    $resultado->bindValue(1, $catTitulo);
                    $resultado->bindValue(2, $idCategoria);
                    
                    if(!$resultado->execute()){
                        header("Location:categorias.php?editar=$idCategoria&m=2");
                    }else{
                        if($resultado->rowCount()>0){
                            //Existe la categoria en los registros
                            header("Location:categorias.php?editar=$idCategoria&m=8");

                        }else{
                            header("Location:categorias.php?editar=$idCategoria&m=9");
                        }
                    }

                }
            }

        }
    }
?>