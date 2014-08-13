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
    <h1 style="color:green">Vista del Item (Actualmente en Etapa de Validaci&oacute;n)</h1>
    <h4 style="color:green">Fecha de Construcci&oacute;n: <?php echo $question[0]->PREGUNTA_FECHADECREACION; ?></h4>
</div>


<?php //echo '<pre><textarea>' . print_r($question, true) . '</textarea></pre>'; ?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese el Tema </label>
            <?php echo form_input('PREGUNTA_TEMA', $question[0]->PREGUNTA_TEMA, 'id="PREGUNTA_TEMA" placeholder="Ingrese el Tema" class="form-control" disabled') ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tipo de Item</label>
            <?php echo form_dropdown('PREGUNTA_TIPOITEM', get_array_item_types(), '', 'class="form-control" disabled'); ?>
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Componente</label>
            <span style="color: red"><?php echo $question[0]->COMPONENTE_NOMBRE; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Rubrica</label>
            <?php echo form_dropdown('PREGUNTA_NIVELRUBRICA', get_array_rubrics(), $question[0]->PREGUNTA_NIVELRUBRICA, 'class="form-control" disabled'); ?>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Nivel de Dificultad</label>
            <?php echo form_dropdown('PREGUNTA_NIVELDIFICULTAD', get_array_difficulty_level(), $question[0]->PREGUNTA_NIVELDIFICULTAD, 'class="form-control" disabled'); ?>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Enunciado </label>
            <?php echo form_textarea('PREGUNTA_ENUNCIADO', $question[0]->PREGUNTA_ENUNCIADO, 'id="PREGUNTA_ENUNCIADO" disabled'); ?>
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
            <?php echo form_dropdown('PREGUNTA_IDRESPUESTA', get_array_number_questions(), $PREGUNTA_IDRESPUESTA, 'id="PREGUNTA_IDRESPUESTA" class="form-control" disabled'); ?>
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
            <textarea name="PREGUNTA_OBSERVACIONES" class="form-control" rows="3" disabled><?php echo $question[0]->PREGUNTA_OBSERVACIONES; ?></textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Pregunta lista para enviar a etapa de Validaci&oacute;n.</label>
            <?php echo form_dropdown('PREGUNTA_ETAPA', array(0 => "NO", 1 => "SI"), $question[0]->PREGUNTA_ETAPA, 'id="PREGUNTA_IDRESPUESTA" class="form-control" disabled'); ?>
        </div>
    </div>

    <div class="col-md-6">
        &nbsp;
    </div>

</div>

<br><br><br><br>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />-->
<link rel="stylesheet" href="<?php echo base_url('dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('dist/js/summernote.js'); ?>"></script>
<link href="<?php echo base_url('dist/css/summernote.css'); ?>" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function() {

        $('#PREGUNTA_ENUNCIADO').summernote({
            height: 150,
            toolbar: [
                ['fullscreen', ['fullscreen']]
            ]
        });

        $('.textarea_umb').summernote({
            height: 100,
            toolbar: [
                ['fullscreen', ['fullscreen']]
            ]
        });
    });
</script>

<script>
    function prueba() {
        $(".note-editable").attr('contenteditable', 'false');
        $(".note-editable").css('cursor', 'not-allowed');
    }

    $(document).ready(function() {
        setTimeout("prueba()", 500)
    });
</script>