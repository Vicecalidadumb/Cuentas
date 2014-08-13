<?php
//echo '<pre>'.print_r($components,true).'</pre>';

$array_items = array();
$array_components = array();
$rand_keys_component = array();
$rand_keys_items = array();

foreach ($components as $component) {
    //echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
    for ($a = 0; $a < $component->COMPONENTE_PREGUNTAS; $a++) {
        $array_items[] = '2013255' . $component->COMPONENTE_SIGLA . '000' . ($a + 1);
        $array_components[] = $component->COMPONENTE_SIGLA;
    }
}


//echo count($array_items) . '<br>';

$rand_keys = array_rand($array_items, $var_random);

echo '<h1>Items Random (' . $var_random . '):</h1>';

//echo '<pre>' . print_r($rand_keys, true) . '</pre>';

for ($a = 0; $a < count($rand_keys); $a++) {
    echo "<strong>ITEM " . ($a + 1) . ':</strong> ' . $array_items[$rand_keys[$a]] . '<br>';
    //echo $array_components[$rand_keys[$a]]. '<br>';
    if (!isset($rand_keys_component[$array_components[$rand_keys[$a]]]))
        $rand_keys_component[$array_components[$rand_keys[$a]]] = 0;
    $rand_keys_component[$array_components[$rand_keys[$a]]] ++;

    if (!isset($rand_keys_items[$array_items[$rand_keys[$a]]]))
        $rand_keys_items[$array_items[$rand_keys[$a]]] = 1;
}

echo '<h1>Componentes Random (' . count($rand_keys_component) . '):</h1>';
echo '<pre>' . print_r($rand_keys_component, true) . '</pre>';
?>
<table border="1">
    <tr>
        <td>
            Componente
        </td>
        <td>
            Sigla
        </td>
        <td>
            Numero de Preguntas random
        </td>
        <td>
            Codigo de Pregunta
        </td>
    </tr>
    <?php
    $count_item = 0;
    foreach ($rand_keys_component as $key => $key_component) {

        //echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
        for ($a = 0; $a < $key_component; $a++) {

            //if(isset($rand_keys[$a]))
            if ($a == 0) {
                ?>
                <tr>
                    <td rowspan="<?php echo $key_component; ?>">
                        <?php echo get_component_name($key); ?>
                    </td>	
                    <td rowspan="<?php echo $key_component; ?>">
                        <?php echo $key; ?>
                    </td>
                    <td rowspan="<?php echo $key_component; ?>">
                        <?php echo $key_component; ?>
                    </td>						
                    <td>
                        <?php echo $array_items[$rand_keys[$count_item]]; ?>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td>
                        <?php echo $array_items[$rand_keys[$count_item]]; ?>
                    </td>
                </tr>	
                <?php
            }
            $count_item++;
        }
    }
    ?>
</table>
<?php
echo '<h1>Items Totales:</h1>';
echo '<pre>' . print_r($array_items, true) . '</pre>';
