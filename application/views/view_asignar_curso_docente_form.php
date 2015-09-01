<?php
$this->load->view('template/header');
$this->load->helper('common');
?>
<section class="content-header">
    <h1>Asignación Cursos</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Asignar Cursos</a></li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php echo $this->session->flashdata('msg');?>
            <div class="box">
                <?php echo form_open()?>
                <div class="box-header">
                    <h4>Docente: <?php echo $docente['FULLNAME']?></h4>
                    <input type="hidden" name="CODIGO_DOCENTE" value="<?php echo $docente['CODIGO_DOCENTE']?>">
                </div>
                <div class="box-body">
                     

                    <div class="form-group">
                        <label for="CODIGO_FACULTAD">FACULTAD <?php echo form_error('CODIGO_FACULTAD')?></label>
                       
                        <?php echo form_dropdown('CODIGO_FACULTAD', get_model_dropdown($facultades, 'CODIGO_FACULTAD', 'NOMBRE_FACULTAD'), $CODIGO_FACULTAD, 'class="form-control" onchange="this.form.submit()"');?>
                    </div>

                    <?php if ($CODIGO_FACULTAD): ?>
                    
                    <div class="form-group">
                        <label for="CODIGO_CARRERA">CARRERA <?php echo form_error('CODIGO_CARRERA')?></label>
                        <?php echo form_dropdown('CODIGO_CARRERA', get_model_dropdown($carreras, 'CODIGO_CARRERA', 'NOMBRE_CARRERA'), $CODIGO_CARRERA, 'class="form-control" onchange="this.form.submit()"');?>
                    </div>
                    <?php endif;?>

                    <?php if ($CODIGO_CARRERA): ?>
                    <div class="form-group">
                        <label for="SEMESTRE">SEMESTRE <?php echo form_error('SEMESTRE')?></label>

                        <?php echo form_dropdown('SEMESTRE', get_year_semester(), $SEMESTRE, 'class="form-control" onchange="this.form.submit()"');?>
                    </div>
                    
                     <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th ></th>
                            <th>NOMBRE_ASIGNATURA</th>
                            <th>CATEGORIA</th>
                            <th>HORAS</th>
                            <th>CREDITOS</th>
                            
                        </tr><?php 
                        foreach ($asignaturas as $asignatura)
                        {
                           
                        ?>
                        <tr>
                            <td><?php echo  form_checkbox('_asignaturas[]', $asignatura->CODIGO_ASIGNATURA, in_array($asignatura->CODIGO_ASIGNATURA, array_column($cursos_asignados, 'CODIGO_ASIGNATURA'))); ?></td>
                            <td><?php echo $asignatura->NOMBRE_ASIGNATURA ?></td>
                            <td><?php echo $asignatura->CATEGORIA ?></td>
                            <td><?php echo $asignatura->HORAS ?></td>
                            <td><?php echo $asignatura->CREDITOS ?></td>                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table> 
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="BUTTON_SAVE" value="1" >Asignar Cursos</button>
                        <a href="<?php echo site_url('docentes') ?>" class="btn btn-default">Cancel</a>
                    </div>   
                    <?php endif; ?>

                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('template/footer');
?>