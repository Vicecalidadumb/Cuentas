<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pruebas_model extends CI_Model {

    public function get_institutos() {
        $SQL_string = "SELECT * FROM umbpruebas_instituciones";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_espacios() {
        $SQL_string = "SELECT * FROM umbpruebas_espacios e, umbpruebas_instituciones i "
                . "WHERE e.institucion_id = i.institucion_id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_inscritos() {
        $SQL_string = "SELECT * FROM umbpruebas_inscritos";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_inscritos_asignados() {
        $SQL_string = "SELECT * FROM umbpruebas_inscritos i, umbpruebas_espacios e, umbpruebas_instituciones ins"
                . " WHERE i.espacio_id = e.espacio_id AND ins.institucion_id = e.institucion_id ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function asignar($data) {
        $SQL_string = "( "
                . "'".$data['inscrito_pin']."',"
                . "'".$data['inscrito_cedula']."',"
                . "'".$data['inscrito_nombre']."',"
                . "'".$data['espacio_id']."',"
                . "'".$data['puesto']."'"
                . " ), ";
        
        echo $SQL_string.'<br>';
        //$SQL_string_query = $this->db->query($SQL_string);
        //return $SQL_string_query->result();
    }
	
	
    public function get_resultados($nombre) {
		$SQL = '';
		if($nombre!=''){
			$SQL = " AND P.PRUEBA_NOMBRE= '$nombre'";
		}
        $SQL_string = "SELECT * FROM catastro_pruebas P, catastro_resultado R
						WHERE P.PRUEBA_NOMBRE = R.PRUEBA_NOMBRE $SQL";
		//echo $SQL_string;				
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }	
    
    public function get_resultados_2($nombre) {
    	$SQL = '';
    	if($nombre!=''){
    		$SQL = " AND P.PRUEBA_NOMBRE= '$nombre'";
    	}
    	$SQL_string = "SELECT * FROM catastro_pruebas P, catastro_resultado R
    	WHERE P.PRUEBA_NOMBRE = R.PRUEBA_NOMBRE $SQL AND (r.RESULTADO_TOTALORIGINAL>0 OR RESULTADO_CEDULA='193333' )";
    	//echo $SQL_string;
    	$SQL_string_query = $this->db->query($SQL_string);
    	return $SQL_string_query->result();
    }

    public function get_pruebas($nombre) {
    	$SQL = ' WHERE 1=1  ';
    	if($nombre!='ninguno'){
    		$SQL.= " AND P.PRUEBA_NOMBRE= '$nombre'";
    	}
    	
    	/*
    	$SQL.= " AND (";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF40' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF60' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF10' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF66' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF37' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF24' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF08' OR";
    	$SQL.= " P.PRUEBA_NOMBRE = 'CABF07'";
    	$SQL.= " )";
    	*/
    	
    	//$SQL_string = "SELECT * FROM catastro_pruebas P $SQL AND P.PRUEBA_NOMBRE NOT LIKE '%COM%'";
    	$SQL_string = "SELECT * FROM catastro_pruebas P $SQL";
    	//echo $SQL_string;
    	$SQL_string_query = $this->db->query($SQL_string);
    	return $SQL_string_query->result();
    }
    
    
    public function get_aspirantes(){
    	$SQL_string = "SELECT * FROM catastro_resultado_final ORDER BY RESULTADO_PUNTAJE_COM DESC";
    	$SQL_string_query = $this->db->query($SQL_string);
    	return $SQL_string_query->result();    	
    }
    
    
	
	

}
