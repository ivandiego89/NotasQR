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
        <h2 style="margin-top:0px">Curso_alumno <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">SEMESTRE <?php echo form_error('SEMESTRE') ?></label>
                <input type="text" class="form-control" name="SEMESTRE" id="SEMESTRE" placeholder="SEMESTRE" value="<?php echo $SEMESTRE; ?>" />
            </div>
	    <input type="hidden" name="CODIGO_MATRICULA" value="<?php echo $CODIGO_MATRICULA; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('curso_alumno') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>