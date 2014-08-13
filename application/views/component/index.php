<?php
$array_color_1 = array('success', 'warning', 'danger');
$array_color_2 = array('#5cb85c', '#f0ad4e', '#d9534f');
?>

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
    <h2>Componentes</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Listado de Componentes
        <a href="<?php echo base_url("component/add"); ?>">
            <button type="button" class="btn btn-primary btn-lg">Agregar Registro</button>
        </a>
    </h1>
</div>

<?php
//echo '<pre>'.print_r($components,true).'</pre>';
?>
<table class="table table-striped">
    <tr>
        <td>
            <strong>Componente</strong>
        </td>
        <td>
            <strong>Sigla</strong>
        </td>
        <td>
            <strong>Usuarios Asignados</strong>
        </td>        
        <td>
            <strong>Numero de Items</strong>
        </td>
        <td>
            <strong>Porcentaje Construido</strong>
        </td>
        <td>
            <strong>Opciones</strong>
        </td>        
    </tr>
    <?php
    $count = 1;
    foreach ($components as $component) {
        //echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
        ?>
        <tr>
            <td>
                </strong><?php echo $component->COMPONENTE_NOMBRE; ?>
            </td>	
            <td>
                <?php echo $component->COMPONENTE_SIGLA; ?>
            </td>
            <td>
                <?php echo $component->ASIGNADOS; ?>
            </td>
            <td>
                <?php echo $component->COMPONENTE_PREGUNTAS; ?>
            </td>						
            <td>
                <?php
                $porcen = ($component->ITEMS * 100) / $component->COMPONENTE_PREGUNTAS;
                echo round($porcen) . '% |  ' . $component->ITEMS . ' de ' . $component->COMPONENTE_PREGUNTAS . ' Items';
                ?>
                <div class="progress progress-striped active">
                    <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($porcen); ?>%">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </td>
            <td>
                <a href="<?php echo base_url("component/edit/" . encrypt_id($component->COMPONENTE_ID)); ?>">
                    <button type="button" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Editar
                    </button>
                </a>  

                <!-- Button trigger modal -->
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_<?php echo $count; ?>">
                    <span class="glyphicon glyphicon-stats"></span>Ver
                </button>


                <!-- Modal -->
                <div class="modal fade" id="myModal_<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">
                                    Detalles del Componente <?php echo $component->COMPONENTE_NOMBRE; ?>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <h4>Items Construidos</h4>
                                <?php
                                $porcen = ($component->ITEMS * 100) / $component->COMPONENTE_PREGUNTAS;
                                echo round($porcen) . '% |  ' . $component->ITEMS . ' de ' . $component->COMPONENTE_PREGUNTAS . ' Items';
                                ?>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($porcen); ?>%">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>

                                <h4>Nivel de Rubrica Construido</h4>
                                <?php
                                if ($component->NIVELRUBRICAS != '') {

                                    $total_NIVELRUBRICAS = explode(',', $component->NIVELRUBRICAS);
                                    $total_NIVELRUBRICAS_unique = array_count_values($total_NIVELRUBRICAS);

                                    $a = 0;
                                    foreach ($total_NIVELRUBRICAS_unique as $key => $value) {
                                        $porcen = ($value * 100) / count($total_NIVELRUBRICAS);
                                        $porcen = round($porcen);
                                        echo '<span style="font-size: 11px;color: ' . $array_color_2[$a] . '">' . $key . ': ' . $value . ' Items(' . $porcen . '%)</span>, ';
                                        $a++;
                                    }
                                    ?>

                                    <div class="progress progress-striped active">
                                        <?php
                                        $b = 0;
                                        foreach ($total_NIVELRUBRICAS_unique as $key => $value) {
                                            $porcen = ($value * 100) / count($total_NIVELRUBRICAS);
                                            $porcen = round($porcen - 0.1, 0, PHP_ROUND_HALF_DOWN);
                                            ?>
                                            <div class="progress-bar progress-bar-<?php echo $array_color_1[$b]; ?>" style="width: <?php echo $porcen; ?>%">
                                                <span class="sr-only"></span>
                                            </div> 
                                            <?php
                                            $b++;
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                    echo "No se encontraron Items.";
                                }
                                ?>

                                <h4>Nivel de Dificultad Construido</h4>
                                <?php
                                if ($component->NIVELDIFICULTAD != '') {

                                    $total_NIVELDIFICULTAD = explode(',', $component->NIVELDIFICULTAD);
                                    $total_NIVELDIFICULTAD_unique = array_count_values($total_NIVELDIFICULTAD);

                                    $a = 0;
                                    foreach ($total_NIVELDIFICULTAD_unique as $key => $value) {
                                        $porcen = ($value * 100) / count($total_NIVELDIFICULTAD);
                                        $porcen = round($porcen);
                                        echo '<span style="font-size: 11px;color: ' . $array_color_2[$a] . '">' . get_niveldificultadname($key) . ': ' . $value . ' Items(' . $porcen . '%)</span>, ';
                                        $a++;
                                    }
                                    ?>

                                    <div class="progress progress-striped active">
                                        <?php
                                        $b = 0;
                                        foreach ($total_NIVELDIFICULTAD_unique as $key => $value) {
                                            $porcen = ($value * 100) / count($total_NIVELDIFICULTAD);
                                            $porcen = round($porcen - 0.1, 0, PHP_ROUND_HALF_DOWN);
                                            ?>
                                            <div class="progress-bar progress-bar-<?php echo $array_color_1[$b]; ?>" style="width: <?php echo $porcen; ?>%">
                                                <span class="sr-only"></span>
                                            </div> 
                                            <?php
                                            $b++;
                                        }
                                        ?>
                                    </div>                                   
                                    <?php
                                } else {
                                    echo "No se encontraron Items.";
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>              

            </td>             
        </tr>
        <?php
        $count++;
    }
    ?>
</table>

