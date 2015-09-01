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
        <h2 style="margin-top:0px">Alumnos Read</h2>
        <table class="table">
	    <tr><td>NOMBRE_ALUMNO</td><td><?php echo $NOMBRE_ALUMNO; ?></td></tr>
	    <tr><td>APELLIDO_PATERNO</td><td><?php echo $APELLIDO_PATERNO; ?></td></tr>
	    <tr><td>APELLIDO_MATERNO</td><td><?php echo $APELLIDO_MATERNO; ?></td></tr>
	    <tr><td>EMAIL</td><td><?php echo $EMAIL; ?></td></tr>
	    <tr><td>TELEFONO</td><td><?php echo $TELEFONO; ?></td></tr>
	    <tr><td>DIRECCION</td><td><?php echo $DIRECCION; ?></td></tr>
	    <tr><td>SEXO</td><td><?php echo $SEXO; ?></td></tr>
	    <tr><td>FECHA_NACIMIENTO</td><td><?php echo $FECHA_NACIMIENTO; ?></td></tr>
	    <tr><td>DNI</td><td><?php echo $DNI; ?></td></tr>
	    <tr><td>AÑO_INGRESO</td><td><?php echo $AÑO_INGRESO; ?></td></tr>
	    <tr><td>SEMESTRE_INGRESO</td><td><?php echo $SEMESTRE_INGRESO; ?></td></tr>
	    <tr><td>CARRERA_PROFESIONAL</td><td><?php echo $CARRERA_PROFESIONAL; ?></td></tr>
	    <tr><td>TURNO</td><td><?php echo $TURNO; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('alumnos') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>