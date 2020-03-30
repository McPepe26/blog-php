<?php

    class Usuarios extends Conectar{
        //Atributos
        private $db;
        private $usuarios;
        private $usuarioById;
        public $imagen;

        //Metodos
        public function __construct(){
            $this->db = Conectar::conexion();
            $this->usuarios = array();
            $this->usuarioById = array();
        }
        
        public function getUsuarios(){
            $sql = "SELECT * FROM usuarios";

            $resultado = $this->db->prepare($sql);

            if(!$resultado->execute()){
                header("Location:index.php?m=1");
            }else{
                while($reg = $resultado->fetch()){
                    $this->usuarios[] = $reg;
                }

                return $this->usuarios;
            }
        }

        public function insertarUsuario($usuario, $contrasenia, $nombre, $apellido, 
                                    $correo, $imagen, $rol){
            //Validamos que los campos no esten vacios
            if(empty($usuario) or 
               empty($contrasenia) or 
               empty($nombre) or 
               empty($apellido) or 
               empty($correo) or
               empty($imagen) or 
               empty($rol)){
                header("Location:usuarios.php?accion=add_usuario&i=1");
                exit();
            }
            
            $sql = "INSERT INTO usuarios VALUES(null, ?, ?, ?, ?, ?, ?, ?)";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $usuario);
            $resultado->bindValue(2, $contrasenia);
            $resultado->bindValue(3, $nombre);
            $resultado->bindValue(4, $apellido);
            $resultado->bindValue(5, $correo);
            $resultado->bindValue(6, $imagen);
            $resultado->bindValue(7, $rol);
            

            if(!$resultado->execute()){
                header("Location:usuarios.php?accion=add_usuario&i=2");
            }else{
                //Insertamos el registro
                if($resultado->rowCount()>0){
                    header("Location:usuarios.php?accion=add_usuario&i=3");
                }else{
                    header("Location:usuarios.php?accion=add_usuario&i=4");
                }
            }
        }

        public function getUsuarioById($idUsuario){
            $sql = "select * from usuarios where id_usuario = ?";

            $resultado = $this->db->prepare($sql);
            $resultado->bindValue(1, $idUsuario);

            if(!$resultado->execute()){
                header("Location:entradas.php?m=1");
            }else{
                //Existe el resgistro de la entrada
                if($resultado->rowCount()>0){
                    while($reg = $resultado->fetch()){
                        $this->usuarioById[] = $reg;
                    }
                    return $this->usuarioById;
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

        public function editarUsuario($usuario, $contrasenia, $nombre, $apellido, 
                                    $correo, $imagen, $rol, $id){
            //Validamos que los campos no esten vacios
            if(empty($usuario) or 
               empty($contrasenia) or 
               empty($nombre) or 
               empty($apellido) or 
               empty($correo) or
               empty($imagen) or 
               empty($rol)){
                header("Location:usuarios.php?accion=add_usuario&i=1");
                exit();
            }
            
            $sql = "UPDATE usuarios SET usuario = ?, contrasenia = ?, nombre = ?, apellido = ?,
                                        correo = ?, imagen = ?, rol = ? WHERE id_usuario = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $usuario);
            $resultado->bindValue(2, $contrasenia);
            $resultado->bindValue(3, $nombre);
            $resultado->bindValue(4, $apellido);
            $resultado->bindValue(5, $correo);
            $resultado->bindValue(6, $imagen);
            $resultado->bindValue(7, $rol);
            $resultado->bindValue(8, $id);
            

            if(!$resultado->execute()){
                header("Location:usuarios.php?accion=edit_usuario&i=2&id=$id");
            }else{
                //Insertamos el registro
                if($resultado->rowCount()>0){
                    header("Location:usuarios.php?accion=edit_usuario&i=3&id=$id");
                }else{
                    header("Location:usuarios.php?accion=edit_usuario&i=4&id=$id");
                }
            }
        }

        public function eliminarUsuario($idUsuario){
            $sql = "SELECT * from usuarios where id_usuario = ?";

            $resultado = $this->db->prepare($sql);

            $resultado->bindValue(1, $idUsuario);

            if(!$resultado->execute()){
                header("Location:usuarios.php?m=1");
            }else{
                if($resultado->rowCount()>0){
                    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
                    
                    $resultado = $this->db->prepare($sql);

                    $resultado->bindValue(1, $idUsuario);
                    if(!$resultado->execute()){
                        header("Location: usuarios.php?m=1");
                    }else{
                        if($resultado->rowCount()>0){
                            header("Location: usuarios.php?m=3");
                        }else{
                            header("Location: usuarios.php?m=2");
                        }
                    }
                }else{
                    header("Location: usuarios.php?m=2");
                }
            }
        }

    }
?>