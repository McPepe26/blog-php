<?php

    class Entradas extends Conectar{
        //Atributos
        private $db;
        private $entradas;
        private $entradaById;
        public $imagen;

        //Metodos
        public function __construct(){
            $this->db = Conectar::conexion();
            $this->entradas = array();
            $this->entradaById = array();
        }
        
        public function getEntradas(){
            $sql = "SELECT * FROM entradas INNER JOIN categorias ON id_categoria_entrada = id_categoria ORDER BY id_entrada ASC";

            $resultado = $this->db->prepare($sql);

            if(!$resultado->execute()){
                header("Location:index.php?m=1");
            }else{
                while($reg = $resultado->fetch()){
                    $this->entradas[] = $reg;
                }

                return $this->entradas;
            }
        }

        public function insertarEntrada($idCategoriaEntrada, $entradaTitulo, $entradaAutor, $entradaImagen, 
                                    $entradaContenido, $entradaEtiquetas, $entradaComent, $entradaStatus){
            //Validamos que los campos no esten vacios
            if(empty($_POST["titulo"]) or 
               empty($_POST["entrada_categoria"]) or 
               empty($_POST["entrada_usuario"]) or 
               empty($_POST["entrada_status"]) or 
               empty($_FILES["imagen"]) or
               empty($_POST["entrada_etiquetas"]) or 
               empty($_POST["entrada_contenido"])){
                header("Location:entradas.php?accion=add_entrada&i=1");
                exit();
            }
            
            $sql = "insert into entradas values(null, ?, ?, ?, now(), ?, ?, ?, ?, ?)";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $_POST["entrada_categoria"]);
            $resultado->bindValue(2, $_POST["titulo"]);
            $resultado->bindValue(3, $_POST["entrada_usuario"]);
            $resultado->bindValue(4, $_FILES["imagen"]["name"]);
            $resultado->bindValue(5, $_POST["entrada_contenido"]);
            $resultado->bindValue(6, $_POST["entrada_etiquetas"]);
            $resultado->bindValue(7, $entradaComent);
            $resultado->bindValue(8, $_POST["entrada_status"]);
            

            if(!$resultado->execute()){
                header("Location:entradas.php?accion=add_entrada&i=2");
            }else{
                //Insertamos el registro
                if($resultado->rowCount()>0){
                    header("Location:entradas.php?accion=add_entrada&i=3");
                }else{
                    header("Location:entradas.php?accion=add_entrada&i=4");
                }
            }
        }

        public function getEntradaById($idEntrada){
            $sql = "select * from entradas where id_entrada = ?";

            $resultado = $this->db->prepare($sql);
            $resultado->bindValue(1, $idEntrada);

            if(!$resultado->execute()){
                header("Location:entradas.php?m=1");
            }else{
                //Existe el resgistro de la entrada
                if($resultado->rowCount()>0){
                    while($reg = $resultado->fetch()){
                        $this->entradaById[] = $reg;
                    }
                    return $this->entradaById;
                }else{
                    header("Location:entradas.php?m=2");
                }
            }
        }

        public function getEntradaByIdUser($idEntrada){
            $sql = "select * from entradas where id_entrada = ?";

            $resultado = $this->db->prepare($sql);
            $resultado->bindValue(1, $idEntrada);

            if(!$resultado->execute()){
                header("Location:index.php");
            }else{
                //Existe el resgistro de la entrada
                if($resultado->rowCount()>0){
                    while($reg = $resultado->fetch()){
                        $this->entradaById[] = $reg;
                    }
                    return $this->entradaById;
                }else{
                    header("Location:index.php");
                }
            }
        }

        public function editartarEntrada($idEntrada, $idCategoriaEntrada, $entradaTitulo, $entradaAutor, $entradaImagen, 
                                    $entradaContenido, $entradaEtiquetas, $entradaStatus){
            //Validamos que los campos no esten vacios
            if(empty($_POST["titulo"]) or 
               empty($_POST["entrada_categoria"]) or 
               empty($_POST["entrada_usuario"]) or 
               empty($_POST["entrada_status"]) or 
               empty($entradaImagen) or
               empty($_POST["entrada_etiquetas"]) or 
               empty($_POST["entrada_contenido"])){
                header("Location:entradas.php?accion=edit_entrada&id_entrada=$idEntrada&e=1");
                exit();
            }
            
            $sql = "UPDATE entradas SET id_categoria_entrada = ?, 
                                             entrada_titulo = ?, 
                                             entrada_autor = ?, 
                                             entrada_fecha = now(), 
                                             entrada_imagen = ?, 
                                             entrada_contenido = ?, 
                                             entrada_etiquetas = ?,
                                             entrada_status = ? 
                                             WHERE id_entrada = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $_POST["entrada_categoria"]);
            $resultado->bindValue(2, $_POST["titulo"]);
            $resultado->bindValue(3, $_POST["entrada_usuario"]);
            $resultado->bindValue(4, $entradaImagen);
            $resultado->bindValue(5, $_POST["entrada_contenido"]);
            $resultado->bindValue(6, $_POST["entrada_etiquetas"]);
            $resultado->bindValue(7, $_POST["entrada_status"]);
            $resultado->bindValue(8, $idEntrada);

            if(!$resultado->execute()){
                header("Location:entradas.php?accion=edit_entrada&id_entrada=$idEntrada&e=2");
            }else{
                //Insertamos el registro
                if($resultado->rowCount()>0){
                    header("Location:entradas.php?accion=edit_entrada&id_entrada=$idEntrada&e=3");
                }else{
                    header("Location:entradas.php?accion=edit_entrada&id_entrada=$idEntrada&e=4");
                }
            }
        }

        public function eliminarEntrada($idEntrada){
            $sql = "select * from entradas where id_entrada = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $idEntrada);

            if(!$resultado->execute()){
                header("Location: entradas.php?m=1");
            }else{
                if($resultado->rowCount()>0){
                    $sql = "delete from entradas where id_entrada = ?; ALTER TABLE categorias AUTO_INCREMENT = 1;";
                    
                    $resultado = $this->db->prepare($sql);

                    $resultado->bindValue(1, $idEntrada);
                    if(!$resultado->execute()){
                        header("Location: entradas.php?m=1");
                    }else{
                        if($resultado->rowCount()>0){
                            header("Location: entradas.php?m=3");
                        }else{
                            header("Location: entradas.php?m=2");
                        }
                    }
                }else{
                    header("Location: entradas.php?m=2");
                }
            }
        }

    }
?>









