<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Cambiar password</h1>
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
			<?php echo $this->session->flashdata('msg');  ?>
			<div class="box">
				<?php echo form_open()?>
				<div class="box-body">
					<div class="form-group">
						<label for="PASSWORD">PASSWORD<?php echo form_error('PASSWORD')?></label>
						<input type="text" class="form-control" rows="3" name="PASSWORD" id="PASSWORD" placeholder="PASSWORD" value="<?php echo $PASSWORD; ?>">
					</div>
					<div class="form-group">
						<label for="PASSWORD1">CONFIRMAR PASSWORD <?php echo form_error('PASSWORD1')?></label>
						<input type="text" class="form-control" rows="3" name="PASSWORD1" id="PASSWORD1" placeholder="PASSWORD1" value="<?php echo $PASSWORD1; ?>">
					</div>
					


					<button type="submit" class="btn btn-primary"><?php echo $button?></button>
					<a href="<?php echo site_url('usuarios')?>" class="btn btn-default">Cancel</a>
					

				</div>
				<?php echo form_close();?>
				</div><!-- /.box -->
			</div>
		</div>

</section>
<?php
$this->load->view('template/footer');
?>