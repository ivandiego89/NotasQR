<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Nuevo Usuario
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Usuarios</a></li>
		<li><a href="#" class="active" >Nuevo Usuario</a></li>
	</ol>
</section>
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<?php echo form_open()?>
				<div class="box-body">
					<div class="form-group">
						<label for="NOMBRE">NOMBRE<?php echo form_error('NOMBRE')?></label>
						<input type="text" class="form-control" rows="3" name="NOMBRE" id="NOMBRE" placeholder="NOMBRE" value="<?php echo $NOMBRE; ?>">
					</div>
					<div class="form-group">
						<label for="APELLIDOS">APELLIDOS <?php echo form_error('APELLIDOS')?></label>
						<input type="text" class="form-control" rows="3" name="APELLIDOS" id="APELLIDOS" placeholder="APELLIDOS" value="<?php echo $APELLIDOS; ?>">
					</div>
					<div class="form-group">
						<label for="EMAIL">EMAIL <?php echo form_error('EMAIL')?></label>
						<input type="text" class="form-control" rows="3" name="EMAIL" id="EMAIL" placeholder="EMAIL" value="<?php echo $EMAIL; ?>">
					</div>

					<div class="form-group">
						<label for="varchar">TIPO <?php echo form_error('TIPO')?></label>
						<?php echo form_dropdown('ESTATUS', array('0' => '---SELECCIONE TIPO DE USUARIO---', 'Administrador' => 'Administrador', 'Invitado' => 'Invitado'), $TIPO, 'class="form-control"');?>
					</div>

					<div class="form-group">
						<label for="varchar">ESTATUS <?php echo form_error('ESTATUS')?></label>
						<?php echo form_dropdown('ESTATUS', array('NONE' => '---SELECCIONE ESTATUS---', '0' => 'Activo', '1' => 'Inactivo'), $ESTATUS, 'class="form-control"');?>
					</div>


					<button type="submit" class="btn btn-primary"><?php echo $button?></button>
					<a href="<?php echo site_url('usuarios')?>" class="btn btn-default">Cancel</a>
					<?php echo form_close();?>

				</div>
				<?php echo form_close();?>
				</div><!-- /.box -->
			</div>
		</div>


	</div>
</section>
<?php
$this->load->view('template/footer');
?>