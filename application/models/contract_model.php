<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contract_model extends CI_Model {

    public function get_all_contract($state = 1) {
        $Where = '';
        if ($state != 'ALL') {
            $Where = "AND CONTRATO_ESTADO=$state";
        }
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('contratos')} c, "
                . "{$this->db->dbprefix('hojasdevida')} h, "
                . "{$this->db->dbprefix('tipo_contrato')} t,
                    {$this->db->dbprefix('proyectos')} p
                      WHERE c.HV_ID = h.HV_ID AND t.TIPOCONTRATO_ID = c.TIPOCONTRATO_ID  AND p.PROYECTO_ID = c.PROYECTO_ID
                      $Where
                      ORDER BY h.HV_NOMBRES";
                   // echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_user_documento($username) {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('usuarios')}
                      WHERE HV_NUMERODOCUMENTO = '{$username}'
                      AND HV_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_typecontracts() {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('tipo_contrato')}
                      WHERE TIPOCONTRATO_ESTADO=1";

        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_cvs() {
        $sql_string = "SELECT HV_ID, CONCAT(HV_NOMBRES,' ',HV_APELLIDOS) HV_NOMBRES
                      FROM {$this->db->dbprefix('hojasdevida')}
                      WHERE HV_ESTADO=1";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_proyects() {
        $sql_string = "SELECT *
                      FROM {$this->db->dbprefix('proyectos')}
                      WHERE PROYECTO_ESTADO=1";
        $sql_query = $this->db->query($sql_string);
        return $sql_query->result();
    }

    public function get_contract_id_contract($id_contract) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('contratos')} c, "
                . "{$this->db->dbprefix('hojasdevida')} h, "
                . "{$this->db->dbprefix('tipo_contrato')} t,
                    {$this->db->dbprefix('proyectos')} p
                      WHERE c.HV_ID = h.HV_ID AND t.TIPOCONTRATO_ID = c.TIPOCONTRATO_ID  AND p.PROYECTO_ID = c.PROYECTO_ID
                      AND c.CONTRATO_ID = $id_contract
                      ORDER BY h.HV_NOMBRES";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_contractdocuments_id_contract($id_contract) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('contratos')} c, "
                . "{$this->db->dbprefix('proyectos')} p, "
                . "{$this->db->dbprefix('documento_co')} d, "
                . "{$this->db->dbprefix('tipo_documento')} t
                      WHERE c.CONTRATO_ID = $id_contract "
                . "AND d.CONTRATO_ID = c.CONTRATO_ID "
                . "AND p.PROYECTO_ID=c.PROYECTO_ID "
                . "AND t.TIPODOCUMENTO_ID = d.TIPODOCUMENTO_ID";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_document_contract($id_document) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('contratos')} c, "
                . "{$this->db->dbprefix('proyectos')} p, "
                . "{$this->db->dbprefix('documento_co')} d, "
                . "{$this->db->dbprefix('tipo_documento')} t
                      WHERE d.DOCUMENTOCO_ID = $id_document "
                . "AND d.CONTRATO_ID = c.CONTRATO_ID "
                . "AND p.PROYECTO_ID=c.PROYECTO_ID "
                . "AND t.TIPODOCUMENTO_ID = d.TIPODOCUMENTO_ID";
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

    public function insert_contract($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('contratos')}
                      (
                        HV_ID,
                        TIPOCONTRATO_ID,
                        PROYECTO_ID,
                        CONTRATO_FECHAINI,
                        CONTRATO_FECHAFIN,
                        CONTRATO_VALOR,
                        USUARIO_ID
                       )
                      VALUES
                       (
                        '{$data['HV_ID']}',
                        '{$data['TIPOCONTRATO_ID']}',
                        '{$data['PROYECTO_ID']}',
                        '{$data['CONTRATO_FECHAINI']}',
                        '{$data['CONTRATO_FECHAFIN']}',
                        '{$data['CONTRATO_VALOR']}',
                        '{$data['USUARIO_ID']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

    public function update_contract($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('contratos')} SET
                        TIPOCONTRATO_ID = '{$data['TIPOCONTRATO_ID']}',
                        HV_ID = '{$data['HV_ID']}',
                        CONTRATO_FECHAINI = '{$data['CONTRATO_FECHAINI']}',
                        CONTRATO_FECHAFIN = '{$data['CONTRATO_FECHAFIN']}',
                        CONTRATO_VALOR = '{$data['CONTRATO_VALOR']}',
                        PROYECTO_ID = '{$data['PROYECTO_ID']}',
                        CONTRATO_ESTADO = '{$data['CONTRATO_ESTADO']}'
                       WHERE
                       CONTRATO_ID = {$data['CONTRATO_ID']}
                       ";
        //echo $SQL_string;
        return $SQL_string_query = $this->db->query($SQL_string);
    }

    public function update_user_password($user_password, $id_user) {
        $SQL_string = "UPDATE {$this->db->dbprefix('usuarios')} SET
                       HV_PASSWORD = '{$user_password}'
                       WHERE
                       HV_ID = $id_user
                       ";
        return $SQL_string_query = $this->db->query($SQL_string);
    }

    public function get_typedocuments() {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('tipo_documento')} WHERE (TIPODOCUMENTO_TIPOCONSULTA=2 OR TIPODOCUMENTO_TIPOCONSULTA=0)";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_document($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('documento_co')}
                      (
                        CONTRATO_ID,
                        TIPODOCUMENTO_ID,
                        DOCUMENTOCO_OBSERVACION,
                        DOCUMENTOCO_IDCREADOR,
                        DOCUMENTOCO_NOMBRE
                       )
                      VALUES
                       (
                        '{$data['CONTRATO_ID']}',
                        '{$data['TIPODOCUMENTO_ID']}',
                        '{$data['DOCUMENTOCO_OBSERVACION']}',
                        '{$data['DOCUMENTOCO_IDCREADOR']}',
                        '{$data['DOCUMENTOCO_NOMBRE']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

}
