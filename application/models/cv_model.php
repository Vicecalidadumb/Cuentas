<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all_cv($state = 1) {
        $Where = '';
        if ($state != 'ALL') {
            $Where = "AND HV_ESTADO=$state";
        }
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('hojasdevida')}
                      WHERE 1=1 $Where
                      ORDER BY HV_NOMBRES";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_documento($username) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_user_id_user($id_user) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_ID = $id_user";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_type_user() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('tipos_usuario')}
                      WHERE ACT_TIPO_USU = '1'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_user($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('usuarios')}
                      (
                        USUARIO_PASSWORD,
                        USUARIO_NOMBRES,
                        USUARIO_APELLIDOS,
                        USUARIO_TIPODOCUMENTO,
                        USUARIO_NUMERODOCUMENTO,
                        USUARIO_CORREO,
                        USUARIO_GENERO,
                        USUARIO_FECHADENACIMIENTO,
                        USUARIO_LUGARDENACIMIENTO,
                        USUARIO_DIRECCIONRESIDENCIA,
                        USUARIO_LUGARDERESIDENCIA,
                        USUARIO_TELEFONOFIJO,
                        USUARIO_CELULAR,
                        ID_TIPO_USU
                       )
                      VALUES 
                       (
                        '".make_hash($data['USUARIO_PASSWORD'])."',
                        '{$data['USUARIO_NOMBRES']}',
                        '{$data['USUARIO_APELLIDOS']}',
                        '{$data['USUARIO_TIPODOCUMENTO']}',
                        '{$data['USUARIO_NUMERODOCUMENTO']}',
                        '{$data['USUARIO_CORREO']}',
                        '{$data['USUARIO_GENERO']}',
                        '{$data['USUARIO_FECHADENACIMIENTO']}',
                        '{$data['USUARIO_LUGARDENACIMIENTO']}',
                        '{$data['USUARIO_DIRECCIONRESIDENCIA']}',
                        '{$data['USUARIO_LUGARDERESIDENCIA']}',
                        '{$data['USUARIO_TELEFONOFIJO']}',
                        '{$data['USUARIO_CELULAR']}',
                        '{$data['ID_TIPO_USU']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function update_user($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                        USUARIO_NOMBRES = '{$data['USUARIO_NOMBRES']}',
                        USUARIO_APELLIDOS = '{$data['USUARIO_APELLIDOS']}',
                        USUARIO_TIPODOCUMENTO = '{$data['USUARIO_TIPODOCUMENTO']}',
                        USUARIO_NUMERODOCUMENTO = '{$data['USUARIO_NUMERODOCUMENTO']}',
                        USUARIO_CORREO = '{$data['USUARIO_CORREO']}',
                        USUARIO_GENERO = '{$data['USUARIO_GENERO']}',
                        USUARIO_FECHADENACIMIENTO = '{$data['USUARIO_FECHADENACIMIENTO']}',
                        USUARIO_LUGARDENACIMIENTO = '{$data['USUARIO_LUGARDENACIMIENTO']}',
                        USUARIO_DIRECCIONRESIDENCIA = '{$data['USUARIO_DIRECCIONRESIDENCIA']}',
                        USUARIO_LUGARDERESIDENCIA = '{$data['USUARIO_LUGARDERESIDENCIA']}',
                        USUARIO_TELEFONOFIJO = '{$data['USUARIO_TELEFONOFIJO']}',
                        USUARIO_CELULAR = '{$data['USUARIO_CELULAR']}',
                        ID_TIPO_USU = '{$data['ID_TIPO_USU']}',
                        USUARIO_ESTADO = '{$data['USUARIO_ESTADO']}'    
                       WHERE
                       USUARIO_ID = {$data['USUARIO_ID']}
                       ";
                       //echo $SQL_string;
        return $SQL_string_query = $this->db->query($SQL_string);
    }
    
    public function update_user_password($user_password, $id_user){
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       USUARIO_PASSWORD = '{$user_password}'
                       WHERE
                       USUARIO_ID = $id_user
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);        
    }

}
