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

    public function insert_cut($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('usuarios')}
                      (
                       USUARIO_NOMBRES,  
                       USUARIO_APELLIDOS,     
                       USUARIO_TIPODOCUMENTO,
                       USUARIO_NUMERODOCUMENTO,     
                       USUARIO_CORREO,     
                       USUARIO_CLAVE,
                       ID_TIPO_USU
                       )
                      VALUES 
                       (
                       '{$data['USUARIO_NOMBRES']}',"
                . "'{$data['USUARIO_APELLIDOS']}',"
                . "'{$data['USUARIO_TIPODOCUMENTO']}',"
                . "'{$data['USUARIO_NUMERODOCUMENTO']}',"
                . "'{$data['USUARIO_CORREO']}',"
                . "'{$data['USUARIO_CLAVE']}',"
                . "'{$data['ID_TIPO_USU']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function update_cut($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       USUARIO_NOMBRES = '{$data['USUARIO_NOMBRES']}', 
                       USUARIO_APELLIDOS = '{$data['USUARIO_APELLIDOS']}',
                       USUARIO_TIPODOCUMENTO = '{$data['USUARIO_TIPODOCUMENTO']}',
                       USUARIO_NUMERODOCUMENTO = '{$data['USUARIO_NUMERODOCUMENTO']}',    
                       USUARIO_CORREO = '{$data['USUARIO_CORREO']}',
                       ID_TIPO_USU = '{$data['ID_TIPO_USU']}'
                       WHERE
                       USUARIO_ID = {$data['USUARIO_ID']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

}
