<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register_model extends CI_Model {
    
    public function get_all_departments() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('departamentos')} ORDER BY DEPARTAMENTO_NOMBRE";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }   
    
    public function get_all_cities($id_dep){
        $SQL_string = "SELECT CONCAT(DEPARTAMENTO_ID,MUNICIPIO_ID) MUNICIPIO_ID,MUNICIPIO_NOMBRE
                      FROM {$this->db->dbprefix('municipios')} "
                      . "WHERE DEPARTAMENTO_ID = $id_dep ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    public function get_all_calls(){
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('convocatorias')} "
                      . "WHERE CONVOCATORIA_ESTADO = 1 ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    public function get_user_convocatoria($document,$convocatoria){
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('inscripcion_pin')} "
                      . "WHERE USUARIO_NUMERODOCUMENTO =  '$document' "
                      . "AND CONVOCATORIA_ID = '$convocatoria' ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();         
    }
    
    public function insert_user($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('usuarios')}
                      (
                        USUARIO_TIPODOCUMENTO,
                        USUARIO_NOMBRES,
                        USUARIO_GENERO,
                        USUARIO_DIRECCIONRESIDENCIA,
                        USUARIO_TELEFONOFIJO,
                        USUARIO_CORREO,
                        USUARIO_NUMERODOCUMENTO,
                        USUARIO_APELLIDOS,
                        USUARIO_FECHADENACIMIENTO,
                        USUARIO_LUGARDENACIMIENTO,
                        USUARIO_LUGARDERESIDENCIA,
                        USUARIO_CELULAR
                       )
                      VALUES 
                       (
                        '{$data['USUARIO_TIPODOCUMENTO']}',
                        '{$data['USUARIO_NOMBRES']}',
                        '{$data['USUARIO_GENERO']}',
                        '{$data['USUARIO_DIRECCIONRESIDENCIA']}',
                        '{$data['USUARIO_TELEFONOFIJO']}',
                        '{$data['USUARIO_CORREO']}',
                        '{$data['USUARIO_NUMERODOCUMENTO']}',
                        '{$data['USUARIO_APELLIDOS']}',
                        '{$data['USUARIO_FECHADENACIMIENTO']}',
                        '{$data['USUARIO_LUGARDENACIMIENTO']}',
                        '{$data['USUARIO_LUGARDERESIDENCIA']}',
                        '{$data['USUARIO_CELULAR']}'
                        )";
        $insert = $this->db->query($SQL_string);
        $id_user = $this->db->insert_id();
        if($insert){
            $SQL_string_ins = "INSERT INTO {$this->db->dbprefix('inscripcion_pin')}
                      (
                        USUARIO_NUMERODOCUMENTO,
                        CONVOCATORIA_ID
                       )
                      VALUES 
                       (
                        '{$data['USUARIO_NUMERODOCUMENTO']}',
                        '{$data['CONVOCATORIA_ID']}'
                        )";
            $insert_ins = $this->db->query($SQL_string_ins);
            $pin = $this->db->insert_id();
            if($insert_ins){
               return $id_user;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }    
    
    public function get_user_inscription($id_user,$id_convocatoria){
        $SQL_string = "SELECT u.*,ip.*,c.*,
                      (
                      SELECT m.MUNICIPIO_NOMBRE 
                      FROM cargue_municipios m WHERE CONCAT(m.DEPARTAMENTO_ID,MUNICIPIO_ID) = u.USUARIO_LUGARDENACIMIENTO
                      ) USUARIO_LUGARDENACIMIENTO_N,
                      (
                      SELECT m.MUNICIPIO_NOMBRE 
                      FROM cargue_municipios m WHERE CONCAT(m.DEPARTAMENTO_ID,MUNICIPIO_ID) = u.USUARIO_LUGARDERESIDENCIA
                      ) USUARIO_LUGARDERESIDENCIA_N                      
                      FROM {$this->db->dbprefix('usuarios')} u,
                      {$this->db->dbprefix('inscripcion_pin')} ip,
                      {$this->db->dbprefix('convocatorias')} c
                      WHERE 
                      u.USUARIO_NUMERODOCUMENTO = ip.USUARIO_NUMERODOCUMENTO
                      AND ip.CONVOCATORIA_ID = c.CONVOCATORIA_ID
                      AND u.USUARIO_ID = '$id_user'
                      ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    ///////////////////////////////

    public function get_all_users($state = 1) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_ESTADO=$state
                      ORDER BY USUARIO_NOMBRES";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    
    public function get_all_users_rol($state = 1) {
        $SQL_string = "SELECT USUARIO_ID,CONCAT(u.USUARIO_NOMBRES,' - ',t.NOM_TIPO_USU) AS USUARIO_NOMBRES
                      FROM {$this->db->dbprefix('usuarios')} u,
                      {$this->db->dbprefix('tipos_usuario')} t
                      WHERE u.USUARIO_ESTADO=$state AND t.ID_TIPO_USU = u.ID_TIPO_USU
                      ORDER BY USUARIO_NOMBRES";
                      //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }    

    public function get_all_users_type($type_id) {
        $SQL_string = "SELECT *, CONCAT(USUARIO_NOMBRES,' ',USUARIO_APELLIDOS) AS NOMBRES_C
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_ESTADO = '1' AND ID_TIPO_USU = $type_id";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_id_user($id_user) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_ID = $id_user AND USUARIO_ESTADO = '1'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_username($user_username) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_NUMERODOCUMENTO = '{$user_username}'
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }
    
    public function get_user_loginpin($username,$pass){
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND USUARIO_ID = '{$pass}'  
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();        
    }
    
    public function get_user_documento($username){
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE USUARIO_NUMERODOCUMENTO = '{$username}'
                      AND USUARIO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();        
    }

    public function get_users_keyword($keyword) {
        $sql_string = "SELECT user_id AS id,CONCAT(user_fname,' ',user_lname) AS name
                      FROM {$this->db->dbprefix('users')}
                      WHERE user_fname LIKE '%{$keyword}%' ORDER BY user_fname";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_users_core_id($client_id) {
        $this->db_core = $this->load->database('core', TRUE);
        $sql_string = "SELECT 
                           c.client_id AS id,CONCAT(c.client_fname,' ',c.client_lname,' - ',c.client_id) AS name
                           FROM dna_clients c
                           WHERE 
                           c.client_id = '{$client_id}' ";
        $sql_query = $this->db_core->query($sql_string);
        return $sql_query->result();
    }

    public function get_users_core_keyword($keyword) {
        $this->db_core = $this->load->database('core', TRUE);


        if (strlen($keyword) > 6 && filter_var($keyword, FILTER_VALIDATE_INT) == true) {
            $sql_string = "SELECT 
                           c.client_id AS id,CONCAT(c.client_fname,' ',c.client_lname,' - ',c.client_id) AS name
                           FROM dna_clients c, dna_invoices i
                           WHERE 
                           i.client_id = c.client_id
                           AND
                           i.invoice_id LIKE '{$keyword}'   
                           GROUP BY c.client_id
                           ORDER BY c.client_fname 
                           LIMIT 10";
        } else {
            $sql_string = "SELECT 
                           client_id AS id,CONCAT(client_fname,' ',client_lname,' - ',client_id) AS name
                           FROM dna_clients
                           WHERE 
                           (
                           CONCAT(client_fname,' ',client_lname) LIKE '%{$keyword}%'
                           OR
                           client_id LIKE '%{$keyword}%'
                           OR
                           client_email LIKE '%{$keyword}%'
                           )    
                           ORDER BY client_fname LIMIT 10";
        }
        $sql_query = $this->db_core->query($sql_string);
        return $sql_query->result();
    }

    public function get_user_username_userid($user_username, $user_id) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('users')}
                      WHERE user_username = '{$user_username}'
                      AND user_id!={$user_id}";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_user($user_id) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')} u
                      JOIN {$this->db->dbprefix('tipos_usuario')} r ON r.ID_TIPO_USU = u.ID_TIPO_USU
                      WHERE USUARIO_ID = '{$user_id}'";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_email($user_mail) {

        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('users')}
                      WHERE user_mail = '{$user_mail}'";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_user_email_userid($user_mail, $user_id) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('users')}
                      WHERE user_mail = '{$user_mail}'
                      AND user_id!={$user_id}";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    /*     * *******************Roles******************************** */

    public function get_all_roles() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('tipos_usuario')}
                      WHERE ACT_TIPO_USU=1";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function update_user($data) {
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

    public function update_user_g_a($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('users')} SET
                       user_ga_secret = '{$data['user_ga_secret']}',
                       user_ga_googleurl = '{$data['user_ga_googleurl']}'
                       WHERE
                       user_id = {$data['user_id']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_user_image($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('users')} SET
                       user_photo = '{$data['user_photo']}'
                       WHERE
                       user_id = {$data['user_id']}
                       ";
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_user_password($new_password, $user_id) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       USUARIO_CLAVE='$new_password'
                       WHERE
                       USUARIO_ID='$user_id'
                       ";
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_user_notes($notes, $user_id) {
        $SQL_string = "UPDATE {$this->db->dbprefix('users')} SET
                       user_notes = '{$notes}'
                       WHERE
                       user_id = {$user_id}
                       ";
        $SQL_string_query = $this->db->query($SQL_string);
    }

    public function get_all_users_photo() {
        $SQL_string = " SELECT * 
       FROM {$this->db->dbprefix('users')} u ";
        $SQL_string_query = $this->db->query($SQL_string);
        $result = $SQL_string_query->result();
        $array_return = array();
        foreach ($result as $row) {
            $array_return[$row->user_id] = $row->user_photo;
        }
        return $array_return;
    }

    public function get_user_array_id($array) {
        $where = "WHERE ";
        foreach ($array as $values) {
            $where.="user_id = '$values->user_id' OR ";
        }
        $where = trim($where, 'OR ');
        $SQL_select = "SELECT u.*, r.role
                      FROM {$this->db->dbprefix('users')} u
                      JOIN {$this->db->dbprefix('roles')} r ON r.role_id = u.role_id 
                      $where
                      ";
        $sql_query = $this->db->query($SQL_select);
        $result = $sql_query->result();
        $array_return = array();
        foreach ($result as $row) {
            $array_return[$row->user_id] = $row->user_fname . ' ' . $row->user_lname;
        }
        return $array_return;
    }

    public function get_user_quotes_tracing() {
        $SQL_string = "SELECT user_id FROM yeico_users
           WHERE 
           role_id = 3 
           OR role_id = 4 
           OR role_id = 1
           OR role_id = 5
           OR role_id = 6
           OR role_id = 8
           OR role_id = 9
           ";
        $SQL_query = $this->db->query($SQL_string);
        return $SQL_query->result();
    }

    public function get_user_voice_mail() {
        $SQL_string = "SELECT user_id FROM yeico_users
           WHERE 
           role_id = 3 
           OR role_id = 4 
           OR role_id = 1
           OR role_id = 5
           OR role_id = 6
           OR role_id = 8
           OR role_id = 9
           ";
        $SQL_query = $this->db->query($SQL_string);
        return $SQL_query->result();
    }

}
