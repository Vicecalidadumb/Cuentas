<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pruebas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pruebas_model');
		$this->load->helper('miscellaneous');
    }

    public function asignar() {
        $institutos = $this->pruebas_model->get_institutos();
        //echo '<pre>'.print_r($institutos,true).'</pre>';

        $espacios = $this->pruebas_model->get_espacios();
        //echo '<pre>'.print_r($espacios,true).'</pre>';

        $array_espacios = array();

        $contador = 1;
        foreach ($espacios as $espacio) {
            for ($a = 1; $a <= $espacio->espacio_capacidad; $a++) {
                $array_espacios[$contador]['No'] = $contador;
                $array_espacios[$contador]['institucion_id'] = $espacio->institucion_id;
                $array_espacios[$contador]['espacio_id'] = $espacio->espacio_id;
                $array_espacios[$contador]['institucion_nombre'] = $espacio->institucion_nombre;
                $array_espacios[$contador]['espacio_aula'] = $espacio->espacio_aula;
                $array_espacios[$contador]['espacio_bloque'] = $espacio->espacio_bloque;
                $array_espacios[$contador]['espacio_piso'] = $espacio->espacio_piso;
                $array_espacios[$contador]['espacio_direccion'] = $espacio->espacio_direccion;
                $array_espacios[$contador]['puesto'] = $a;
                $contador++;
            }
        }

        shuffle($array_espacios);

        //echo '<pre>'.print_r($array_espacios,true).'</pre>';
        //----------------------------------------------------//----------------------------------------------------//

        $inscritos = $this->pruebas_model->get_inscritos();

        //echo '<pre>'.print_r($inscritos,true).'</pre>';

        $array_inscrito_espacio = array();

        $contador = 0;
        foreach ($inscritos as $inscrito) {
            $array_inscrito_espacio[$contador + 1]['espacio_id'] = $array_espacios[$contador]['espacio_id'];
            $array_inscrito_espacio[$contador + 1]['institucion_nombre'] = $array_espacios[$contador]['institucion_nombre'];
            $array_inscrito_espacio[$contador + 1]['espacio_aula'] = $array_espacios[$contador]['espacio_aula'];
            $array_inscrito_espacio[$contador + 1]['espacio_bloque'] = $array_espacios[$contador]['espacio_bloque'];
            $array_inscrito_espacio[$contador + 1]['espacio_piso'] = $array_espacios[$contador]['espacio_piso'];
            $array_inscrito_espacio[$contador + 1]['espacio_direccion'] = $array_espacios[$contador]['espacio_direccion'];
            $array_inscrito_espacio[$contador + 1]['puesto'] = $array_espacios[$contador]['puesto'];
            $array_inscrito_espacio[$contador + 1]['inscrito_cedula'] = $inscrito->inscrito_cedula;
            $array_inscrito_espacio[$contador + 1]['inscrito_nombre'] = $inscrito->inscrito_nombre;
            $array_inscrito_espacio[$contador + 1]['inscrito_pin'] = $inscrito->inscrito_pin;
            $array_inscrito_espacio[$contador + 1]['inscrito_id'] = $inscrito->inscrito_id;
            $contador++;
        }

        //echo '<pre>'.print_r($array_inscrito_espacio,true).'</pre>';
        echo "INSERT INTO umbpruebas_inscritos (inscrito_pin,inscrito_cedula,inscrito_nombre,espacio_id,puesto) VALUES <br>";
        foreach ($array_inscrito_espacio as $data) {
            //echo '<pre>'.print_r($data,true).'</pre>';
            $this->pruebas_model->asignar($data);
        }
    }

    public function vista() {
        $inscritos = $this->pruebas_model->get_inscritos_asignados();

        if (count($inscritos) > 0) {

            //header("Content-type: application/octet-stream; charset=UTF-8");
            //header("Content-Disposition: attachment; filename=pruebas.xls");
            header('Content-Type: text/html; charset=UTF-8');
            header("Pragma: no-cache");
            header("Expires: 0");
            ?>
            <table>
                <tr>
                    <td>No.</td>
                    <td>ID</td>
                    <td>INSTITUTO</td>
                    <td>AULA</td>
                    <td>BLOQUE</td>
                    <td>PISO</td>
                    <td>DIRECCION</td>
                    <td>PUESTO</td>
                    <td>CEDULA</td>
                </tr>
                <?php
                $a = 1;
                foreach ($inscritos as $inscrito) {
                    ?>
                    <tr>
                        <td><?php echo $a ?></td>
                        <td><?php echo $inscrito->espacio_id; ?></td>
                        <td><?php echo $inscrito->institucion_nombre; ?></td>
                        <td><?php echo $inscrito->espacio_aula; ?></td>
                        <td><?php echo $inscrito->espacio_bloque; ?></td>
                        <td><?php echo $inscrito->espacio_piso; ?></td>
                        <td><?php echo $inscrito->espacio_direccion; ?></td>
                        <td><?php echo $inscrito->puesto; ?></td>
                        <td><?php echo $inscrito->inscrito_cedula; ?></td>
                    </tr>                    
                    <?php
                    $a++;
                }
                ?>
            </table>
            <?php
        } else {
            echo "Sin Asignados";
        }
    }

    public function resultado($nombre = '') {
        $resultados = $this->pruebas_model->get_resultados($nombre);
        if (count($resultados) > 0) {
            //header("Content-type: application/octet-stream; charset=UTF-8");
            //header("Content-Disposition: attachment; filename=pruebas.xls");
            header('Content-Type: text/html; charset=UTF-8');
            header("Pragma: no-cache");
            header("Expires: 0");
            ?>
            <table border='1'>
                <tr>
                    <td>No.</td>
                    <td>CEDULA</td>
                    <td>NOMBRE</td>
                    <td>PRUEBA</td>
                    <td>EMPLEO</td>
                    <td>RESULTADO ORIGIAL</td>
                    <td>RESULTADO SISTEMA</td>
                    <td>VALIDACION</td>
                    <?php
                    for ($a = 0; $a < 100; $a++) {
                        ?>
                        <td><?php echo $a + 1; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                $count = 1;
                foreach ($resultados as $resultado) {
                    //VALIDAR RESULTADOS
                    $total_result = 0;
                    for ($a = 0; $a < 100; $a++) {
                        $Rnum = 'R' . ($a + 1);
                        $clave = $resultado->$Rnum;

                        $REnum = 'RE' . ($a + 1);
                        $result = $resultado->$REnum;

                        if ($clave == $result) {
                            if ($clave != '' && $result != '')
                                $total_result++;
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $resultado->RESULTADO_CEDULA; ?></td>
                        <td><?php echo $resultado->RESULTADO_NOMBRE; ?></td>
                        <td><?php echo $resultado->PRUEBA_NOMBRE; ?></td>
                        <td><?php echo $resultado->RESULTADO_EMPLEO; ?></td>
                        <td><?php echo $resultado->RESULTADO_TOTALORIGINAL; ?></td>
                        <td><?php echo $total_result; ?></td>
                        <td><?php echo ($resultado->RESULTADO_TOTALORIGINAL == $total_result) ? 'OK' : 'NO'; ?></td>
                <?php
                $total_result = 0;
                for ($a = 0; $a < 100; $a++) {
                    $total_result = 0;
                    $Rnum = 'R' . ($a + 1);
                    $clave = $resultado->$Rnum;

                    $REnum = 'RE' . ($a + 1);
                    $result = $resultado->$REnum;

                    if ($clave == $result) {
                        if ($clave != '' && $result != '')
                            $total_result = 1;
                    }
                    ?>
                            <td><?php echo $total_result; ?></td>
                            <?php
                        }
                        ?>						

                    </tr>                    
                        <?php
                        $count++;
                    }
                    ?>
            </table>
                <?php
            }else {
                echo "Sin Registros";
            }
        }
        
        public function claves() {
			//header("Content-type: application/octet-stream; charset=UTF-8");
			//header("Content-Disposition: attachment; filename=pruebas.xls");
			header('Content-Type: text/html; charset=UTF-8');
			header("Pragma: no-cache");
			header("Expires: 0");

			$pruebas = 	$this->pruebas_model->get_pruebas('ninguno');
			
			?>
                    <table border='1'>
                        <tr>
                            <td>PRUEBA</td>
                            <?php
                            for ($a = 0; $a < 100; $a++) {
                                ?>
                                <td><?php echo $a + 1; ?></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                        foreach ($pruebas as $prueba) {
                            ?>
                            <tr>
								<td>
									<?php echo $prueba->PRUEBA_NOMBRE; ?>
								</td>
                        	<?php
                        for ($a = 0; $a < 100; $a++) {

                            $Rnum = 'R' . ($a + 1);
                            $clave = $prueba->$Rnum;
                            ?>
                                    <td>
                                    	<?php
                                    	echo $clave;
                                    	?>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>
                                <?php
                            }

		}
        
        
        public function reporte1($nombre = 'ninguno') {
			//echo $nombre;
			$pruebas = 	$this->pruebas_model->get_pruebas($nombre);		
			//echo '<pre>'.print_r($pruebas,true).'</pre>';
			foreach ($pruebas as $prueba){
        	$resultados = $this->pruebas_model->get_resultados_2($prueba->PRUEBA_NOMBRE);
        	//echo '<pre>'.print_r($resultados,true).'</pre>';
        	if (count($resultados) > 0) {
        		header("Content-type: application/octet-stream; charset=UTF-8");
        		header("Content-Disposition: attachment; filename=pruebas.xls");
        		header('Content-Type: text/html; charset=UTF-8');
        		header("Pragma: no-cache");
        		header("Expires: 0");
        		?>
                    <table border='1'>
                        <tr>
                            <td>No.</td>
                            <td>CEDULA</td>
                            <td>NOMBRE</td>
                            <td>PRUEBA</td>
                            <td>EMPLEO</td>
                            <td>RESULTADO ORIGIAL</td>
                            <td>RESULTADO SISTEMA</td>
                            <td>VALIDACION</td>
                            <?php
                            for ($a = 0; $a < $resultados[0]->PRUEBA_PREGUNTAS; $a++) {
                                ?>
                                <td><?php echo $a + 1; ?></td>
                                <?php
                            }
                            ?>
                            <td>Resultado FINAL</td>
                        </tr>
                        <?php
                        $array_validacion = array();
                        $count = 1;
                        foreach ($resultados as $resultado) {
                            //VALIDAR RESULTADOS
                            $total_result = 0;
                            for ($a = 0; $a < 100; $a++) {
                                $Rnum = 'R' . ($a + 1);
                                $clave = $resultado->$Rnum;
        
                                $REnum = 'RE' . ($a + 1);
                                $result = $resultado->$REnum;
        
                                if ($clave == $result) {
                                    if ($clave != '' && $result != '')
                                        $total_result++;
                                }
                            }
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $resultado->RESULTADO_CEDULA; ?></td>
                                <td><?php echo $resultado->RESULTADO_NOMBRE; ?></td>
                                <td><?php echo $resultado->PRUEBA_NOMBRE; ?></td>
                                <td><?php echo $resultado->RESULTADO_EMPLEO; ?></td>
                                <td><?php echo $resultado->RESULTADO_TOTALORIGINAL; ?></td>
                                <td><?php echo $total_result; ?></td>
                                <td><?php echo ($resultado->RESULTADO_TOTALORIGINAL == $total_result) ? 'OK' : 'NO'; ?></td>
                        <?php
		                        $total_result = 0;
		                        $sumatoria_respuestas = 0;
		                        $preguntas = 0;
		                        for ($a = 0; $a < 100; $a++) {
		                            $total_result = 0;
		                            $Rnum = 'R' . ($a + 1);
		                            $clave = $resultado->$Rnum;
		        
		                            $REnum = 'RE' . ($a + 1);
		                            $result = $resultado->$REnum;
			        
		                            if($clave=='A' or $clave=='B' or $clave=='C' or $clave=='D'){
			                            if ($clave == $result) {
			                                if ($clave != '' && $result != ''){
			                                    $total_result = 1;
			                                	$sumatoria_respuestas++;
			                                }
			                            }
			                            $preguntas++;
			                         }
		                            ?>
                                    <td>
                                    	<?php 
                                    	@$array_validacion[$a]+= $total_result;
                                    	echo $total_result;
                                    	?>
                                    </td>
                                    <?php
                                }
                                ?>						
        						<td>
        							<?php
        							////MOSTRAR RESULTADO INDIVIDUAL
        							$valor_pregunta = 100/$preguntas;
        							$puntaje = $valor_pregunta*$sumatoria_respuestas;
        							echo $puntaje;
        							?>
        						</td>
                            </tr>
                                <?php
                                $count++;
                            }
                            
                            
                            
                            //////////////////////////////////////////////VALIDACION DE PREGUNTAS
                            ?>
                            
                            <tr>
                                <td colspan="8">VALIDACION (TOTAL DE RESPUESTAS EQUIVOCADAS)</td>
								<?php 
								for ($a = 0; $a < 100; $a++) {
									?>
									<td>
										<?php 
										$negativas = count($resultados)-$array_validacion[$a];
										echo $negativas.' de '.count($resultados); 
										?>										
									</td>
									<?php 
									}
                        		?>
                        		<td>.</td>
                            </tr>
                            
                            <tr>
                                <td colspan="8">PORCENTAJE</td>
								<?php 
								for ($a = 0; $a < 100; $a++) {
									?>
									<td>
										<?php 
										$negativas = count($resultados)-$array_validacion[$a];
										echo round(($negativas*100)/count($resultados),2).'%'; 
										?>										
									</td>
									<?php 
									}
                        		?>
                        		<td>.</td>
                            </tr>                            
                    </table>
                        <?php
                        //echo '<pre>'.print_r($array_validacion,true).'</pre>';
                        
                    }else {
                        echo "Sin Registros";
                    }
                }  

           }


        public function reporte2($prueba = 'ninguno') {
			set_time_limit(0);
			ini_set('memory_limit', '2000M');
			$MINIMO_PUNTAJE = 60;

			$this->load->library('My_PHPEXCEL');
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
				->setLastModifiedBy("Maarten Balliauw")
				->setTitle("Office 2007 XLSX Test Document")
				->setSubject("Office 2007 XLSX Test Document")
				->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
				->setKeywords("office 2007 openxml php")
				->setCategory("Test result file");
			////////////////////////////////////////////////////////////////////////////////////////////////
			
			//VARIABLE PARA ESTADISTICA
			$ARRAY_ESTADISTICA = array();
			
			$pruebas = 	$this->pruebas_model->get_pruebas($prueba);
			
			$count = 0;
			foreach ($pruebas as $prueba) {
				$count_letter_a = 1;
				$count_letter_b = 1;

				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['NOMBRE'] = $prueba->PRUEBA_NOMBRE;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['PASARON'] = 0;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['PASARON_ANTES'] = 0;

				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['5'] = 0;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['4'] = 0;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['3'] = 0;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['2'] = 0;
				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['1'] = 0;

				$objPHPExcel->createSheet(NULL, $count);

				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('A1', 'Hello');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('B2', 'world!');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('C1', 'Hello');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('D2', 'world!');
				
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '');
				$count_letter_a++;

				//ASIGNAR CLAVES AL ARCHIVO
				for ($a = 0; $a < 100; $a++) {
					$Rnum = 'R' . ($a + 1);
					$clave = $prueba->$Rnum;
					
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($a+1).' -> '.$clave);

					$colorcelda = '60E65C';
					if(strrpos($clave, '_A')==1)
						$colorcelda = 'F53F3F';

					//AGREGAR FORMATO A CELDA
					$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
							array(
								'type'       => PHPExcel_Style_Fill::FILL_SOLID,
								'startcolor' => array('rgb' => $colorcelda),
								'endcolor'   => array('rgb' => $colorcelda)
							)
						);
					//////
					$count_letter_a++;
				}
				
				//AGREGAR COLUMNA PARA GENERAR EL VALOR PREGUNTAS VALIDAS PARA LA PRUEBA
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PREGUNTAS VALIDAS');
				$count_letter_a++;
				//////				
				//AGREGAR COLUMNA PARA GENERAR EL VALOR DE CADA RESPUESTA BUENA
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'VALOR RESPUESTA OK');
				$count_letter_a++;	
				//////
				//AGREGAR COLUMNA PARA GENERAR EL TOTAL DE RESPUESTAS BUENAS
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'TOTAL RESPUESTAS OK');
				$count_letter_a++;
				//////		
				//AGREGAR COLUMNA PARA GENERAR EL TOTAL
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PUNTAJE');
				$count_letter_a++;
				//////
				//AGREGAR COLUMNA PARA MOSTRAR RESPUESTAS OK AL INICIO
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'ANTERIOR PUNTAJE');
				$count_letter_a++;
				//////
				
				$count_letter_b++;
				$count_letter_a = 1;
				

				//ASIGNAR RESPUESTA DE USUARIOS A ARCHIVOS
				$resultados = $this->pruebas_model->get_resultados_2($prueba->PRUEBA_NOMBRE);
				//echo '<pre>'.print_r($resultados,true).'</pre>';

				//VARIABLE ESTADISTICA
				$ARRAY_ESTADISTICA[$count]['PRESENTADOS'] = count($resultados);

				foreach ($resultados as $resultado) {
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->RESULTADO_CEDULA);
					$count_letter_a++;

                    
                    $sumatoria_respuestas_ok = 0;
                    $preguntas = 0;
					for ($a = 0; $a < 100; $a++) {
						$total_result = 0;
						
						$Rnum = 'R' . ($a + 1);
						$clave = $resultado->$Rnum;

						$REnum = 'RE' . ($a + 1);
						$result = $resultado->$REnum;
						
						//VALIDAR SI ES VERDADERA LA RESPUESTA
						$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;

						if(strrpos($clave, '_A')==0){
							if ($clave == $result) {
								if ($clave != '' && $result != ''){
									$total_result = 1;
									$sumatoria_respuestas_ok++;
								}
							}
							$preguntas++;
						}else{
							$clave = str_replace("_A",'',$clave);
							if ($clave == $result) {
								if ($clave != '' && $result != ''){
									$total_result = 1;
									//AGREGAR FORMATO A CELDA
									$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
											array(
												'type'       => PHPExcel_Style_Fill::FILL_SOLID,
												'startcolor' => array('rgb' => 'F53F3F'),
												'endcolor'   => array('rgb' => 'F53F3F')
											)
										);
									//////
								}
							}
						}
						
						$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $result.' - '.$total_result);					
						//$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $result);
						$count_letter_a++;
					}

					//AGREGAR COLUMNA PARA GENERAR EL VALOR PREGUNTAS VALIDAS PARA LA PRUEBA
						//VARIABLE ESTADISTICA
						$ARRAY_ESTADISTICA[$count]['PREGUNTAS_VALIDAS'] = $preguntas;
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $preguntas);
					$count_letter_a++;					
					/////
					//AGREGAR COLUMNA PARA GENERAR EL VALOR DE CADA RESPUESTA BUENA
					$valor_respuesta_ok = 100/$preguntas;
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $valor_respuesta_ok);
					$count_letter_a++;	
					//////
					//AGREGAR COLUMNA PARA GENERAR EL TOTAL DE RESPUESTAS BUENAS
		                switch ($sumatoria_respuestas_ok) {
		                    case ($sumatoria_respuestas_ok < 40):
		                        $ARRAY_ESTADISTICA[$count]['1']++;
		                        break;
		                    case ($sumatoria_respuestas_ok >= 40 && $sumatoria_respuestas_ok < 50):
		                        $ARRAY_ESTADISTICA[$count]['2']++;
		                        break;
		                    case ($sumatoria_respuestas_ok >= 50 && $sumatoria_respuestas_ok < 70):
		                        $ARRAY_ESTADISTICA[$count]['3']++;
		                        break;
		                    case ($sumatoria_respuestas_ok >= 70 && $sumatoria_respuestas_ok < 80):
		                        $ARRAY_ESTADISTICA[$count]['4']++;
		                        break;
		                    case ($sumatoria_respuestas_ok >= 80):
		                        $ARRAY_ESTADISTICA[$count]['5']++;
		                        break;
		                }
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $sumatoria_respuestas_ok);
					$count_letter_a++;
					//////	
					//AGREGAR COLUMNA PARA GENERAR EL TOTAL
					$total_puntaje = $valor_respuesta_ok*$sumatoria_respuestas_ok;
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;

					$colorceldatotal = 'F53F3F';
					if($total_puntaje>=$MINIMO_PUNTAJE){
						//VARIABLE ESTADISTICA
						$ARRAY_ESTADISTICA[$count]['PASARON']++;
						$colorceldatotal = '60E65C';
					}
					//AGREGAR FORMATO A CELDA
					$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
							array(
								'type'       => PHPExcel_Style_Fill::FILL_SOLID,
								'startcolor' => array('rgb' => $colorceldatotal),
								'endcolor'   => array('rgb' => $colorceldatotal)
							)
						);
					//////

					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $total_puntaje);
					$count_letter_a++;
					//////
					//AGREGAR COLUMNA PARA MOSTRAR RESPUESTAS OK AL INICIO
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;

					$colorceldaanterior = 'F53F3F';
					if($resultado->RESULTADO_TOTALORIGINAL>=$MINIMO_PUNTAJE){
						//VARIABLE ESTADISTICA
						$ARRAY_ESTADISTICA[$count]['PASARON_ANTES']++;
						$colorceldaanterior = '60E65C';
					}
					//AGREGAR FORMATO A CELDA
					$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
							array(
								'type'       => PHPExcel_Style_Fill::FILL_SOLID,
								'startcolor' => array('rgb' => $colorceldaanterior),
								'endcolor'   => array('rgb' => $colorceldaanterior)
							)
						);
					//////

					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->RESULTADO_TOTALORIGINAL);
					$count_letter_a++;
					//////

		            $count_letter_b++;
					$count_letter_a = 1;       
				}

				$objPHPExcel->getActiveSheet()->setTitle($prueba->PRUEBA_NOMBRE);
				$objPHPExcel->setActiveSheetIndex($count);
				$count++;
            }//FINAL DE CICLO PRUEBAS


			////ESTADISTICAS
			$objPHPExcel->createSheet(NULL, $count);
			$count_letter_a = 1;
			$count_letter_b = 1;
	
				//NOMBRE DE LA PRUEBA
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'NOMBRE');
				$count_letter_a++;
				//////
				//TOTAL ASPIRANTES
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PRESENTADOS');
				$count_letter_a++;
				//////
				//PREGUNTAS VALIDAS PARA LA PRUEBA
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PREGUNTAS VALIDAS');
				$count_letter_a++;
				//////
				//TOTAL PERSONAS PASARON
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'CON PUNTAJE >= '.$MINIMO_PUNTAJE);
				$count_letter_a++;
				//////
				//TOTAL PERSONAS PASARON AL INICIO
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'CON PUNTAJE >= '.$MINIMO_PUNTAJE.' AL INICIO');
				$count_letter_a++;
				//////
				//PORCENTAJE
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PORCENTAJE');
				$count_letter_a++;
				//////

				//BLANCO
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '');
				$count_letter_a++;
				//////

				//TOTAL NIVEL Superior
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Nivel Superior');
				$count_letter_a++;
				//////
				//% NIVEL Superior
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '%');
				$count_letter_a++;
				//////
				//TOTAL NIVEL Alto
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Nivel Alto');
				$count_letter_a++;
				//////
				//% NIVEL Alto
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '%');
				$count_letter_a++;
				//////
				//TOTAL NIVEL Medio
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Nivel Medio');
				$count_letter_a++;
				//////
				//% NIVEL Medio
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '%');
				$count_letter_a++;
				//////
				//TOTAL NIVEL Bajo
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Nivel Bajo');
				$count_letter_a++;
				//////
				//% NIVEL Bajo
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '%');
				$count_letter_a++;
				//////
				//TOTAL NIVEL Critico
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Nivel Critico');
				$count_letter_a++;
				//////
				//% NIVEL Critico
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '%');
				$count_letter_a++;
				//////

				$count_letter_a = 1;
				$count_letter_b++;

				foreach ($ARRAY_ESTADISTICA as $ESTADISTICA){
					//NOMBRE DE LA PRUEBA
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['NOMBRE']);
					$count_letter_a++;
					//////
					//TOTAL ASPIRANTES
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//PREGUNTAS VALIDAS PARA LA PRUEBA
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['PREGUNTAS_VALIDAS']);
					$count_letter_a++;
					//////
					//TOTAL PERSONAS PASARON
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['PASARON']);
					$count_letter_a++;
					//////
					//TOTAL PERSONAS PASARON AL INICIO
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['PASARON_ANTES']);
					$count_letter_a++;
					//////					
					//PORCENTAJE
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['PASARON']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//BLANCO
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '');
					$count_letter_a++;
					//////
	
					//TOTAL NIVEL Superior
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['5']);
					$count_letter_a++;
					//////
					//% NIVEL Superior
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['5']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//TOTAL NIVEL Alto
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['4']);
					$count_letter_a++;
					//////
					//% NIVEL Alto
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['4']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//TOTAL NIVEL Medio
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['3']);
					$count_letter_a++;
					//////
					//% NIVEL Medio
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['3']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//TOTAL NIVEL Bajo
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['2']);
					$count_letter_a++;
					//////
					//% NIVEL Bajo
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['2']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////
					//TOTAL NIVEL Critico
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $ESTADISTICA['1']);
					$count_letter_a++;
					//////
					//% NIVEL Critico
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, ($ESTADISTICA['1']*100)/$ESTADISTICA['PRESENTADOS']);
					$count_letter_a++;
					//////

					$count_letter_a = 1;		
					$count_letter_b++;
				}

			$objPHPExcel->getActiveSheet()->setTitle('ESTADISTICAS');
			$objPHPExcel->setActiveSheetIndex($count);
			////FIN ESTADISTICAS
		
			
			////////////////////////////////////////////////////////////////////////////////////////////////////
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="PRUEBAS_CATASTRO_REPORTESISTEMA1.xlsx"');
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header ('Cache-Control: cache, must-revalidate');
			header ('Pragma: public');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');			

		}
		
		public function reporte3($prueba = 'ninguno') {
			set_time_limit(0);
			ini_set('memory_limit', '2000M');
			$MINIMO_PUNTAJE = 60;
		
			$this->load->library('My_PHPEXCEL');
				
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
			->setLastModifiedBy("Maarten Balliauw")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");
			////////////////////////////////////////////////////////////////////////////////////////////////
				
			//VARIABLE PARA ESTADISTICA
			$ARRAY_ESTADISTICA = array();
				
			$pruebas = 	$this->pruebas_model->get_pruebas($prueba);
				
			$count = 0;
			$objPHPExcel->createSheet(NULL, $count);
			
			$count_letter_a = 1;
			$count_letter_b = 1;			
			
			foreach ($pruebas as $prueba) {

				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('A1', 'Hello');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('B2', 'world!');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('C1', 'Hello');
				//$objPHPExcel->setActiveSheetIndex($count)->setCellValue('D2', 'world!');
				
				//ASIGNAR RESPUESTA DE USUARIOS A ARCHIVOS
				$resultados = $this->pruebas_model->get_resultados_2($prueba->PRUEBA_NOMBRE);
				//echo '<pre>'.print_r($resultados,true).'</pre>';				
		
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PRESENTADOS EN LA  PRUEBA '.$prueba->PRUEBA_NOMBRE);
				$count_letter_a++;
				
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, count($resultados));
				$count_letter_a++;

				$count_letter_a = 1;
				$count_letter_b++;
		
		

				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'CEDULA');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'NOMBRE');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PRUEBA');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'EMPLEO');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'VACANTES');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'RESULTADO');
				$count_letter_a++;
				//////				
		
				$count_letter_b++;
				$count_letter_a = 1;
		

		
				foreach ($resultados as $resultado) {
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->RESULTADO_CEDULA);
					$count_letter_a++;
		
		
					$sumatoria_respuestas_ok = 0;
					$preguntas = 0;
					for ($a = 0; $a < 100; $a++) {
						$total_result = 0;
		
						$Rnum = 'R' . ($a + 1);
						$clave = $resultado->$Rnum;
		
						$REnum = 'RE' . ($a + 1);
						$result = $resultado->$REnum;
		
						//VALIDAR SI ES VERDADERA LA RESPUESTA
						$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
		
						if(strrpos($clave, '_A')==0){
							if ($clave == $result) {
								if ($clave != '' && $result != ''){
									$total_result = 1;
									$sumatoria_respuestas_ok++;
								}
							}
							$preguntas++;
						}else{
							$clave = str_replace("_A",'',$clave);
							if ($clave == $result) {
								if ($clave != '' && $result != ''){
									$total_result = 1;
									//AGREGAR FORMATO A CELDA
									/*
									$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
											array(
													'type'       => PHPExcel_Style_Fill::FILL_SOLID,
													'startcolor' => array('rgb' => 'F53F3F'),
													'endcolor'   => array('rgb' => 'F53F3F')
											)
									);*/
									//////
								}
							}
						}
	
					}
		
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->RESULTADO_NOMBRE);
					$count_letter_a++;

					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->PRUEBA_NOMBRE);
					$count_letter_a++;

					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $resultado->RESULTADO_EMPLEO);
					$count_letter_a++;

					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, '');
					$count_letter_a++;

					$valor_respuesta_ok = 100/$preguntas;

					$total_puntaje = $valor_respuesta_ok*$sumatoria_respuestas_ok;
					$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
		
					$colorceldatotal = 'F53F3F';
					if($total_puntaje>=$MINIMO_PUNTAJE){
						$colorceldatotal = '60E65C';
					}
					//AGREGAR FORMATO A CELDA
					$objPHPExcel->getActiveSheet()->getStyle($LETTER)->getFill()->applyFromArray(
							array(
									'type'       => PHPExcel_Style_Fill::FILL_SOLID,
									'startcolor' => array('rgb' => $colorceldatotal),
									'endcolor'   => array('rgb' => $colorceldatotal)
							)
					);
					//////
		
					$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $total_puntaje);
					$count_letter_a++;
		
					$count_letter_b++;
					$count_letter_a = 1;
				}
				$count_letter_b++;
				$count_letter_b++;
					

				//$count++;
			}//FINAL DE CICLO PRUEBAS
			
			$objPHPExcel->getActiveSheet()->setTitle('REPORTE2');
			$objPHPExcel->setActiveSheetIndex($count);		
		
				
			////////////////////////////////////////////////////////////////////////////////////////////////////
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="PRUEBAS_CATASTRO_REPORTESISTEMA2.xlsx"');
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header ('Cache-Control: cache, must-revalidate');
			header ('Pragma: public');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		
		}

		public function reporte4($type = 1) {
			set_time_limit(0);
			ini_set('memory_limit', '2000M');
			$MINIMO_PUNTAJE = 60;
			
			///////DATA
			$aspirantes = $this->pruebas_model->get_aspirantes();
			$array_empleos = array();
			$array_empleos_d = array();
			foreach ($aspirantes as $aspirante){
				@$array_empleos[$aspirante->RESULTADO_EMPLEO]++;
				$array_empleos_d[$aspirante->RESULTADO_EMPLEO]['denominacion'] = $aspirante->RESULTADO_DENOMINACION;
			}
			ksort($array_empleos);
			///////DATA
			
		
			$this->load->library('My_PHPEXCEL');
		
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
			->setLastModifiedBy("Maarten Balliauw")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");
			////////////////////////////////////////////////////////////////////////////////////////////////
		
			$count = 0;
			$objPHPExcel->createSheet(NULL, $count);
				
			$count_letter_a = 1;
			$count_letter_b = 1;
				
			$count_empleo = 1;
			$count_aspirante_2 = 0;
			foreach ($array_empleos as $key => $empleo){

				
              	
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'EMPLEO '/*.$count_empleo*/);
				$count_letter_a++;
		
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $key);
				$count_letter_a++;
				
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $array_empleos_d[$key]['denominacion']);
				$count_letter_a++;				
		
				$count_letter_a = 1;
				$count_letter_b++;
				
				
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'No.');
				$count_letter_a++;
				//////		
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'CEDULA');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'PUNTAJE');
				$count_letter_a++;
				//////
				$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
				$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'RESULTADO');
				$count_letter_a++;
				//////
		
				$count_letter_b++;
				$count_letter_a = 1;
				
		
				$count_aspirante_1 = 1;
				foreach ($aspirantes as $aspirante){

					if($aspirante->RESULTADO_EMPLEO == $key){

						//if($aspirante->RESULTADO_PUNTAJE_BYF>=$MINIMO_PUNTAJE){
						if($aspirante->RESULTADO_PUNTAJE_BYF<$MINIMO_PUNTAJE &&  $aspirante->RESULTADO_PUNTAJE_BYF!='AUSENTE'){
							$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
							$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $count_aspirante_1);
							$count_letter_a++;

							$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
							$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $aspirante->RESULTADO_CEDULA);
							$count_letter_a++;
				
							$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
							if($aspirante->RESULTADO_PUNTAJE_COM!='AUSENTE')
								$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, number_format($aspirante->RESULTADO_PUNTAJE_COM,2,',',','));
							else 
								$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, $aspirante->RESULTADO_PUNTAJE_COM);
							$count_letter_a++;
				
							$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
							$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'Aprobo');
							$count_letter_a++;
				
							$count_letter_b++;
							$count_letter_a = 1;
							
							$count_aspirante_1++;
							$count_aspirante_2++;
						}
					}
				}
				
				
				$count_letter_b++;
				$count_letter_b++;
					
		
				//$count++;
				$count_empleo++;
			}//FINAL DE CICLO PRUEBAS
			
			
			$LETTER = EXCEL_LETTER($count_letter_a).$count_letter_b;
			$objPHPExcel->setActiveSheetIndex($count)->setCellValue($LETTER, 'TOTAL ASPIRANTES '.$count_aspirante_2);
			$count_letter_a++;			
				
			$objPHPExcel->getActiveSheet()->setTitle('REPORTE3');
			$objPHPExcel->setActiveSheetIndex($count);
		
		
			////////////////////////////////////////////////////////////////////////////////////////////////////
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="PRUEBAS_CATASTRO_REPORTESISTEMA3.xlsx"');
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header ('Cache-Control: cache, must-revalidate');
			header ('Pragma: public');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		
		}	

    }
    