<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cut_model extends CI_Model {

    public function get_all_cuts() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('cortes')} c, "
                . "{$this->db->dbprefix('usuarios')} u "
                . "WHERE c.USUARIO_ID = u.USUARIO_ID";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_cut_id($CORTE_ID) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('cortes')} c, "
                . "{$this->db->dbprefix('usuarios')} u "
                . "WHERE c.USUARIO_ID = u.USUARIO_ID AND CORTE_ID=$CORTE_ID";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_cut($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('cortes')}
                      (
                       CORTE_NOMBREADMIN,  
                       CORTE_DIAPAGO,     
                       CORTE_DIAINICIO,
                       CORTE_DIAFIN,
                       USUARIO_ID
                       )
                      VALUES 
                       (
                       '{$data['CORTE_NOMBREADMIN']}',"
                . "'{$data['CORTE_DIAPAGO']}',"
                . "'{$data['CORTE_DIAINICIO']}',"
                . "'{$data['CORTE_DIAFIN']}',"
                . "'{$data['USUARIO_ID']}'    
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function update_cut($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('cortes')} SET
                       CORTE_NOMBREADMIN = '{$data['CORTE_NOMBREADMIN']}', 
                       CORTE_DIAPAGO = '{$data['CORTE_DIAPAGO']}',
                       CORTE_DIAINICIO = '{$data['CORTE_DIAINICIO']}',
                       CORTE_DIAFIN = '{$data['CORTE_DIAFIN']}',
                       CORTE_ESTADO = '{$data['CORTE_ESTADO']}'
                       WHERE
                       CORTE_ID = {$data['CORTE_ID']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

}
