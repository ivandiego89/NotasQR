<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Alumno</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alumno</a></li>
        
    </ol>
</section>
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-xs-12">
            <?php echo $this->session->flashdata('msg');  ?>
            <div class="box">
                <?php echo form_open()?>
                <div class="box-header">
                    <?php echo anchor(site_url('alumno/nuevo'),'Nuevo', 'class="btn btn-primary"'); ?>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th width="320">Accion</th>
                            <th>CODIGO ALUMNO</th>
                            <th>NOMBRE ALUMNO</th>
                            <th>INGRESO</th>
                            <th>CARRERA PROFESIONAL</th>
                            
                            
                        </tr><?php
                        foreach ($alumnos_data as $alumno)
                        { 
                        ?>
                        <tr>
                            <td style="text-align:center">
                                
                                <?php echo anchor(site_url('alumnos/editar/'.$alumno->CODIGO_ALUMNO),'Editar','class="btn btn-success"');?>
                                <?php echo anchor(site_url('alumnos/notas/'.$alumno->CODIGO_ALUMNO),'Notas','class="btn btn-default"'); ?>
                                <?php echo anchor(site_url('alumnos/eliminar/'.$alumno->CODIGO_ALUMNO),'Eliminar','class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');?>                                
                            </td>
                            <td><?php echo $alumno->CODIGO_ALUMNO ?></td>
                            <td><?php echo $alumno->NOMBRE_ALUMNO . " " . $alumno->APELLIDO_PATERNO . " " . $alumno->APELLIDO_MATERNO ?></td>                            
                            <td><?php echo $alumno->SEMESTRE_INGRESO ?></td>
                            <td><?php echo $alumno->CARRERA_PROFESIONAL ?></td>
                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('template/footer');
?>