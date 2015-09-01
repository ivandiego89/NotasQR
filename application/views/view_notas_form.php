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
        <h2 style="margin-top:0px">Notas <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="int">CODIGO_NOTA <?php echo form_error('CODIGO_NOTA') ?></label>
                <input type="text" class="form-control" name="CODIGO_NOTA" id="CODIGO_NOTA" placeholder="CODIGO_NOTA" value="<?php echo $CODIGO_NOTA; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">CODIGO_ALUMNO <?php echo form_error('CODIGO_ALUMNO') ?></label>
                <input type="text" class="form-control" name="CODIGO_ALUMNO" id="CODIGO_ALUMNO" placeholder="CODIGO_ALUMNO" value="<?php echo $CODIGO_ALUMNO; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">CODIGO_ASIGNATURA <?php echo form_error('CODIGO_ASIGNATURA') ?></label>
                <input type="text" class="form-control" name="CODIGO_ASIGNATURA" id="CODIGO_ASIGNATURA" placeholder="CODIGO_ASIGNATURA" value="<?php echo $CODIGO_ASIGNATURA; ?>" />
            </div>
	    <div class="form-group">
                <label for="decimal">PRIMER_PARCIAL <?php echo form_error('PRIMER_PARCIAL') ?></label>
                <input type="text" class="form-control" name="PRIMER_PARCIAL" id="PRIMER_PARCIAL" placeholder="PRIMER_PARCIAL" value="<?php echo $PRIMER_PARCIAL; ?>" />
            </div>
	    <div class="form-group">
                <label for="decimal">SEGUNDA_PARCIAL <?php echo form_error('SEGUNDA_PARCIAL') ?></label>
                <input type="text" class="form-control" name="SEGUNDA_PARCIAL" id="SEGUNDA_PARCIAL" placeholder="SEGUNDA_PARCIAL" value="<?php echo $SEGUNDA_PARCIAL; ?>" />
            </div>
	    <div class="form-group">
                <label for="decimal">NOTA_FINAL <?php echo form_error('NOTA_FINAL') ?></label>
                <input type="text" class="form-control" name="NOTA_FINAL" id="NOTA_FINAL" placeholder="NOTA_FINAL" value="<?php echo $NOTA_FINAL; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">FECHA_ING_NOTAS <?php echo form_error('FECHA_ING_NOTAS') ?></label>
                <input type="text" class="form-control" name="FECHA_ING_NOTAS" id="FECHA_ING_NOTAS" placeholder="FECHA_ING_NOTAS" value="<?php echo $FECHA_ING_NOTAS; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">SEMESTRE <?php echo form_error('SEMESTRE') ?></label>
                <input type="text" class="form-control" name="SEMESTRE" id="SEMESTRE" placeholder="SEMESTRE" value="<?php echo $SEMESTRE; ?>" />
            </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('notas') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>