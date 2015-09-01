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
                            <td><?php echo $alumno->CODIGO_ALUMNO; ?></td>                            
                            <td><?php echo $alumno->NOMBRE_COMPLETO; ?></td>
                            <td><?php echo $alumno->PRIMER_PARCIAL; ?></td>                            
                            <td><?php echo $alumno->SEGUNDA_PARCIAL; ?></td>
                            <td><?php echo $alumno->NOTA_FINAL == 0 ? 'NSP' : $alumno->NOTA_FINAL;  ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>

                    <h3>ESTADISTICAS</h3>
                <table>
                    <tr>
                    <th>Aprobados</th>
                    <th>Desaprovados</th>
                    </tr>
                    <tr>
                        <td><?php echo $ESTADISTICA->Aprobados; ?></td>
                        <td><?php echo $ESTADISTICA->Desaprovados; ?></td>
                    </tr>
                    <?php $total_alumnos = count($alumnos_asignatura); ?>
                    <tr>
                        <td><?php echo ($ESTADISTICA->Aprobados / $total_alumnos) * 100; ?>%</td>
                        <td><?php echo ($ESTADISTICA->Desaprovados / $total_alumnos) * 100; ?>%</td>
                    </tr>
                </table>

                <?php endif; ?>
                
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('notas/exportar') ?>" class="btn btn-sucess">Exportar</a>
                    <a href="<?php echo site_url('notas/ingresar') ?>" class="btn btn-default">Cancel</a>
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