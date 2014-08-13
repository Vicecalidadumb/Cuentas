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
    <h2>Componentes</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Editar Componente
    </h1>
</div>


<?php echo form_open('component/update', 'id="component_update" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('COMPONENTE_ID', $component[0]->COMPONENTE_ID); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente </label>
            <?php echo form_input('COMPONENTE_NOMBRE', $component[0]->COMPONENTE_NOMBRE, 'id="COMPONENTE_NOMBRE" placeholder="Nombre del Componente" class="form-control"') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Numero de Items a Construir</label>
            <?php echo form_input('COMPONENTE_PREGUNTAS', $component[0]->COMPONENTE_PREGUNTAS, 'id="COMPONENTE_PREGUNTAS" placeholder="Numero de Preguntas" class="form-control"') ?>
        </div>


    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Sigla </label>
            <?php echo form_input('COMPONENTE_SIGLA', $component[0]->COMPONENTE_SIGLA, 'id="COMPONENTE_SIGLA" placeholder="Sigla del Componente" class="form-control"') ?>
        </div>      
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3 style="color:#2aabd2">
            Usuarios Asignados
        </h3>
    </div>

    <div class="col-md-12">
    <?php
    $array_users = explode(',',$component[0]->ASIGNADOS);
    ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Seleccione los Usuarios Asignados al Componente</label>
            <?php echo form_multiselect('USUARIO_IDs[]', $users, $array_users, 'class="form-control"'); ?>
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
        $('#component_update').validate(
                {
                    rules: {
                        COMPONENTE_NOMBRE: {
                            minlength: 2,
                            required: true
                        },
                        COMPONENTE_PREGUNTAS: {
                            required: true
                        },
                        COMPONENTE_SIGLA: {
                            minlength: 2,
                            required: true
                        },
                        USUARIO_IDs: {
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