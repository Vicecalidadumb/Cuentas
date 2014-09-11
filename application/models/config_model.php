<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_model extends CI_Model {

    //////////////////////////////MODELOS DE PERMISOS DE ROLES


    public function get_roles() {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('tipos_usuario')}";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_role($role_id) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('tipos_usuario')}
                      WHERE ID_TIPO_USU = {$role_id}";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_rol_permissions($id_rol, $key = 'ID_MODULO') {
        //DEFINIMOS VARIABLES
        $array_modules = array();
        $array_permissions = array();
        //==>   1) CONSULTAMOS TODOS LOS MODULOS REGISTRADOS
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('modulos')}";
        $sql_query = $this->db->query($sql_string);

        foreach ($sql_query->result() as $row) {
            $array_modules[$row->$key]['name'] = $row->NOM_MODULO;
            $array_modules[$row->$key]['id'] = $row->ID_MODULO;
            $array_permissions = array();

            //==>   2) CONSULTAMOS LOS PERMISOS DEL ROL POR CADA MODULO
            $sql_string2 = "SELECT *
                           FROM {$this->db->dbprefix('modulos_tipos')}
                           WHERE
                           ID_MODULO = {$row->ID_MODULO} AND
                           ID_TIPO_USU = {$id_rol}
                           ";
            $sql_query2 = $this->db->query($sql_string2);
            //==>   3) SI NO HAY REGISTROS, A��ADIMOS LOS PERMISOS EN 0
            if ($sql_query2->num_rows() == 0) {
                $sql_insert = "INSERT INTO {$this->db->dbprefix('modulos_tipos')}(
                                   ID_MODULO,  ID_TIPO_USU,    CONSULTAR,
                                   GUARDAR, 	ACTUALIZAR,    ELIMINAR
                                   )VALUES(
                                   {$row->ID_MODULO},  {$id_rol},  0,
                                   0,  0,  0
                                   )";
                $this->db->query($sql_insert);
                $array_permissions['permission_view'] = 0;
                $array_permissions['permission_add'] = 0;
                $array_permissions['permission_edit'] = 0;
                $array_permissions['permission_delete'] = 0;
            } else {
                $data = $sql_query2->result_array();
                $array_permissions['permission_view'] = $data[0]['CONSULTAR'];
                $array_permissions['permission_add'] = $data[0]['GUARDAR'];
                $array_permissions['permission_edit'] = $data[0]['ACTUALIZAR'];
                $array_permissions['permission_delete'] = $data[0]['ELIMINAR'];
            }
            $array_modules[$row->$key]['permissions'] = $array_permissions;
        }
        return $array_modules;
    }

    public function update_roles($data) {
        //==>   1) CONSULTAMOS TODOS LOS MODULOS REGISTRADOS
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('modulos')}";
        $sql_query = $this->db->query($sql_string);
        foreach ($sql_query->result() as $row) {
            $permission_view = (isset($data['data']['permission_view_' . $row->ID_MODULO]) && $data['data']['permission_view_' . $row->ID_MODULO] == 1) ? '1' : '0';
            $permission_add = (isset($data['data']['permission_add_' . $row->ID_MODULO]) && $data['data']['permission_add_' . $row->ID_MODULO] == 1) ? '1' : '0';
            $permission_edit = (isset($data['data']['permission_edit_' . $row->ID_MODULO]) && $data['data']['permission_edit_' . $row->ID_MODULO] == 1) ? '1' : '0';
            $permission_delete = (isset($data['data']['permission_delete_' . $row->ID_MODULO]) && $data['data']['permission_delete_' . $row->ID_MODULO] == 1) ? '1' : '0';

            $SQL_string = "UPDATE {$this->db->dbprefix('modulos_tipos')} SET
                           CONSULTAR = '{$permission_view}',
                           GUARDAR = '{$permission_add}',
                           ACTUALIZAR = '{$permission_edit}',
                           ELIMINAR = '{$permission_delete}'
                           WHERE ID_MODULO = '{$row->ID_MODULO}' AND
                           ID_TIPO_USU = '{$data['rol_id']}'";
            //echo $SQL_string.'<br>';
            $this->db->query($SQL_string);
        }
    }

}
