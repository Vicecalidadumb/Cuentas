<!-- Main jumbotron for a primary marketing message or call to action -->
<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<?php
//echo print_y($this->session->userdata('rol_permissions'));
//echo print_y($this->session->userdata('politicas'));
?>
<div class="jumbotron">
    <div style="text-align: center">
<!--        <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">-->
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Bienvenido al Concurso Abierto de M&eacute;ritos</h2>
    <!--    <h4>VICERRECTORIA DE CALIDAD - CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>-->
    <p>Aplicativo de Cargue de Documentos.</p>
    <p>Convocatoria <strong><?php echo $this->session->userdata('CONVOCATORIA_NOMBRE'); ?></strong>.</p>
    <br>
    <p style="font-size: 15px !important; text-align: justify !important;">
        <strong>PROCEDIMIENTO PARA EL CARGUE DE DOCUMENTOS</strong>
        <br>
        Bienvenido al procedimiento de cargue de documentos de la Convocatoria
        <br><br>
        Para realizar el proceso de cargue de documentos, tenga en cuenta que estos deben ser escaneados en archivos 
        independientes (por separado), en blanco y negro, en formato PDF y su tama&ntilde;o no debe ser superior a dos 
        <strong>(2) megabytes (MB)</strong>.  El cargue de  documentos, se har&aacute;  &uacute;nicamente por medio electr&oacute;nico en el 
        per&iacute;odo comprendido 
        entre el <strong>XX al XX de XXXXXXX de XXXX</strong>, se habilitar&aacute; el sistema para tal fin  a partir de las doble cero horas 
        (00:00) del primer d&iacute;a de recepci&oacute;n y hasta las veintitr&eacute;s horas y cincuenta y nueve minutos 
        (23:59) del &uacute;ltimo 
        d&iacute;a de recepci&oacute;n.
        <br><br>
        Tenga presente los documentos que se deben cargar para la verificaci&oacute;n de requisitos m&iacute;nimos y que 
        est&aacute;n consignados 
        en el Acuerdo No. 432 del 03 de septiembre de 2013. La no presentaci&oacute;n de los documentos que trata el 
        art&iacute;culo 18 
        del presente acuerdo, dentro de las condiciones y  plazos fijados, se entender&aacute; como retiro o desistimiento, 
        por 
        lo que el aspirante quedar&aacute; autom&aacute;ticamente excluido del proceso.
        <br><br>
        <?php if (!$this->session->userdata('politicas')): ?>
            Si acepta las anteriores condiciones haga "click" en el bot&oacute;n <strong>ACEPTAR</strong>.
        <?php endif; ?>
    </p>

    <p style="text-align: right !important;">
        <?php if (!$this->session->userdata('politicas')){ ?>
            <a href="<?php echo base_url("login/politicasok") ?>" class="btn btn-danger btn-lg" role="button">
                Aceptar
            </a>
        <?php }else{ ?>
            <a href="<?php echo base_url("particles") ?>" class="btn btn-success btn-lg" role="button">
                Ir al paso 1: Documentos Especificos
            </a>        
        <?php } ?>
    </p>
</div>