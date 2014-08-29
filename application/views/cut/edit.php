<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>


<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Usuarios del Sistema</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Editar Usuario
    </h1>
</div>


<?php echo form_open('user/update', 'id="user_update" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('USUARIO_ID', $user[0]->USUARIO_ID); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Nombres </label>
            <?php echo form_input('USUARIO_NOMBRES', $user[0]->USUARIO_NOMBRES, 'id="USUARIO_NOMBRES" placeholder="Nombres" class="form-control"') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Documento</label>
            <?php echo form_dropdown('USUARIO_TIPODOCUMENTO', array("CC" => "CC"), $user[0]->USUARIO_TIPODOCUMENTO, 'class="form-control"'); ?>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Correo Electronico</label>
             <?php echo form_input('USUARIO_CORREO', $user[0]->USUARIO_CORREO, 'id="USUARIO_CORREO" placeholder="Correo" class="form-control"') ?>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Clave del Sistema (Vac&iacute;o para no modificar la actual clave)</label>
             <?php echo form_password('USUARIO_CLAVE', '', 'id="USUARIO_CLAVE" placeholder="Clave" class="form-control"') ?>
        </div>         

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Apellidos </label>
            <?php echo form_input('USUARIO_APELLIDOS', $user[0]->USUARIO_APELLIDOS, 'id="USUARIO_APELLIDOS" placeholder="Apellidos" class="form-control"') ?>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Numero de Documento / Usuario del Sistema</label>
            <?php echo form_input('USUARIO_NUMERODOCUMENTO', $user[0]->USUARIO_NUMERODOCUMENTO, 'id="USUARIO_NUMERODOCUMENTO" placeholder="Numero de Documento / Usuario del Sistema" class="form-control"') ?>
        </div>        
        
        <div class="form-group">
            <label for="exampleInputEmail1">Rol</label>
            <?php echo form_dropdown('ID_TIPO_USU', $roles, $user[0]->ID_TIPO_USU, 'class="form-control"'); ?>
        </div>        

    </div>
   
</div>

<div class="row">
    <button type="submit" class="btn btn-success">Actualizar</button>

</div>

<?php echo form_close(); ?>

<br><br><br><br>

<script>
    $(document).ready(function() {
        $('#user_update').validate(
                {
                    rules: {
                        USUARIO_NOMBRES: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_CORREO: {
                            required: true,
                            email: true
                        },
                        USUARIO_APELLIDOS: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_NUMERODOCUMENTO: {
                            minlength: 2,
                            required: true
                        }
                    },
                    highlight: function(element) {
                        $(element).closest('.control-group').removeClass('success').addClass('error');
                    },
                    success: function(element) {
                        element
                                .text('OK!').addClass('valid')
                                .closest('.control-group').removeClass('error').addClass('success');
                    }
                });
    });
</script>