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
    <h2>Validaci&oacute;n de &Iacute;tems</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:green">Validaci&oacute;n de Item - Vista previa del Item</h1>
</div>


<?php //echo '<pre><textarea>' . print_r($validation, true) . '</textarea></pre>'; ?>


<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Persona a Cargo</label>
            <span style="color: red"><?php echo $question[0]->PERSONA_CARGO; ?></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Tema </label>
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

</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 1 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_1', $question[0]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_1" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-12">
        <div class="form-group">

            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 2 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_2', $question[1]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_2" class="textarea_umb"'); ?>
        </div> 
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 3 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_3', $question[2]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_3" class="textarea_umb"'); ?>
        </div> 
    </div> 

    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="text-align: center;width: 100%;">Opcion de Respuesta 4 </label>
            <?php echo form_textarea('RESPUESTA_ENUNCIADO_4', $question[3]->RESPUESTA_ENUNCIADO, 'id="RESPUESTA_ENUNCIADO_4" class="textarea_umb"'); ?>
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

    <div class="col-md-12">
        <div class="form-group">
            <h1 style="color:green">Validaci&oacute;n de Item</h1>
        </div>
    </div>
</div>

<?php //echo print_y($validation); ?>

<?php foreach ($validation as $valida) { ?>
    <blockquote style="background-color: #f5f5f5 !important">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">USUARIO QUE VALIDA</label>
                    <div style="text-align: center"><?php echo $valida->USUARIO_NOMBRES . ' ' . $valida->USUARIO_APELLIDOS; ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">TIPO DE EVALUACI&Oacute;N</label>
                    <div style="text-align: center"><?php echo get_validation_type($valida->TIPOEVALUACION_ID); ?></div>
                </div>
            </div>        
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">FECHA DE VALIDACI&Oacute;N</label>
                    <div style="text-align: center"><?php echo $valida->EVALUACION_FECHA; ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1" style="text-align: center;width: 100%;">PUNTAJE DE <?php echo get_validation_type($valida->TIPOEVALUACION_ID) ?></label>
                    <div style="text-align: center"><?php echo $valida->EVALUACION_PUNTUACION; ?></div>
                </div>
            </div>
            <div class="col-md-6">           
                <label for="exampleInputEmail1" style="text-align: center;width: 100%;">OBSERVACIONES DE <?php echo get_validation_type($valida->TIPOEVALUACION_ID) ?></label>
                <textarea name="VPE_OBS" class="form-control" rows="5"><?php echo $valida->EVALUACION_OBSERVACION; ?></textarea>            
            </div>
        </div>
    </blockquote>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h1 style="color:green">Consolidado de la Validaci&oacute;n</h1>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <td><strong>TIPO DE EVALUACI&Oacute;N</strong></td>
                <td><strong>PUNTAJE PROMEDIO</strong></td>
            </tr>
            <tr>
                <td>PERTINENCIA</td>
                <td><?php echo $question[0]->V1; ?></td>
            </tr> 
            <tr>
                <td>COHERENCIA</td>
                <td><?php echo $question[0]->V2; ?></td>
            </tr> 
            <tr>
                <td>RELEVANCIA</td>
                <td><?php echo $question[0]->V3; ?></td>
            </tr> 
            <tr>
                <td>SINTÁCTICA</td>
                <td><?php echo $question[0]->V4; ?></td>
            </tr> 
            <tr>
                <td>SEMÁNTICA</td>
                <td><?php echo $question[0]->V5; ?></td>
            </tr>
            <tr>
                <td><strong>PROMEDIO</strong></td>
                <td><strong><?php echo $validation_total = get_avg_validation($question[0]->V1, $question[0]->V2, $question[0]->V3, $question[0]->V4, $question[0]->V5) ?></strong></td>
            </tr>
            <tr>
                <td><strong>CONCLUSI&Oacute;N</strong></td>
                <td>
                    <strong>
                        <?php
                        switch ($validation_total) {
                            case 0: echo '<span style="color:#0044cc">SIN EVALUAR</span>';
                                break;
                            case $validation_total <= 1.9 : echo '<span style="color:#FF0000">SE DESCARTA</span>';
                                break;
                            case $validation_total >= 2.0 && $validation_total <= 3.9:
                                echo '<span style="color:#FFCC33">SE MODIFICA</span>';
                                break;
                            case $validation_total >= 4.0: echo '<span style="color:#00CC00">SE CONSERVA</span>';
                                break;
                        }
                        ?>
                    </strong>
                </td>
            </tr>              
        </table>
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
                ['fullscreen', ['fullscreen']],
            ]
        });

        $('.textarea_umb').summernote({
            height: 100,
            toolbar: [
                ['fullscreen', ['fullscreen']],
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
        $('#validation_insert').validate(
                {
                    rules: {
                        VPE: {
                            required: true
                        },
                        VPE_OBS: {
                            required: true
                        },
                        VCO: {
                            required: true
                        },
                        VCO_OBS: {
                            required: true
                        },
                        VRE: {
                            required: true
                        },
                        VRE_OBS: {
                            required: true
                        },
                        VSI: {
                            required: true
                        },
                        VSI_OBS: {
                            required: true
                        },
                        VSE: {
                            required: true
                        },
                        VSE_OBS: {
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

        setTimeout("prueba()", 500)
    });
</script>