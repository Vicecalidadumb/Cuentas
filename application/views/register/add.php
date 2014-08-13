<div class="jumbotron">
    <div style="text-align: center">
<!--    <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">-->
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Bienvenido al Concurso Abierto de M&eacute;ritos</h2>
    <p>Aplicativo de Cargue de Documentos - Registro de Aspirantes</p>
</div>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<?php
echo $resp_captcha;
?>

<?php echo validation_errors(); ?>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Agregar Nuevo Registro
    </h1>
</div>


<?php echo form_open('register/insert', 'id="register_insert" class="form-signin" role="form" method="POST" autocomplete="off"'); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Documento </label>
            <?php echo form_dropdown('USUARIO_TIPODOCUMENTO', $tipos_documentos, set_value('USUARIO_TIPODOCUMENTO'), 'class="form-control" tabindex=1'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nombres <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_NOMBRES', set_value('USUARIO_NOMBRES'), 'id="USUARIO_NOMBRES" placeholder="Nombres" class="form-control" tabindex=3') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Genero </label>
            <?php echo form_dropdown('USUARIO_GENERO', array('M' => 'Masculino', 'F' => 'Femenino'), set_value('USUARIO_GENERO'), 'class="form-control" tabindex=5'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Departamento de Nacimiento <span style="color:red">*</span></label>
            <?php echo form_dropdown('DEPARTAMENTO_NACIMIENTO', $departments_1, ' ', 'class="form-control" onchange="get_mun(this.value,\'lugar_de_nacimiento\',\'USUARIO_LUGARDENACIMIENTO\',\'8\' )" tabindex=7'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Departamento de Residencia <span style="color:red">*</span></label>
            <?php echo form_dropdown('DEPARTAMENTO_RESIDENCIA', $departments_2, ' ', 'class="form-control" onchange="get_mun(this.value,\'lugar_de_residencia\',\'USUARIO_LUGARDERESIDENCIA\',\'10\')" tabindex=9'); ?>
        </div>      

        <div class="form-group">
            <label for="exampleInputEmail1">Direccion </label>
            <?php echo form_input('USUARIO_DIRECCIONRESIDENCIA', set_value('USUARIO_DIRECCIONRESIDENCIA'), 'id="USUARIO_DIRECCIONRESIDENCIA" placeholder="Direccion" class="form-control" tabindex=11') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Telefono <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_TELEFONOFIJO', set_value('USUARIO_TELEFONOFIJO'), 'id="USUARIO_TELEFONOFIJO" placeholder="Telefono Fijo" class="form-control" tabindex=13') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Confirmar Correo Electronico <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_CORREO', set_value('USUARIO_CORREO'), 'id="USUARIO_CORREO" placeholder="Confirmar Correo Electronico" class="form-control" tabindex=15') ?>
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Numero de Documento <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_NUMERODOCUMENTO', set_value('USUARIO_NUMERODOCUMENTO'), 'id="USUARIO_NUMERODOCUMENTO" placeholder="Numero de Documento" class="form-control" tabindex=2') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Apellidos <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_APELLIDOS', set_value('USUARIO_APELLIDOS'), 'id="USUARIO_APELLIDOS" placeholder="Apellidos" class="form-control" tabindex=4') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Fecha de Nacimiento (DD/MM/AAAA) <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_FECHADENACIMIENTO', set_value('USUARIO_FECHADENACIMIENTO'), 'id="USUARIO_FECHADENACIMIENTO" placeholder="Fecha de Nacimiento (DD/MM/AAAA)" class="form-control" tabindex=6') ?>
        </div>   

        <div class="form-group">
            <label for="exampleInputEmail1">Municipio de Nacimiento <span style="color:red">*</span></label>
            <span id="lugar_de_nacimiento">
                <?php echo form_dropdown('USUARIO_LUGARDENACIMIENTO', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=8'); ?>
            </span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Municipio de Residencia <span style="color:red">*</span></label>
            <span id="lugar_de_residencia">
                <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
            </span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Numero Celular </label>
            <?php echo form_input('USUARIO_CELULAR', set_value('USUARIO_CELULAR'), 'id="USUARIO_CELULAR" placeholder="Numero Celular" class="form-control" tabindex=12') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Correo Electronico <span style="color:red">*</span></label>
            <?php echo form_input('USUARIO_CORREO_2', set_value('USUARIO_CORREO_2'), 'id="USUARIO_CORREO_2" placeholder="Correo Electronico" class="form-control" tabindex=14') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Inscribirse en la convocatoria </label>
            <?php echo form_dropdown('CONVOCATORIA_ID', $convocatorias, set_value('CONVOCATORIA_ID'), 'class="form-control" tabindex=16'); ?>
        </div>         

    </div>
</div>
<div class="well" style="max-width: 400px; margin: 0 auto 10px;">
    <p style="text-align: center !important;">
        Por favor ingrese los caracteres representados en la imagen.
        <a href="http://es.wikipedia.org/wiki/Captcha" target="_blank">
            <button type="button" class="btn btn-warning btn-sm">? </button>
        </a>
    </p>
    <?php
    $publickey = "6LeZ8PUSAAAAAL1raJ7edmSTQT1zhye6c5rPjgJK"; // you got this from the signup page
    echo recaptcha_get_html($publickey);
    ?>
</div>
<br>

<div class="row">
    <button type="submit" class="btn btn-success">Guardar Datos</button>
    <a href="<?php echo base_url(''); ?>">
        <button type="button" class="btn btn-danger">Cancelar</button>
    </a>
</div>


<?php echo form_close(); ?>

<br><br><br><br>


<script>
    /*
     $(document).ready(function() {
     $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
     })*/
</script>

<script>
    $(document).ready(function() {

        $("#USUARIO_FECHADENACIMIENTO").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy/mm/dd",
            yearRange: '1930:2014'
        });

        $('#register_insert').validate(
                {
                    rules: {
                        USUARIO_NUMERODOCUMENTO: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_NOMBRES: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_APELLIDOS: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_FECHADENACIMIENTO: {
                            minlength: 10,
                            required: true
                        },
                        DEPARTAMENTO_NACIMIENTO: {
                            required: true
                        },
                        USUARIO_LUGARDENACIMIENTO: {
                            required: true
                        },
                        DEPARTAMENTO_RESIDENCIA: {
                            required: true
                        },
                        USUARIO_LUGARDERESIDENCIA: {
                            required: true
                        },
                        USUARIO_TELEFONOFIJO: {
                            required: true
                        },
                        USUARIO_CORREO: {
                            required: true,
                            equalTo: "#USUARIO_CORREO_2",
                            email: true
                        },
                        USUARIO_CORREO_2: {
                            required: true,
                            email: true
                        },
                    },
                    highlight: function(element) {
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                    }
                });

    });
</script>

<script>
    var base_url_js = '<?php echo base_url(); ?>';
    function get_mun(dep, span, select, index) {
        $.ajax({
            data: "dep=" + dep + "&select=" + select + "&index=" + index,
            type: "POST",
            dataType: "html",
            url: base_url_js + "register/get_mun",
            success: function(data) {
                $("#" + span).html(data)
            },
            async: true
        });
    }
</script>