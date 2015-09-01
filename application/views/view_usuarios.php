<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Catalogo de Usuarios
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Usuarios</li>
	</ol>
</section>
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		
		<?php
		if(isset($_GET['save'])){
		echo '<div class="alert alert-success text-center">La Información  se Almaceno Correctamente</div>';
		}
		if(isset($_GET['delete'])){
		echo '<div class="alert alert-warning text-center">La Información  se ha Eliminado Correctamente</div>';
		}
		if(isset($_GET['update'])){
		echo '<div class="alert alert-success text-center">La Información  se Actualizo Correctamente</div>';
		}
		if(isset($_GET['permisos'])){
			echo '<div class="alert alert-success text-center">Los Permisos fueron Asignados Correctamente</div>';
		}
		if(isset($_GET['password'])){
			echo '<div class="alert alert-success text-center">La Contraseña fue actualizado Correctamente</div>';
		}
		?>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Usuarios Registrados</h3>
					<div class="box-tools">
						<div style="width: 150px;" class="input-group">
							<input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
							<div class="input-group-btn">
								<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>ACCION</th>
								<th>NOMBRE</th>
								<th>APELLIDOS</th>
								<th>EMAIL</th>
								<th>FECHA REGISTRO</th>
								<th>TIPO</th>
								<th>ESTATUS</th>
							</tr>
							</thead>
							<tbody>
								<?php
								$contador = 0;
								if(!empty($usuarios)){
									foreach($usuarios as $usuario){
										echo '<tr>';
													echo '<td>'
										?>
										<a href="<?php echo base_url();?>index.php/usuarios/editar/<?php echo $usuario->ID;?>/" class="btn btn-success">Editar</a>
										<a href="<?php echo base_url();?>index.php/usuarios/password/<?php echo $usuario->ID ?>" class="btn btn-default">Password</a>
										<a href="<?php echo base_url();?>index.php/usuarios/permisos/<?php echo $usuario->ID;?>" class="btn btn-info">Permisos</a>
										<a href="<?php echo base_url();?>index.php/usuarios/eliminar/<?php echo $usuario->ID ?>" class="btn btn-danger">Eliminar</a>
										<?php
									echo '</td>';
									echo '<td>'.$usuario->NOMBRE.'</td>';
									echo '<td>'.$usuario->APELLIDOS.'</td>';
									echo '<td>'.$usuario->EMAIL.'</td>';
									echo '<td>'.$usuario->FECHA_REGISTRO.'</td>';
									echo '<td>'.$usuario->TIPO.'</td>';
									
									/*Si es estatus mostramos en texto*/
									if($usuario->TIPO==0){
									echo '<td>Activo</td>';
									}
									if($usuario->TIPO==1){
									echo '<td>Inactivo</td>';
									}
									
									
								echo '</tr>';
								}
								}
								?>
							</tbody>
						</table>
						</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					
				
				</div>
			</section>
			<?php
			$this->load->view('template/footer');
			?>