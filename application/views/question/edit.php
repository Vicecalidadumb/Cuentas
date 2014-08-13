<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>


<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('../images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('../images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:green">Editar Item</h1>
</div>


<div class="well">
    <ul>
        <li>
            <strong>TENGA EN CUENTA:</strong>
        </li>
        <li>
            Si se requiere utilizar imagenes solamente agregue archivos inferiores a 50KB.
        </li>
        <li>
            Si desea puede utilizar el boton
            <button type="button" class="btn btn-default btn-sm btn-small"><i class="fa fa-arrows-alt icon-fullscreen"></i></button>
            para ampliar el campo de edicion.
        </li>   
    </ul>    
</div>

<?php //echo '<pre><textarea>' . print_r($question, true) . '</textarea></pre>'; ?>

<?php echo form_open('question/update', 'id="question_update" class="form-signin" role="form" method="POST"'); ?>

<?php echo form_hidden('PREGUNTA_ID', $id_question); ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese el Tema </label>
            <?php echo form_input('PREGUNTA_TEMA', $question[0]->PREGUNTA_TEMA, 'id="PREGUNTA_TEMA" placeholder="Ingrese el Tema" class="form-control"') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Item</label>
            <?php echo form_dropdown('PREGUNTA_TIPOITEM', get_array_item_types(), '', 'class="form-control"'); ?>
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente</label>
            <span style="color: red"><?php echo $question[0]->COMPONENTE_NOMBRE; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Rubrica</label>
            <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), $question[0]->PREGUNTA_NIVELRUBRICA, 'class="form-control"'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Dificultad</label>
            <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), $question[0]->PREGUNTA_NIVELDIFICULTAD, 'class="form-control"'); ?>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado </label>
            <?php echo form_textarea('PREGUNTA_ENUNCIADO', $question[0]->PREGUNTA_ENUNCIADO, 'id="PREGUNTA_ENUNCIADO"'); ?>
        </div>
    </div>

    <?php
    $count = 1;
    $PREGUNTA_IDRESPUESTA = 0;
    foreach ($question as $data) {
        if ($data->RESPUESTA_ID == $question[0]->PREGUNTA_IDRESPUESTA) {
            $PREGUNTA_IDRESPUESTA = $count;
        }
        $count++;
    }
    ?>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Respuesta Correcta </label>
            <?php echo form_dropdown('PREGUNTA_IDRESPUESTA', get_array_number_questions(), $PREGUNTA_IDRESPUESTA, 'id="PREGUNTA_IDRESPUESTA" class="form-control"'); ?>
        </div>
    </div>    

</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_1', $question[0]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_1', $question[0]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_1" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="form-group">
            
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_2', $question[1]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"'); ?>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_2', $question[1]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_2" class="textarea_umb"'); ?>
        </div> 
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_3', $question[2]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_3', $question[2]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_3" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_4', $question[3]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"'); ?>
        </div> 
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Justificacion de la Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_JUSTIFICACION_4', $question[3]->RESPUESTA_JUSTIFICACION, 'id="RESPUESTA_JUSTIFICACION_4" class="textarea_umb"'); ?>
        </div>
    </div>     

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Observaciones</label>
            <textarea name="PREGUNTA_OBSERVACIONES" class="form-control" rows="3"><?php echo $question[0]->PREGUNTA_OBSERVACIONES; ?></textarea>
        </div>
    </div>
    
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Pregunta lista para enviar a etapa de Validaci&oacute;n.</label>
            <?php echo form_dropdown('PREGUNTA_ETAPA', array(0 => "NO", 1 => "SI"), $question[0]->PREGUNTA_ETAPA, 'id="PREGUNTA_IDRESPUESTA" class="form-control"'); ?>
        </div>
    </div>

    <div class="col-md-6">
        &nbsp;
    </div>     

    <div class="col-md-12">
        <button type="submit" class="btn btn-success">Actualizar</button>
    </div>    

    

</div>

<?php echo form_close(); ?>

<br><br><br><br>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />-->
<link rel="stylesheet" href="<?php echo base_url('../dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('../dist/js/summernote.js'); ?>"></script>
<link href="<?php echo base_url('../dist/css/summernote.css'); ?>" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#PREGUNTA_ENUNCIADO').summernote({
            height: 150,
            toolbar: [
                //['style', ['style']], // no style button
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture']], // no insert buttons
                ['fullscreen', ['fullscreen']],
                ['table', ['table']], // no table button
                ['help', ['help']] //no help button
            ]
        });
        
        $('.textarea_umb').summernote({
            height: 100,
            toolbar: [
                //['style', ['style']], // no style button
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture']], // no insert buttons
                ['fullscreen', ['fullscreen']],
                ['table', ['table']], // no table button
                ['help', ['help']] //no help button
            ]
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#question_update').validate(
                {
                    rules: {
                        PREGUNTA_TEMA: {
                            minlength: 2,
                            required: true
                        },
                        PREGUNTA_IDRESPUESTA: {
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