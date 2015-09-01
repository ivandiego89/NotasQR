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
        <h2 style="margin-top:0px">Docentes Read</h2>
        <table class="table">
	    <tr><td>NOMBRE_DOCENTE</td><td><?php echo $NOMBRE_DOCENTE; ?></td></tr>
	    <tr><td>AP_DOCENTE</td><td><?php echo $AP_DOCENTE; ?></td></tr>
	    <tr><td>AM_DOCENTE</td><td><?php echo $AM_DOCENTE; ?></td></tr>
	    <tr><td>DIRECCION</td><td><?php echo $DIRECCION; ?></td></tr>
	    <tr><td>TELEFONO</td><td><?php echo $TELEFONO; ?></td></tr>
	    <tr><td>SEXO</td><td><?php echo $SEXO; ?></td></tr>
	    <tr><td>DNI</td><td><?php echo $DNI; ?></td></tr>
	    <tr><td>EMAIL</td><td><?php echo $EMAIL; ?></td></tr>
	    <tr><td>FECHA_INGRESO</td><td><?php echo $FECHA_INGRESO; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('docentes') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>