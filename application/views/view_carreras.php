<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Carreras</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Carreras</a></li>
        
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
                    <?php echo anchor(site_url('carreras/nuevo'),'Nueva Carrera', 'class="btn btn-primary"'); ?>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th width="200">Accion</th>
                            <th>NOMBRE_CARRERA</th>
                            <th>FACULTAD</th>
                            
                        </tr><?php
                        foreach ($carreras_data as $carreras)
                        {
                        ?>
                        <tr>
                            <td style="text-align:center">
                                <?php echo anchor(site_url('carreras/editar/'.$carreras->CODIGO_CARRERA),'Editar','class="btn btn-success"'); ?>
                                <?php echo anchor(site_url('carreras/eliminar/'.$carreras->CODIGO_CARRERA),'Eliminar','class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                            </td>
                            <td><?php echo $carreras->NOMBRE_CARRERA ?></td>
                            <td><?php echo $carreras->FACULTAD ?></td>
                            
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