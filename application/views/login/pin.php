<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        ?>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo base_url('/images/favicon.png'); ?>">

        <title>Recordar Pin</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('/dist/css/bootstrap.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('/dist/css/signin.css'); ?>" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <?php echo form_open('login/remember_pin_send', 'class="form-signin" role="form" autocomplete="off"'); ?>
<!--            <img src="<?php echo base_url('/images/banner1.png'); ?>" style="width: 180px;">-->
            <img src="<?php echo base_url('/images/marca-umb.png'); ?>" style="width: 280px;">
            <h4>Vicerrector&iacute;a de Calidad</h4>
            <h2 class="form-signin-heading">Aplicativo de Cargue de Documentos</h2>

            <!--<h4>Sistema Integrado de Evaluación Institucional - UMB</h4>-->
            <h4 class="form-signin-heading">Para restablecer el PIN, 
                por favor introduzca su numero de documento y la dirección de correo electr&oacute;nico.
            </h4>
            <?php echo form_input('username', '', 'class="form-control" placeholder="Documento" required autofocus') ?>
            <?php echo form_input('email', '', 'class="form-control" placeholder="Correo Electronico" required autofocus') ?>
            <br>
            <button class="btn btn-lg btn-success btn-block" type="submit">Restablecer Pin</button>
            <hr style="border-top: 1px solid #ccc !important;">
            <a href="<?php echo base_url(''); ?>">
                <button class="btn btn-lg btn-info btn-block" type="button">Cancelar</button>
            </a>
            
            <?php echo form_close(); ?> 
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>
        </div> <!-- /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <div id="footer">
            <div class="container">
                <p class="text-muted" style="text-align: center;">Copyright © <?php echo date("Y"); ?> Universidad Manuela Beltr&aacute;n.</p>
            </div>
        </div>
    </body>
</html>