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
        <h2 style="margin-top:0px">Matriculas Read</h2>
        <table class="table">
	    <tr><td>CODIGO_ALUMNO</td><td><?php echo $CODIGO_ALUMNO; ?></td></tr>
	    <tr><td>FECHA_MATRICULA</td><td><?php echo $FECHA_MATRICULA; ?></td></tr>
	    <tr><td>CODIGO_CARRERA</td><td><?php echo $CODIGO_CARRERA; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('matriculas') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>