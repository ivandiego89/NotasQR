<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Nueva Asignatura
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Asignaturas</a></li>
        <li><a href="#" class="active" >Nueva Asignatura</a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($action)?>
                <div class="box-body">
                    
         
                        <div class="form-group">
                            <label for="varchar">CODIGO_ASIGNATURA <?php echo form_error('CODIGO_ASIGNATURA') ?></label>
                            <input type="text" class="form-control" name="CODIGO_ASIGNATURA" id="CODIGO_ASIGNATURA" placeholder="CODIGO_ASIGNATURA" value="<?php echo $CODIGO_ASIGNATURA; ?>" />
                        </div>                        
                        <div class="form-group">
                            <label for="varchar">NOMBRE_ASIGNATURA <?php echo form_error('NOMBRE_ASIGNATURA') ?></label>
                            <input type="text" class="form-control" name="NOMBRE_ASIGNATURA" id="NOMBRE_ASIGNATURA" placeholder="NOMBRE_ASIGNATURA" value="<?php echo $NOMBRE_ASIGNATURA; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">CARRERA PROFESIONAL <?php echo form_error('CODIGO_CARRERA') ?></label>
                            <?php  $this->load->helper('common'); ?>
                            <?php echo form_dropdown('CODIGO_CARRERA', get_model_dropdown($carreras,'CODIGO_CARRERA','NOMBRE_CARRERA') , $CODIGO_CARRERA, 'class="form-control"');?>
               
                        </div>
                        <div class="form-group">
                            <label for="varchar">CATEGORIA <?php echo form_error('CATEGORIA') ?></label>                           
                            <input type="text" class="form-control" name="CATEGORIA" id="CATEGORIA" placeholder="CATEGORIA" value="<?php echo $CATEGORIA; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">HORAS <?php echo form_error('HORAS') ?></label>
                            <input type="text" class="form-control" name="HORAS" id="HORAS" placeholder="HORAS" value="<?php echo $HORAS; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">CREDITOS <?php echo form_error('CREDITOS') ?></label>
                            <input type="text" class="form-control" name="CREDITOS" id="CREDITOS" placeholder="CREDITOS" value="<?php echo $CREDITOS; ?>" />
                        </div>
                        
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                        <a href="<?php echo site_url('asignaturas') ?>" class="btn btn-default">Cancel</a>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('template/footer');
?>