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
        <h2 style="margin-top:0px">Facultad Read</h2>
        <table class="table">
	    <tr><td>NOMBRE_FACULTAD</td><td><?php echo $NOMBRE_FACULTAD; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('facultad') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>