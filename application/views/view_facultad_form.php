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
        <h2 style="margin-top:0px">Facultad <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">NOMBRE_FACULTAD <?php echo form_error('NOMBRE_FACULTAD') ?></label>
                <input type="text" class="form-control" name="NOMBRE_FACULTAD" id="NOMBRE_FACULTAD" placeholder="NOMBRE_FACULTAD" value="<?php echo $NOMBRE_FACULTAD; ?>" />
            </div>
	    <input type="hidden" name="CODIGO_FACULTAD" value="<?php echo $CODIGO_FACULTAD; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('facultad') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>