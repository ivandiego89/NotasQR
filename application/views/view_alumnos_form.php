<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Alumnos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alumnos</a></li>
        <li><a href="#" class="active" >Nuevo Alumno</a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($action)?>
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="CODIGO_ALUMNO">CODIGO ALUMNO <?php echo form_error('CODIGO_ALUMNO') ?></label>
                        <input type="text" class="form-control" rows="3" name="CODIGO_ALUMNO" id="CODIGO_ALUMNO" placeholder="CODIGO_ALUMNO" readonly value="<?php echo $CODIGO_ALUMNO; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="NOMBRE_ALUMNO">NOMBRE_ALUMNO <?php echo form_error('NOMBRE_ALUMNO') ?></label>
                                <input type="text" class="form-control" rows="3" name="NOMBRE_ALUMNO" id="NOMBRE_ALUMNO" placeholder="NOMBRE_ALUMNO" value="<?php echo $NOMBRE_ALUMNO; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="APELLIDO_PATERNO">APELLIDO_PATERNO <?php echo form_error('APELLIDO_PATERNO') ?></label>
                                <input type="text" class="form-control" rows="3" name="APELLIDO_PATERNO" id="APELLIDO_PATERNO" placeholder="APELLIDO_PATERNO" value="<?php echo $APELLIDO_PATERNO; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="APELLIDO_MATERNO">APELLIDO_MATERNO <?php echo form_error('APELLIDO_MATERNO') ?></label>
                                <input type="text" class="form-control" rows="3" name="APELLIDO_MATERNO" id="APELLIDO_MATERNO" placeholder="APELLIDO_MATERNO" value="<?php echo $APELLIDO_MATERNO; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="int">DNI <?php echo form_error('DNI') ?></label>
                                <input type="text" class="form-control" name="DNI" id="DNI" placeholder="DNI" maxlength="8" value="<?php echo $DNI; ?>" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="varchar">EMAIL <?php echo form_error('EMAIL') ?></label>
                                <input type="text" class="form-control" name="EMAIL" id="EMAIL" placeholder="EMAIL" value="<?php echo $EMAIL; ?>" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="varchar">TELEFONO <?php echo form_error('TELEFONO') ?></label>
                        <input type="text" class="form-control" name="TELEFONO" id="TELEFONO" placeholder="TELEFONO" value="<?php echo $TELEFONO; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">DIRECCION <?php echo form_error('DIRECCION') ?></label>
                        <input type="text" class="form-control" name="DIRECCION" id="DIRECCION" placeholder="DIRECCION" value="<?php echo $DIRECCION; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="bit">SEXO <?php echo form_error('SEXO') ?></label>
                        <?php echo form_dropdown('SEXO', array(''=>'-- SELECCIONE --','0'=>'Masculino','1'=>'Femenino') , $SEXO, 'class="form-control"');?>
                    </div>
                    <div class="form-group">
                        <label for="int">FECHA_NACIMIENTO <?php echo form_error('FECHA_NACIMIENTO') ?></label>
                        <input type="text" class="form-control" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" placeholder="FECHA_NACIMIENTO" value="<?php echo $FECHA_NACIMIENTO; ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="int">AÑO INGRESO <?php echo form_error('ANIO_INGRESO') ?></label>
                        <input type="text" class="form-control" name="ANIO_INGRESO" id="ANIO_INGRESO" placeholder="ANIO_INGRESO" value="<?php echo $ANIO_INGRESO; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">SEMESTRE_INGRESO <?php echo form_error('SEMESTRE_INGRESO') ?></label>
                        <input type="text" class="form-control" name="SEMESTRE_INGRESO" id="SEMESTRE_INGRESO" placeholder="SEMESTRE_INGRESO" value="<?php echo $SEMESTRE_INGRESO; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">CARRERA_PROFESIONAL <?php echo form_error('CARRERA_PROFESIONAL') ?></label>
                        <?php  $this->load->helper('common'); ?>
                        <?php echo form_dropdown('CARRERA_PROFESIONAL', get_model_dropdown($carreras,'CODIGO_CARRERA','NOMBRE_CARRERA') , $CARRERA_PROFESIONAL, 'class="form-control"');?>
                    </div>
                    <div class="form-group">
                        <label for="varchar">TURNO <?php echo form_error('TURNO') ?></label>
                        <?php echo form_dropdown('TURNO', array('M'=>'MAÑANA','T'=>'TARDE') , $TURNO, 'class="form-control"');?>
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('alumnos') ?>" class="btn btn-default">Cancel</a>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
</section>



<?php $this->load->view('template/footer'); ?>