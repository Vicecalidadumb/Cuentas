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

    public function get_cv_id_cv($id_cv) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('hojasdevida')} h, {$this->db->dbprefix('municipios')} m
                      WHERE HV_ID = $id_cv AND CONCAT(m.DEPARTAMENTO_ID,m.MUNICIPIO_ID) = h.HV_LUGARDERESIDENCIA";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_cvdocuments_id_cv($id_cv) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('hojasdevida')} h, "
                . "{$this->db->dbprefix('municipios')} m, "
                . "{$this->db->dbprefix('documento_hv')} d, "
                . "{$this->db->dbprefix('tipo_documento')} t
                      WHERE h.HV_ID = $id_cv "
                . "AND CONCAT(m.DEPARTAMENTO_ID,m.MUNICIPIO_ID) = h.HV_LUGARDERESIDENCIA "
                . "AND d.HV_ID = h.HV_ID AND t.TIPODOCUMENTO_ID = d.TIPODOCUMENTO_ID";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_document_cv($id_document) {
        $SQL_string = "SELECT *
                      FROM {$this->db->dbprefix('hojasdevida')} h, "
                . "{$this->db->dbprefix('municipios')} m, "
                . "{$this->db->dbprefix('documento_hv')} d, "
                . "{$this->db->dbprefix('tipo_documento')} t
                      WHERE d.DOCUMENTOHV_ID = $id_document "
                . "AND CONCAT(m.DEPARTAMENTO_ID,m.MUNICIPIO_ID) = h.HV_LUGARDERESIDENCIA "
                . "AND d.HV_ID = h.HV_ID AND t.TIPODOCUMENTO_ID = d.TIPODOCUMENTO_ID";
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

    public function update_cv($data) {
        $SQL_string = "UPDATE {$this->db->dbprefix('hojasdevida')} SET
                        HV_NOMBRES = '{$data['HV_NOMBRES']}',
                        HV_APELLIDOS = '{$data['HV_APELLIDOS']}',
                        HV_TIPODOCUMENTO = '{$data['HV_TIPODOCUMENTO']}',
                        HV_NUMERODOCUMENTO = '{$data['HV_NUMERODOCUMENTO']}',
                        HV_CORREO = '{$data['HV_CORREO']}',
                        HV_GENERO = '{$data['HV_GENERO']}',
                        HV_FECHADENACIMIENTO = '{$data['HV_FECHADENACIMIENTO']}',
                        HV_LUGARDENACIMIENTO = '{$data['HV_LUGARDENACIMIENTO']}',
                        HV_DIRECCIONRESIDENCIA = '{$data['HV_DIRECCIONRESIDENCIA']}',
                        HV_LUGARDERESIDENCIA = '{$data['HV_LUGARDERESIDENCIA']}',
                        HV_TELEFONOFIJO = '{$data['HV_TELEFONOFIJO']}',
                        HV_CELULAR = '{$data['HV_CELULAR']}',
                        HV_ESTADO = '{$data['HV_ESTADO']}',
                        HV_PROFESION = '{$data['HV_PROFESION']}'
                       WHERE
                       HV_ID = {$data['HV_ID']}
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
                      FROM {$this->db->dbprefix('tipo_documento')}";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_document($data) {
        $SQL_string = "INSERT INTO {$this->db->dbprefix('documento_hv')}
                      (
                        HV_ID,
                        TIPODOCUMENTO_ID,
                        DOCUMENTOHV_OBSERVACION,
                        DOCUMENTOHV_IDCREADOR,
                        DOCUMENTOHV_NOMBRE
                       )
                      VALUES
                       (
                        '{$data['HV_ID']}',
                        '{$data['TIPODOCUMENTO_ID']}',
                        '{$data['DOCUMENTOHV_OBSERVACION']}',
                        '{$data['DOCUMENTOHV_IDCREADOR']}',
                        '{$data['DOCUMENTOHV_NOMBRE']}'
                       )
                       ";
        return $this->db->query($SQL_string);
    }

}
