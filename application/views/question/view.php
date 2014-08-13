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

<?php
//echo '<pre>'.print_r($questions,true).'</pre>';
//echo date("Y-m-d H:i:s");
?>

<?php if (count($questions) > 0) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Persona a Cargo</th>
                <th>Componente</th>
                <th>Tema</th>
                <th>Nivel Rubrica</th>
                <th>Nivel Dificultad</th>
                <th>Enunciado</th>
                <th style="text-align: center;">Opciones</th>
                <th style="text-align: center;">Validaci&oacute;n</th>
                <th style="text-align: center;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($questions as $question) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $question->PERSONA_CARGO; ?></td>
                    <td><?php echo $question->COMPONENTE_NOMBRE; ?></td>
                    <td><?php echo $question->PREGUNTA_TEMA; ?></td>
                    <td><?php echo $question->PREGUNTA_NIVELRUBRICA; ?></td>
                    <td><?php echo get_difficulty_level($question->PREGUNTA_NIVELDIFICULTAD); ?></td>
                    <td><?php echo substr(strip_tags($question->PREGUNTA_ENUNCIADO), 0, 150) . '...'; ?></td>
                    <td style="text-align: center;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <a href="<?php echo base_url("question/edit/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                <button type="button" class="btn btn-info btn-sm">
                                    <span class="glyphicon glyphicon-edit"></span> Editar
                                </button>
                            </a>
                        <?php } else { ?>
                            <div style="text-align: center;color: #00CC00;font-size: 10px;">
                                <a href="<?php echo base_url("question/preview/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-zoom-in"></span> EN VALIDACI&Oacute;N
                                    </button>
                                </a>                                
                                <br>
                                <span style="font-size: 9px; color: red;">
                                    Desde: <?php echo $question->PREGUNTA_FECHADECREACION; ?>
                                </span>
                            </div>
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($question->PREGUNTA_ETAPA == 0) { ?>
                            <div style="text-align: center;color: #FF0000">EN ETAPA DE CONSTRUCCI&Oacute;N</div>
                        <?php } else { ?>
                            <div style="text-align: center;color: #0044cc">
                                <?php
                                $validation_total = get_avg_validation($question->V1, $question->V2, $question->V3, $question->V4, $question->V5);
                                switch ($validation_total) {
                                    case 0: echo $validation_total . '<br><span style="color:#0044cc">SIN EVALUAR</span>';
                                        break;
                                    case $validation_total <= 1.9 : echo $validation_total . '<br><span style="color:#FF0000">SE DESCARTA</span>';
                                        break;
                                    case $validation_total >= 2.0 && $validation_total <= 3.9:
                                        echo $validation_total . '<br><span style="color:#FFCC33">SE MODIFICA</span>';
                                        if (know_permission_role('VMO', 'permission_view') == 1) {
                                            $validate_modify_item = get_modify_item($question->PREGUNTA_ID);
                                            //echo count($validate_modify_item);
                                            $title_modify = (count($validate_modify_item) > 0) ? 'Pregunta Modificada' : 'Modificar Pregunta Ahora';
                                            $color_modify = (count($validate_modify_item) > 0) ? 'info' : 'success';
                                            ?>
                                            <a href="<?php echo base_url("question/edit_question/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                                <button type="button" class="btn btn-<?php echo $color_modify; ?> btn-sm">
                                                    <span class="glyphicon glyphicon-edit"></span> <?php echo $title_modify; ?>
                                                </button>
                                            </a> 
                                        <?php } ?>
                                        <?php
                                        break;
                                    case $validation_total >= 4.0: echo $validation_total . '<br><span style="color:#00CC00">SE CONSERVA</span>';
                                        break;
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($question->PREGUNTA_ETAPA != 0) { ?>
                            <?php if (get_avg_validation($question->V1, $question->V2, $question->V3, $question->V4, $question->V5) > 0) { ?>
                                <a href="<?php echo base_url("question/view_validation/" . encrypt_id($question->PREGUNTA_ID)); ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-zoom-in"></span>Ver Validacion
                                    </button>  
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>            
                <?php
                $count++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>

    <div class="alert alert-warning">
        No se encontraron registros
    </div>

<?php } ?>