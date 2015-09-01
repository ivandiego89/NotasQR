<?php
$this->load->view('template/header');

$total_ponderado = 0;
$total_creditos = 0;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    SERVICIOS ACADEMICOS
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Notas</a></li>
        <li><a href="#" class="active" >Constancia</a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header" style="text-align:center;">
                     <h3>CONSTANCIA DE NOTAS</h3>           
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <p><strong>Nombres:</strong> <?php echo $alumno->NOMBRE_ALUMNO; ?></p>
                            <p><strong>Apellido Paterno:</strong> <?php echo $alumno->APELLIDO_PATERNO; ?></p>
                            <p><strong>Apellido Materno:</strong> <?php echo $alumno->APELLIDO_MATERNO; ?></p>
                            <p><strong>Carrera profesional:</strong> <?php echo $alumno->NOMBRE_CARRERA; ?></p>
                            <p><strong>Semestre:</strong> <?php echo $SEMESTRE; ?></p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo site_url('notas/generaqr/'.$token->TOKEN); ?>">
                        </div>
                    </div>

                    <table class="table table-bordered" style="margin-bottom: 10px">
                        <tr>
                            <th>CODIGO</th>
                            <th>ASIGNATURA</th>
                            <th>CREDITOS</th>
                            <th>PROMEDIO</th>                           
                            
                        </tr><?php
                        foreach ($asignatura_notas as $asignatura)
                        { 
                        ?>
                        <tr>
                            <td><?php echo $asignatura->CODIGO_ASIGNATURA; ?></td>
                            <td><?php echo $asignatura->NOMBRE_ASIGNATURA ?></td>
                            <td><?php echo $asignatura->CREDITOS;?></td>                            
                            <td><?php echo $asignatura->NOTA_FINAL == 0 ? 'NSP' : $asignatura->NOTA_FINAL; ?></td>
                            <?php 
                                $total_creditos += $asignatura->CREDITOS;
                                $total_ponderado += $asignatura->NOTA_FINAL * $asignatura->CREDITOS;  
                            ?>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>

                    <p><strong>Total créditos:</strong> <?php echo $total_creditos; ?></p>
                    <p><strong>Promedio ponderado:</strong> <?php echo $total_ponderado/$total_creditos; ?></p>
                   
                </div>
 
            </div>
        </div>
    </div>
</div>
</section>
<?php
$this->load->view('template/footer');
?>