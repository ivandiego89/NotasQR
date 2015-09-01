<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Nueva Carrera
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Carreras</a></li>
        <li><a href="#" class="active" >Nueva Carrera</a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($action)?>
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="varchar">NOMBRE_CARRERA <?php echo form_error('NOMBRE_CARRERA') ?></label>
                        <input type="text" class="form-control" name="NOMBRE_CARRERA" id="NOMBRE_CARRERA" placeholder="NOMBRE_CARRERA" value="<?php echo $NOMBRE_CARRERA; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">FACULTAD <?php echo form_error('FACULTAD') ?></label>
                        <?php  $this->load->helper('common'); ?>
                        <?php echo form_dropdown('FACULTAD', get_model_dropdown($facultades,'CODIGO_FACULTAD','NOMBRE_FACULTAD') , $FACULTAD, 'class="form-control"');?>              
                       
                    </div>
                   
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('carreras') ?>" class="btn btn-default">Cancel</a>
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