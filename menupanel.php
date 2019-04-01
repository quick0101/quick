        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="inicio.php"><i class="fa fa-home"></i> Inicio</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="registro.php"><i class="fa fa-database"></i> Registros de Items</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="clasificacion.php"><i class="fa fa-align-left"></i> Unidades de Medida</a>
                    </li>

                    <li class="<?php if(isset($active4)){echo $active4;}?>">
                        <a href="categoria.php"><i class="fa fa-align-left"></i> Categorias</a>
                    </li>

                    <li class="<?php if(isset($active9)){echo $active9;}?>">
                        <a href="pais.php"><i class="fa fa-globe"></i> Paises</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="depto.php"><i class="fa fa-globe"></i> Departamentos</a>
                    </li>

                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="reporte.php"><i class="fa fa-area-chart"></i> Reportes</a>
                    </li>

                    <li class="<?php if(isset($active6)){echo $active6;}?>">
                        <a href="usuarios.php"><i class="fa fa-users"></i> Usuarios</a>
                    </li>

                    <li class="<?php if(isset($active8)){echo $active8;}?>">
                        <a href="informacion.php"><i class="fa fa-child"></i> Quienes somos</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div> 
     
    <div class="top_nav">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/profiles/<?php echo $profile_pic;?>" alt=""><?php echo $name;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="usercuenta.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
                          
                            <li><a href="action/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>   