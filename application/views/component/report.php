<?php

//echo '<pre>'.print_r($components,true).'</pre>';

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
				Numero de Preguntas
			</td>
			<td>
				Codigo de Pregunta
			</td>
		</tr>
<?php

foreach($components as $component){
	//echo $component->COMPONENTE_SIGLA.' - '.$component->COMPONENTE_NOMBRE.'<br>';
	for($a=0;$a<$component->COMPONENTE_PREGUNTAS;$a++){
		if($a==0){
			?>
				<tr>
					<td rowspan="<?php echo $component->COMPONENTE_PREGUNTAS; ?>">
						<?php echo $component->COMPONENTE_NOMBRE; ?>
					</td>	
					<td rowspan="<?php echo $component->COMPONENTE_PREGUNTAS; ?>">
						<?php echo $component->COMPONENTE_SIGLA; ?>
					</td>
					<td rowspan="<?php echo $component->COMPONENTE_PREGUNTAS; ?>">
						<?php echo $component->COMPONENTE_PREGUNTAS; ?>
					</td>						
					<td>
						<?php echo '2013255'.$component->COMPONENTE_SIGLA.'000'.($a+1); ?>
					</td>
				</tr>
			<?php		
		}else{
			?>
			<tr>
				<td>
					<?php echo '2013255'.$component->COMPONENTE_SIGLA.'000'.($a+1); ?>
				</td>
			</tr>	
			<?php	
		}		
	}
}
?>
</table>
<?php