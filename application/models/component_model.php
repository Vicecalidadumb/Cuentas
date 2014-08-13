<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component_model extends CI_Model {

    public function get_components() {
        $SQL_string = "SELECT c.*,
            
                        (
                        SELECT GROUP_CONCAT(CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS,': <strong>',t.NOM_TIPO_USU) SEPARATOR '</strong><br>') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u,
                        umbitems_tipos_usuario t
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND t.ID_TIPO_USU = u.ID_TIPO_USU
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ASIGNADOS,
                        
                        (
                        SELECT COUNT(p.PREGUNTA_ID) FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ITEMS,
                        
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELRUBRICA   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        NIVELRUBRICAS,
                        
                        (
                        SELECT  GROUP_CONCAT(PREGUNTA_NIVELDIFICULTAD   SEPARATOR ',')  FROM 
                        umbitems_preguntas p
                        WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        NIVELDIFICULTAD
                                              
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        COMPONENTE_ESTADO = '1'";
                        //echo $SQL_string;  
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }
    
    public function get_component_id($COMPONENTE_ID) {
        $SQL_string = "SELECT c.*,
                        (
                        SELECT GROUP_CONCAT(u.USUARIO_ID SEPARATOR ',') FROM 
                        umbitems_usuarios_componentes uc,
                        umbitems_usuarios u
                        WHERE uc.USUARIO_ID = u.USUARIO_ID
                        AND uc.COMPONENTE_ID = c.COMPONENTE_ID
                        )
                        ASIGNADOS       
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        c.COMPONENTE_ESTADO = '1' AND c.COMPONENTE_ID = $COMPONENTE_ID";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }    

    public function get_components_value($sigla) {
        $SQL_string = "SELECT *
                      FROM 
                        {$this->db->dbprefix('componentes')} c  
                      WHERE 
                        COMPONENTE_ESTADO = '1' AND COMPONENTE_SIGLA='$sigla'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user($id_user) {
        $SQL_string = "SELECT c.COMPONENTE_ID, 
                        CONCAT( 
                            c.COMPONENTE_NOMBRE, 
                            ' - ', 
                            c.COMPONENTE_SIGLA ,
                            ' - ITEMS ELABORADOS A LA FECHA:',
                            (
                                SELECT COUNT(PREGUNTA_ID)
                                FROM {$this->db->dbprefix('preguntas')} p
                                WHERE p.COMPONENTE_ID = c.COMPONENTE_ID
                            )
                        ) COMPONENTE_NOMBRE
                      FROM 
                        {$this->db->dbprefix('componentes')} c,
                        {$this->db->dbprefix('usuarios_componentes')} uc,
                        {$this->db->dbprefix('usuarios')} u    
                      WHERE 
                        c.COMPONENTE_ID = uc.COMPONENTE_ID
                        AND
                        uc.USUARIO_ID = u.USUARIO_ID
                        AND
                        u.USUARIO_ID = $id_user
                        AND
                        c.COMPONENTE_ESTADO = '1'";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id($id_component) {
        $SQL_string = "SELECT c.*,
                                (
                                SELECT COUNT(PREGUNTA_ID)
                                FROM {$this->db->dbprefix('preguntas')} p
                                WHERE p.COMPONENTE_ID = c.COMPONENTE_ID)
                                as TOTAL_ITEMS                     
                      FROM 
                        {$this->db->dbprefix('componentes')} c
                      WHERE 
                        c.COMPONENTE_ID = $id_component
                        AND
                        c.COMPONENTE_ESTADO = '1'";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_components_id_user_id_component($id_user, $id_component) {
        $where = '';
        if ($id_component == 'ALL') {
            $where = '';
        } else {
            $where = " AND COMPONENTE_ID = $id_component";
        }
        $SQL_string = "SELECT *
                      FROM 
                        {$this->db->dbprefix('usuarios_componentes')} 
                      WHERE 
                        USUARIO_ID = $id_user
                        $where   
                        ";
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_component($data) {
        $SQL_string = "INSERT IGNORE  INTO {$this->db->dbprefix('componentes')}
                      (
                       COMPONENTE_NOMBRE,  
                       COMPONENTE_SIGLA,     
                       COMPONENTE_ESTADO,
                       COMPONENTE_PREGUNTAS
                       )
                      VALUES 
                       (
                       '{$data['COMPONENTE_NOMBRE']}',"
                        . "'{$data['COMPONENTE_SIGLA']}',"
                        . "'{$data['COMPONENTE_ESTADO']}',"
                        . "'{$data['COMPONENTE_PREGUNTAS']}'
                       )
                       ";
        if ($this->db->query($SQL_string)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function insert_component_users($data, $COMPONENTE_ID) {
        if (count($data['USUARIO_IDs']) > 0) {
            
            $this->db->query("DELETE FROM {$this->db->dbprefix('usuarios_componentes')} WHERE COMPONENTE_ID = '{$COMPONENTE_ID}' ");
            
            for ($a = 0; $a < count($data['USUARIO_IDs']); $a++) {
                $SQL_string_2 = "INSERT INTO {$this->db->dbprefix('usuarios_componentes')}
                                    (
                                     COMPONENTE_ID,  
                                     USUARIO_ID
                                     )
                                    VALUES 
                                     (
                                     '{$COMPONENTE_ID}','" . $data['USUARIO_IDs'][$a] . "'
                                     );
                                     ";
                $this->db->query($SQL_string_2);
            }
        }
    }
    
    public function update_component($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('componentes')} SET
                       COMPONENTE_NOMBRE = '{$data['COMPONENTE_NOMBRE']}', 
                       COMPONENTE_SIGLA = '{$data['COMPONENTE_SIGLA']}',  
                       COMPONENTE_ESTADO = '{$data['COMPONENTE_ESTADO']}',
                       COMPONENTE_PREGUNTAS= '{$data['COMPONENTE_PREGUNTAS']}'
                       WHERE
                       COMPONENTE_ID = {$data['COMPONENTE_ID']}
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);       
    }    

}
