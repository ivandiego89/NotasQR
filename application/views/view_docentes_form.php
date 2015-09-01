<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Nuevo Docente
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Usuarios</a></li>
        <li><a href="#" class="active" >Nuevo Docente</a></li>
    </ol>
</section>
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($action)?>
                <div class="box-body">
	    <div class="form-group">
                <label for="">NOMBRE DOCENTE <?php echo form_error('NOMBRE_DOCENTE') ?></label>
                <input type="text" class="form-control" name="NOMBRE_DOCENTE" id="NOMBRE_DOCENTE" placeholder="NOMBRE_DOCENTE" value="<?php echo $NOMBRE_DOCENTE; ?>" />
            </div>
	    <div class="form-group">
                <label for="">APELLIDO PATERNO <?php echo form_error('AP_DOCENTE') ?></label>
                <input type="text" class="form-control" name="AP_DOCENTE" id="AP_DOCENTE" placeholder="AP_DOCENTE" value="<?php echo $AP_DOCENTE; ?>" />
            </div>
	    <div class="form-group">
                <label for="">APELLIDO MATERNO <?php echo form_error('AM_DOCENTE') ?></label>
                <input type="text" class="form-control" name="AM_DOCENTE" id="AM_DOCENTE" placeholder="AM_DOCENTE" value="<?php echo $AM_DOCENTE; ?>" />
            </div>
	    <div class="form-group">
                <label for="">DIRECCION <?php echo form_error('DIRECCION') ?></label>
                <input type="text" class="form-control" name="DIRECCION" id="DIRECCION" placeholder="DIRECCION" value="<?php echo $DIRECCION; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">TELEFONO <?php echo form_error('TELEFONO') ?></label>
                <input type="text" class="form-control" name="TELEFONO" id="TELEFONO" placeholder="TELEFONO" value="<?php echo $TELEFONO; ?>" />
            </div>
	    <div class="form-group">
                <label for="">SEXO <?php echo form_error('SEXO') ?></label>
                <input type="text" class="form-control" name="SEXO" id="SEXO" placeholder="SEXO" value="<?php echo $SEXO; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">DNI <?php echo form_error('DNI') ?></label>
                <input type="text" class="form-control" name="DNI" id="DNI" placeholder="DNI" value="<?php echo $DNI; ?>" />
            </div>
	    <div class="form-group">
                <label for="">EMAIL <?php echo form_error('EMAIL') ?></label>
                <input type="text" class="form-control" name="EMAIL" id="EMAIL" placeholder="EMAIL" value="<?php echo $EMAIL; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">FECHA DE INGRESO <?php echo form_error('FECHA_INGRESO') ?></label>
                <input type="text" class="form-control" name="FECHA_INGRESO" id="FECHA_INGRESO" placeholder="FECHA_INGRESO" value="<?php echo $FECHA_INGRESO; ?>" />
            </div>
	
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('docentes') ?>" class="btn btn-default">Cancel</a>
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