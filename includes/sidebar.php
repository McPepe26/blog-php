

<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                 
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="buscar.php" method="post">
                    <div class="input-group">
                        <input name="buscar" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
                
                <!--Login -->
                <div class="well">
                    <h4>Login</h4>

                    <form method="post">
                        <div class="form-group">
                             <input name="usuario" type="text" class="form-control" placeholder="Escriba el usuario">
                        </div>

                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Enviar
                            </button>
                            </span>
                        </div>

                        <div class="form-group">

                            <a href="#">Olvidó su password</a>


                        </div>

                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php
                                $conectar = Conectar::conexion();
                                
                                $sql = "select * from categorias";

                                $resultado = $conectar->prepare($sql);

                                if(!$resultado->execute()){
                                    die("Fallo la consulta");
                                }else{
                                    while($reg = $resultado -> fetch()){
                                        $catTitulo = $reg["titulo"];
                                        echo "<li><a href = '#'>$catTitulo</a></li>";
                                    }
                                }
                            ?>
                            <!--<li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>-->
                             
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
                
                <!-- Side Widget Well -->
                <?php require_once "widget.php"; ?>

            </div>
            