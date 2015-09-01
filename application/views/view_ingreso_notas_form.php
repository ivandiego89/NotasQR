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
                   
                </div>
                <div class="box-body">
                
                    <div class="form-group">
                        <label for="ASIGNATURA">SELECCIONA ASIGNATURA</label>
                        <?php echo form_dropdown('ASIGNATURA', get_model_dropdown($cursos_asignados,'CODIGO_ASIGNATURA','NOMBRE_ASIGNATURA') , $ASIGNATURA, 'class="form-control" onchange="this.form.submit()"');?>                        
                    </div>
                <?php if(isset($alumnos_asignatura)): ?>
                   
                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRES Y APELLIDOS</th>                        
                            <th>NOTA 1</th>
                            <th>NOTA 2</th>
                            <th>PROMEDIO</th>
                        </tr><?php 
                        foreach ($alumnos_asignatura as $alumno)
                        {
                        ?>
                        <tr>
                            <td>
                               <?php echo $alumno->CODIGO_ALUMNO; ?>
                            </td>                            
                            <td><?php echo $alumno->NOMBRE_COMPLETO; ?></td>
                            <td><input type="text" name="notas[<?php echo $alumno->CODIGO_ALUMNO; ?>][1]" class="nota" value="<?php echo $alumno->PRIMER_PARCIAL; ?>"></td>                            
                            <td><input type="text" name="notas[<?php echo $alumno->CODIGO_ALUMNO; ?>][2]" class="nota" value="<?php echo $alumno->SEGUNDA_PARCIAL; ?>"></td>
                            <td><input type="text" name="notas[<?php echo $alumno->CODIGO_ALUMNO; ?>][final]" value="<?php echo $alumno->NOTA_FINAL ?>" data-alumno="<?php echo $alumno->CODIGO_ALUMNO; ?>" readonly ></td>
                            
                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php endif; ?>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="BUTTON_SAVE" value="1" >Guardar</button>
                    <a href="<?php echo site_url('docentes/ingresar_notas') ?>" class="btn btn-default">Cancel</a>
                </div>
          
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
    $('')
</script>
<?php
$this->load->view('template/footer');
?>