<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Docentes</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Docentes</a></li>
        
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
                    <?php echo anchor(site_url('docentes/nuevo'),'Nuevo', 'class="btn btn-primary"'); ?>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th width="350">ACCION</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>DNI</th>
                            <th>EMAIL</th>
                            
                        </tr><?php
                        foreach ($docentes_data as $docentes)
                        {
                        ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo anchor(site_url('docentes/ficha/'.$docentes->CODIGO_DOCENTE),'Ver Ficha','class="btn btn-info"');  ?>
                                <?php echo anchor(site_url('docentes/editar/'.$docentes->CODIGO_DOCENTE),'Editar','class="btn btn-success"'); ?>
                                <?php echo anchor(site_url('docentes/asignar_cursos/'.$docentes->CODIGO_DOCENTE),'Asignar Cursos','class="btn btn-default"'); ?>
                                <?php echo anchor(site_url('docentes/eliminar/'.$docentes->CODIGO_DOCENTE),'Elimina','class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                            </td>
                            
                            <td><?php echo $docentes->NOMBRE_DOCENTE ?></td>
                            <td><?php echo $docentes->AP_DOCENTE . " " . $docentes->AM_DOCENTE?></td>
                            
                            <td><?php echo $docentes->DNI ?></td>
                            <td><?php echo $docentes->EMAIL ?></td>
                            
                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                            <?php echo anchor(site_url('docentes/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <?php
    $this->load->view('template/footer');
    ?>