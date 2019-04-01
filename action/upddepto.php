<?php
	session_start();
	if (empty($_POST['mod_id_depto'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_nombre'])){
			$errors[] = "Nombre vacío";
		}  else if (
			!empty($_POST['mod_id_pais']) &&
			!empty($_POST['mod_id_depto'])
		){

		include "../config/config.php";



		$nombre = $_POST["mod_nombre"];		
		$id_pais = $_POST["mod_id_pais"];		
		$id=$_POST['mod_id_depto'];
		

		$sql = "update r_deptos set nombre=\"$nombre\",id_pais=\"$id_pais\" where id_depto=$id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>