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
        <h2 style="margin-top:0px">Matriculas List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('matriculas/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('matriculas/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('matriculas'); ?>" class="btn btn-default">Reset</a>
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
		<th>CODIGO_ALUMNO</th>
		<th>FECHA_MATRICULA</th>
		<th>CODIGO_CARRERA</th>
		<th>Action</th>
            </tr><?php
            foreach ($matriculas_data as $matriculas)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $matriculas->CODIGO_ALUMNO ?></td>
			<td><?php echo $matriculas->FECHA_MATRICULA ?></td>
			<td><?php echo $matriculas->CODIGO_CARRERA ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('matriculas/read/'.$matriculas->CODIGO_MATRICULA),'Read'); 
				echo ' | '; 
				echo anchor(site_url('matriculas/update/'.$matriculas->CODIGO_MATRICULA),'Update'); 
				echo ' | '; 
				echo anchor(site_url('matriculas/delete/'.$matriculas->CODIGO_MATRICULA),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>