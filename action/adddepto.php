<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) 
	{
           $errors[] = "Nombre vacío";
	} else if (
			!empty($_POST['nombre'])
		
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$nombre = $_POST["nombre"];
	
		$id_pais = $_POST["id_pais"];
		
		$user_id = $_SESSION["user_id"];
		$created_at="NOW()";

		// $user_id=$_SESSION['user_id'];

		$sql="insert into r_deptos (nombre, id_pais) value (\"$nombre\",\"$id_pais\")";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu registro ha sido ingresado satisfactoriamente.";
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