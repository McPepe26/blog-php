<?php

    class Comentarios extends Conectar{
        //Atributos
        private $db;
        private $comentarios;
        private $comentarioById;
        public $imagen;

        //Metodos
        public function __construct(){
            $this->db = Conectar::conexion();
            $this->comentarios = array();
            $this->comentarioById = array();
        }
        
        public function getComentarios(){
            $sql = "select * from comentarios INNER JOIN entradas on entradas.id_entrada = comentarios.id_entrada_comentario";

            $resultado = $this->db->prepare($sql);

            if(!$resultado->execute()){
                header("Location:index.php?m=1");
            }else{
                while($reg = $resultado->fetch()){
                    $this->comentarios[] = $reg;
                }

                return $this->comentarios;
            }
        }

        public function getComentariosById($idEntrada){
            $sql = "SELECT * FROM comentarios 
            INNER JOIN entradas ON entradas.id_entrada = comentarios.id_entrada_comentario
            WHERE id_entrada_comentario = ? ";

            $resultado = $this->db->prepare($sql);
            $resultado->bindValue(1, $idEntrada);

            if(!$resultado->execute()){
                header("Location:index.php?m=1");
            }else{
                while($reg = $resultado->fetch()){
                    $this->comentarios[] = $reg;
                }

                return $this->comentarios;
            }
        }

        public function insertarComentario($idEntrada, $autor, $email, $contenido){
            //Validamos que los campos no esten vacios
            if(empty($idEntrada) or 
               empty($autor) or 
               empty($email) or
               empty($contenido)){
                header("Location:entrada.php?id=$idEntrada&e=1");
                exit();
            }
            
            $sql = "INSERT INTO comentarios (id_entrada_comentario, comentario_autor, comentario_email, 
                                            comentario_contenido, comentario_status, comentario_fecha) 
                                            VALUES (?, ?, ?, ?, 'Desaprobado', now())";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $idEntrada);
            $resultado->bindValue(2, $autor);
            $resultado->bindValue(3, $email);
            $resultado->bindValue(4, $contenido);
            

            if(!$resultado->execute()){
                header("Location:entrada.php?id=$idEntrada&e=2");
            }else{
                //Insertamos el registro
                if($resultado->rowCount()>0){
                    $sql = "UPDATE entradas SET entrada_coment_count = entrada_coment_count+1 WHERE id_entrada = ?";
                    $resultado = $this->db->prepare($sql);
                    $resultado->bindValue(1, $idEntrada);
                    $resultado->execute();
                    header("Location:entrada.php?id=$idEntrada&e=3");
                }else{
                    header("Location:entrada.php?id=$idEntrada&e=4");
                }
            }
        }

        public function getComentarioByIdEntrada($idEntrada){
            $sql = "select * from comentarios where id_entrada_comentario = ?";

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

        public function cambiarStatus($id, $Status){
            $sql = "UPDATE comentarios SET comentario_status = ? WHERE id_comentario = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $Status);
            $resultado->bindValue(2, $id);

            if(!$resultado->execute()){
                header("Location: comentarios.php?m=1");
            }else{
                if($resultado->rowCount()>0){
                    header("Location: comentarios.php?m=3");
                }else{
                    header("Location: comentarios.php?m=2");
                }
            }
        }

        public function eliminarComentario($id){
            $sql = "SELECT * FROM comentarios WHERE id_comentario = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $id);

            if(!$resultado->execute()){
                header("Location: comentarios.php?m=1");
            }else{
                if($resultado->rowCount()>0){
                    $sql = "DELETE FROM comentarios WHERE id_comentario = ?; ALTER TABLE categorias AUTO_INCREMENT = 1;";
                    
                    $resultado = $this->db->prepare($sql);

                    $resultado->bindValue(1, $id);
                    if(!$resultado->execute()){
                        header("Location: comentarios.php?m=1");
                    }else{
                        if($resultado->rowCount()>0){
                            header("Location: comentarios.php?m=4");
                        }else{
                            header("Location: comentarios.php?m=2");
                        }
                    }
                }else{
                    header("Location: comentarios.php?m=2");
                }
            }
        }

    }
?>









