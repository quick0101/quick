<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from r_solped where id_solped='".$id_del."'");
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"DELETE FROM r_solped WHERE id_solped='".$id_del."'")){
?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php 
            }else {
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
    <?php
            } //end else
        } //end if
    ?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('Descripcion');//Columnas de busqueda
         $sTable = "r_solped";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by Descripcion desc";
        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
  
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';

        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
     
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">ID </th>
                        <th class="column-title">Descripción </th>
                        <th class="column-title">Creación </th>
                        <th class="column-title">Cliente </th>
                        
                        <th class="column-title">Estado </th>
                        <th class="column-title">Pago </th>
                   
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                            $id=$r['id_solped'];
                           
                            $description=$r['Descripcion'];
                         
                            $created_at=date('d/m/Y', strtotime($r['Fecha_creacion']));
                            $project_id=$r['id_cliente'];
                            $priority_id=$r['id_FormaPedido'];
                            $status_id=$r['id_estado'];
                          

                            $sql = mysqli_query($con, "select * from r_cliente where id_cliente=$project_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_project=$c['id_user'];
                            }

                            $sql = mysqli_query($con, "select * from r_user where id=$name_project");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_project=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from r_estados where id=$status_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_status=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from r_formapedido where id_FormaPedido=$priority_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_priority=$c['Nombre'];
                            }

                          


                ?>
                <!--      <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                  
                    <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">

                   me obtiene los datos
                    <input type="hidden" value="<?php echo $kind_id;?>" id="kind_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $priority_id;?>" id="priority_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id;?>">

 -->
                    <tr class="even pointer">
                        <td><?php echo $id;?></td>
                        <td><?php echo $description;?></td>
                        <td><?php echo $created_at;?></td>
                        <td><?php echo $name_project; ?></td>           
                        <td><?php echo $name_status;?></td>
                         <td><?php echo $name_priority; ?></td>


                        <td ><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=6><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>