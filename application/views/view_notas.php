<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Notas List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('notas/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('notas/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('notas'); ?>" class="btn btn-default">Reset</a>
                        <?php
                    }
                    ?>
                    <input type="submit" value="Search" class="btn btn-primary" />
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>CODIGO_NOTA</th>
		<th>CODIGO_ALUMNO</th>
		<th>CODIGO_ASIGNATURA</th>
		<th>PRIMER_PARCIAL</th>
		<th>SEGUNDA_PARCIAL</th>
		<th>NOTA_FINAL</th>
		<th>FECHA_ING_NOTAS</th>
		<th>SEMESTRE</th>
		<th>Action</th>
            </tr><?php
            foreach ($notas_data as $notas)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $notas->CODIGO_NOTA ?></td>
			<td><?php echo $notas->CODIGO_ALUMNO ?></td>
			<td><?php echo $notas->CODIGO_ASIGNATURA ?></td>
			<td><?php echo $notas->PRIMER_PARCIAL ?></td>
			<td><?php echo $notas->SEGUNDA_PARCIAL ?></td>
			<td><?php echo $notas->NOTA_FINAL ?></td>
			<td><?php echo $notas->FECHA_ING_NOTAS ?></td>
			<td><?php echo $notas->SEMESTRE ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('notas/read/'.$notas->),'Read'); 
				echo ' | '; 
				echo anchor(site_url('notas/update/'.$notas->),'Update'); 
				echo ' | '; 
				echo anchor(site_url('notas/delete/'.$notas->),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('notas/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>