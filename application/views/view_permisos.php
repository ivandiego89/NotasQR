<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Asignar Permisos</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Usuarios</a></li>
		<li><a href="#" class="active" >Cambiar password</a></li>
	</ol>
</section>
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			<?php echo $this->session->flashdata('msg');?>
			<div class="box">

				<?php echo form_open()?>
				<div class="box-body">
				<div class="form-group">
						<strong>Usuario: </strong>
					</div>

					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>ESTATUS</th>
								<th>MENU</th>
								<th>PERMISO</th>
							</tr>
							</thead>
							<tbody>
								<?php
									for ($i = 0; $i <= count($estatus_menu) - 1; $i++) {
									    $body = "#bcd9e1";
									    $booleano = false;
									    $CheckText = "<font color='red'>Permiso No Asignado</font>";
									    if ($i % 2) {$body = "#ffffff";}
									    if ($estatus_menu[$i] == "1") {
									        $booleano = true;
									        $CheckText = "<font color='green'>Permiso Asignado</font>";
									    }
									    echo '<tr bgcolor="' . $body . '">';
									    echo '<td>' . form_checkbox("permissions[]", $id_menu[$i], $booleano) . ' ' . $CheckText . '</td>';
									    echo '<td>' . $descripcion_menu[$i] . '</td>';
									    echo '<td>' . $id_menu[$i] . form_hidden("ID", $ID_USUARIO) . '</td>';
									    echo '</tr>';
									}
								?>
							</tbody>
						</table>

						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">ASIGNAR PERMISOS</button>
					<a href="<?php echo site_url('usuarios')?>" class="btn btn-default">Cancel</a>

						</div>
</div>
<?php echo form_close();?>
</div><!-- /.box -->
			</div>
		</div>

</section>
