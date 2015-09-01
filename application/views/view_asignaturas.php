<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Asignaturas</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Asignaturas</a></li>
        
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
                    <?php echo anchor(site_url('asignaturas/nuevo'),'Nuevo', 'class="btn btn-primary"'); ?>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th width="180">Accion</th>
                            <th>NOMBRE_ASIGNATURA</th>
                            <th>CATEGORIA</th>
                            <th>HORAS</th>
                            <th>CREDITOS</th>
                            
                        </tr><?php
                        foreach ($asignaturas_data as $asignaturas)
                        {
                        ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo anchor(site_url('asignaturas/editar/'.$asignaturas->CODIGO_ASIGNATURA),'Editar','class="btn btn-success"'); ?>
                                <?php echo anchor(site_url('asignaturas/eliminar/'.$asignaturas->CODIGO_ASIGNATURA),'Eliminar','class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>                                
                            </td>
                            
                            <td><?php echo $asignaturas->NOMBRE_ASIGNATURA ?></td>
                            <td><?php echo $asignaturas->CATEGORIA ?></td>
                            <td><?php echo $asignaturas->HORAS ?></td>
                            <td><?php echo $asignaturas->CREDITOS ?></td>
                            
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                            <?php echo anchor(site_url('Asignaturas/excel'), 'Excel', 'class="btn btn-primary"'); ?>
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
   