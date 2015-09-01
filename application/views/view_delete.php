<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Eliminar Usuario</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Usuarios</a></li>
		<li><a href="#" class="active" >Eliminar usuario</a></li>
	</ol>
</section>
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			
			<div class="box">
				<?php echo form_open()?>
				<div class="box-body">
					<div class="callout callout-danger">
		              <h4>Esta Seguro de Eliminar el Registro</h4>
		              <p>No podrá recuperar la información que va a eliminar.</p>
		            </div>
		            <?php echo form_hidden('ID',$ID) ?>
					<button type="submit" class="btn btn-primary"><?php echo $button?></button>
					<a href="<?php echo site_url('usuarios')?>" class="btn btn-default">Cancel</a>
					<?php echo form_close();?>

				</div>
				<?php echo form_close();?>
				</div><!-- /.box -->
			</div>
		</div>




