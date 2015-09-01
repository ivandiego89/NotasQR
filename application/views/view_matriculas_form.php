<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Registrar Matricula
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Matriculas</a></li>
        <li><a href="#" class="active" >Registrar Matricula</a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo form_open($action)?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="int">FECHA_MATRICULA <?php echo form_error('FECHA_MATRICULA') ?></label>
                        <input type="text" class="form-control" name="FECHA_MATRICULA" id="FECHA_MATRICULA" placeholder="D/M/YYYY" value="<?php echo $FECHA_MATRICULA ?: date('m/d/Y') ; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">CODIGO_ALUMNO <?php echo form_error('CODIGO_ALUMNO') ?></label>
                        <input type="text" class="form-control" name="CODIGO_ALUMNO" id="CODIGO_ALUMNO" placeholder="CODIGO_ALUMNO" value="<?php echo $CODIGO_ALUMNO; ?>" />
                    </div>
                    <?php if(isset($alumno)): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">NOMBRE_ALUMNO</label>
                                <input type="text" class="form-control" name="NOMBRE_ALUMNO" id="NOMBRE_ALUMNO" placeholder="NOMBRE_ALUMNO" value="<?php echo $alumno->NOMBRE_ALUMNO; ?>" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">APELLIDO_PATERNO</label>
                                <input type="text" class="form-control" name="APELLIDO_PATERNO" id="APELLIDO_PATERNO" placeholder="APELLIDO_PATERNO" value="<?php echo $alumno->APELLIDO_PATERNO; ?>" readonly />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="varchar">APELLIDO_MATERNO</label>
                                <input type="text" class="form-control" name="APELLIDO_MATERNO" id="APELLIDO_MATERNO" placeholder="APELLIDO_MATERNO" value="<?php echo $alumno->APELLIDO_MATERNO; ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="int">CARRERA PROFESIONAL</label>
                        <input type="text" class="form-control" id="CODIGO_CARRERA" placeholder="CODIGO_CARRERA" value="<?php echo $carrera_profesional->NOMBRE_CARRERA; ?>" readonly />
                        <input type="hidden" name="CODIGO_CARRERA" value="<?php echo $carrera_profesional->CODIGO_CARRERA; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">SEMESTRE</label>
                        <?php  $this->load->helper('common'); ?>
                        <?php echo form_dropdown('SEMESTRE', get_year_semester(), $SEMESTRE, 'class="form-control"');?>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Seleccionar Cursos </h3><?php echo form_error('_asignaturas[]') ?>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="int">SEMESTRE</label>
                                        <?php  $this->load->helper('common'); ?>
                                        <?php echo form_dropdown('ASIGNATURA_SEMESTRE', get_semestres_dropdown($carrera_profesional), $ASIGNATURA_SEMESTRE, 'class="form-control" onchange="this.form.submit()"');?>
                                        
                                    </div>
                                    
                                    <div>
                                        <?php if(isset($asignaturas)): ?>
                                        <table class="table table-bordered" style="margin-bottom: 10px">
                                            <tr>
                                                <th></th>
                                                <th>CODIGO</th>
                                                <th>NOMBRE_ASIGNATURA</th>
                                                <th>CREDITOS</th>
                                            </tr><?php
                                            foreach ($asignaturas as $asignatura)
                                            {
                                            ?>
                                            <tr>
                                                <td><?php echo  form_checkbox('_asignaturas[]', $asignatura->CODIGO_ASIGNATURA, in_array($asignatura->CODIGO_ASIGNATURA, array_column($cursos_matriculados, 'CODIGO_ASIGNATURA'))); ?></td>
                                                <td><?php echo $asignatura->CODIGO_ASIGNATURA ?></td>
                                                <td><?php echo $asignatura->NOMBRE_ASIGNATURA ?></td>
                                                <td><?php echo $asignatura->CREDITOS ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    <?php  endif; ?>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-md-5">
                            
                        </div>
                    </div>
                    <?php endif; ?>
                    <input type="hidden" name="CODIGO_MATRICULA" value="<?php echo $CODIGO_MATRICULA; ?>" />
                    <button type="submit" class="btn btn-primary" name="ACTION" value="GUARDAR"><?php echo $button ?></button>
                    <a href="<?php echo site_url('matriculas') ?>" class="btn btn-default">Cancel</a>
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