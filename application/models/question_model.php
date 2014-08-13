<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_model extends CI_Model {

    public function get_questions($id_component, $id_user, $KEY_AES, $GROUPBY) {
        $WHERE = '';
        if ($id_component == "ALL") {
            $WHERE.= '';
        } else {
            $WHERE.= " AND p.COMPONENTE_ID = '$id_component' ";
        }
        if ($id_user != 'ALL') {
            $WHERE.= " AND p.USUARIO_ID = '$id_user' ";
        }
        if ($GROUPBY == 1) {
            $WHERE.= 'GROUP BY p.PREGUNTA_ID';
        }

        $SQL_string = "SELECT 
                        p.PREGUNTA_ID,
                        p.PREGUNTA_TEMA,
                        p.PREGUNTA_NIVELRUBRICA,
                        p.PREGUNTA_TIPOITEM,
                        p.PREGUNTA_NIVELDIFICULTAD,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        p.PREGUNTA_ESTADO,
                        p.PREGUNTA_ETAPA,
                        p.PREGUNTA_FECHADECREACION,
                        
                        p.COMPONENTE_ID,
                        p.USUARIO_ID,
                        
                        r.RESPUESTA_ID,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION,
                        r.RESPUESTA_ESTADO,
                        r.RESPUESTA_FECHADECREACION,
                        r.USUARIO_ID,
                        r.PREGUNTA_ID,
                        
                        CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS) AS PERSONA_CARGO,
                        c.COMPONENTE_NOMBRE,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V1
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=1
                        ) AS V1,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V2
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=2
                        ) AS V2,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V3
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=3
                        ) AS V3,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V4
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=4
                        ) AS V4,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V5
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=5
                        ) AS V5

                      FROM 
                            {$this->db->dbprefix('preguntas')} p,
                            {$this->db->dbprefix('respuestas')} r,
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE 
                            p.PREGUNTA_ID = r.PREGUNTA_ID
                            AND
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            $WHERE
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function get_question($id_question, $KEY_AES) {
        $SQL_string = "SELECT
                        p.PREGUNTA_ID,
                        p.PREGUNTA_TEMA,
                        p.PREGUNTA_NIVELRUBRICA,
                        p.PREGUNTA_TIPOITEM,
                        p.PREGUNTA_NIVELDIFICULTAD,
                        AES_DECRYPT(p.PREGUNTA_ENUNCIADO,'{$KEY_AES}') PREGUNTA_ENUNCIADO,
                        AES_DECRYPT(p.PREGUNTA_IDRESPUESTA,'{$KEY_AES}') PREGUNTA_IDRESPUESTA,
                        AES_DECRYPT(p.PREGUNTA_OBSERVACIONES,'{$KEY_AES}') PREGUNTA_OBSERVACIONES,
                        p.PREGUNTA_ESTADO,
                        p.PREGUNTA_ETAPA,
                        p.PREGUNTA_FECHADECREACION,
                        
                        p.COMPONENTE_ID,
                        p.USUARIO_ID,
                        
                        r.RESPUESTA_ID,
                        AES_DECRYPT(r.RESPUESTA_ENUNCIADO,'{$KEY_AES}') RESPUESTA_ENUNCIADO,
                        AES_DECRYPT(r.RESPUESTA_JUSTIFICACION,'{$KEY_AES}') RESPUESTA_JUSTIFICACION,
                        r.RESPUESTA_ESTADO,
                        r.RESPUESTA_FECHADECREACION,
                        r.USUARIO_ID,
                        r.PREGUNTA_ID,
                        
                        CONCAT(u.USUARIO_NOMBRES,' ',u.USUARIO_APELLIDOS) AS PERSONA_CARGO,
                        c.COMPONENTE_NOMBRE,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V1
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=1
                        ) AS V1,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V2
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=2
                        ) AS V2,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V3
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=3
                        ) AS V3,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V4
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=4
                        ) AS V4,
                        
                        (
                        SELECT ROUND(AVG(EVALUACION_PUNTUACION),1) AS V5
                        FROM {$this->db->dbprefix('evaluacion')} e
                        WHERE e.PREGUNTA_ID = p.PREGUNTA_ID AND e.TIPOEVALUACION_ID=5
                        ) AS V5
                        
                      FROM
                            {$this->db->dbprefix('preguntas')} p,
                            {$this->db->dbprefix('respuestas')} r,
                            {$this->db->dbprefix('usuarios')} u,
                            {$this->db->dbprefix('componentes')} c
                      WHERE 
                            p.PREGUNTA_ID = r.PREGUNTA_ID
                            AND
                            p.PREGUNTA_ID = '$id_question'
                            AND
                            u.USUARIO_ID = p.USUARIO_ID
                            AND
                            c.COMPONENTE_ID = p.COMPONENTE_ID
                            ";
        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();
    }

    public function insert_question($data, $KEY_AES) {
        $PREGUNTA_ID = 0;

        $SQL_string = "INSERT INTO {$this->db->dbprefix('preguntas')}
                      (
                       PREGUNTA_TEMA,
                       PREGUNTA_NIVELRUBRICA,
                       PREGUNTA_TIPOITEM,
                       PREGUNTA_NIVELDIFICULTAD,
                       PREGUNTA_ENUNCIADO,
                       PREGUNTA_OBSERVACIONES,
                       PREGUNTA_ESTADO,
                       PREGUNTA_ETAPA,
                       PREGUNTA_FECHADECREACION,
                       COMPONENTE_ID,
                       USUARIO_ID
                       )
                      VALUES 
                       (
                       '" . addslashes($data['PREGUNTA_TEMA']) . "',
                       '{$data['PREGUNTA_NIVELRUBRICA']}',
                       '{$data['PREGUNTA_TIPOITEM']}',
                       '{$data['PREGUNTA_NIVELDIFICULTAD']}',
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_ENUNCIADO']) . "','{$KEY_AES}'),
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_OBSERVACIONES']) . "','{$KEY_AES}'),
                       '1',
                       '{$data['PREGUNTA_ETAPA']}',
                       '{$data['PREGUNTA_FECHADECREACION']}',
                       '{$data['COMPONENTE_ID']}',
                       '{$data['USUARIO_ID']}'
                       )
                       ";
        $return = $this->db->query($SQL_string);
        $PREGUNTA_ID = $this->db->insert_id();

        if ($PREGUNTA_ID != 0) {
            for ($a = 1; $a <= 4; $a++) {
                $SQL_string_respuestas = "INSERT INTO {$this->db->dbprefix('respuestas')}
                          (
                           RESPUESTA_ENUNCIADO,
                           RESPUESTA_JUSTIFICACION,
                           RESPUESTA_ESTADO,
                           USUARIO_ID,
                           PREGUNTA_ID
                           )
                          VALUES 
                           (
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_JUSTIFICACION_' . $a]) . "','{$KEY_AES}'),
                           '1',
                           '{$data['USUARIO_ID']}',
                           '{$PREGUNTA_ID}'
                           )
                           ";
                $this->db->query($SQL_string_respuestas);
                if ($data['PREGUNTA_IDRESPUESTA'] == $a) {
                    $RESPUESTA_ID = $this->db->insert_id();
                    $this->db->query("UPDATE {$this->db->dbprefix('preguntas')} "
                            . " SET PREGUNTA_IDRESPUESTA = AES_ENCRYPT('{$RESPUESTA_ID}','{$KEY_AES}')  "
                            . " WHERE PREGUNTA_ID=$PREGUNTA_ID");
                }
            }
        }

        return $PREGUNTA_ID;
    }

    public function update_question($data, $KEY_AES) {

        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "UPDATE {$this->db->dbprefix('preguntas')} SET
                       PREGUNTA_TEMA = '" . addslashes($data['PREGUNTA_TEMA']) . "',
                       PREGUNTA_NIVELRUBRICA = '{$data['PREGUNTA_NIVELRUBRICA']}',
                       PREGUNTA_TIPOITEM = '{$data['PREGUNTA_TIPOITEM']}',
                       PREGUNTA_ETAPA = '{$data['PREGUNTA_ETAPA']}',
                       PREGUNTA_NIVELDIFICULTAD = '{$data['PREGUNTA_NIVELDIFICULTAD']}',
                       PREGUNTA_FECHADECREACION = '{$data['PREGUNTA_FECHADECREACION']}',
                       PREGUNTA_ENUNCIADO = AES_ENCRYPT('" . addslashes($data['PREGUNTA_ENUNCIADO']) . "','{$KEY_AES}'),
                       PREGUNTA_OBSERVACIONES = AES_ENCRYPT('" . addslashes($data['PREGUNTA_OBSERVACIONES']) . "','{$KEY_AES}')
                       WHERE
                       PREGUNTA_ID = {$data['PREGUNTA_ID']}
                       ";
        //echo '<textarea>'.$SQL_string.'</textarea>';
        $return = $SQL_string_query = $this->db->query($SQL_string);

        for ($a = 1; $a <= 4; $a++) {
            $RESPUESTA_ID = $data['question'][$a - 1]->RESPUESTA_ID;

            $SQL_string_respuestas = "UPDATE {$this->db->dbprefix('respuestas')} SET
                       RESPUESTA_ENUNCIADO = AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                       RESPUESTA_JUSTIFICACION = AES_ENCRYPT('" . addslashes($data['RESPUESTA_JUSTIFICACION_' . $a]) . "','{$KEY_AES}')
                       WHERE
                       RESPUESTA_ID = {$RESPUESTA_ID}
                       ";
            $this->db->query($SQL_string_respuestas);

            if ($data['PREGUNTA_IDRESPUESTA'] == $a) {
                $RESPUESTA_ID = $RESPUESTA_ID;
                $this->db->query("UPDATE {$this->db->dbprefix('preguntas')} "
                        . " SET PREGUNTA_IDRESPUESTA = AES_ENCRYPT('{$RESPUESTA_ID}','{$KEY_AES}')  "
                        . " WHERE PREGUNTA_ID={$data['PREGUNTA_ID']}");
            }
        }
        return $return;
    }
    
    public function update_question_modify($data, $KEY_AES) {
        
        $this->db->query("DELETE FROM {$this->db->dbprefix('pregunta_modificacion')} WHERE PREGUNTA_ID='{$data['PREGUNTA_ID']}' ");

        //echo '<pre>' . print_r($data['question'], true) . '</pre>';
        $SQL_string = "INSERT INTO {$this->db->dbprefix('pregunta_modificacion')}
                      (
                       PREGUNTA_MODIFICACION_ENUNCIADO,
                       PREGUNTA_MODIFICACION_OBSERVACIONES,
                       PREGUNTA_MODIFICACION_FECHA,
                       PREGUNTA_MODIFICACION_IDUSUARIOCREADOR,
                       PREGUNTA_ID
                       )
                      VALUES 
                       (
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_MODIFICACION_ENUNCIADO']) . "','{$KEY_AES}'),
                       AES_ENCRYPT('" . addslashes($data['PREGUNTA_MODIFICACION_OBSERVACIONES']) . "','{$KEY_AES}'),
                       '{$data['PREGUNTA_MODIFICACION_FECHA']}',
                       '{$data['PREGUNTA_MODIFICACION_IDUSUARIOCREADOR']}',
                       '{$data['PREGUNTA_ID']}'    
                       )
                       ";
        $return = $this->db->query($SQL_string);
        //echo '<textarea>'.$SQL_string.'</textarea>';

        for ($a = 1; $a <= 4; $a++) {
            $RESPUESTA_ID = $data['question'][$a - 1]->RESPUESTA_ID;
            
            $this->db->query("DELETE FROM {$this->db->dbprefix('respuesta_modificacion')} WHERE RESPUESTA_ID='{$RESPUESTA_ID}' ");
            
                $SQL_string_respuestas = "INSERT INTO {$this->db->dbprefix('respuesta_modificacion')}
                          (
                           RESPUESTA_MODIFICACION_ENUNCIADO,
                           RESPUESTA_MODIFICACION_FECHA,
                           RESPUESTA_MODIFICACION_IDUSUARIOCREADOR,
                           RESPUESTA_ID
                           )
                          VALUES 
                           (
                           AES_ENCRYPT('" . addslashes($data['RESPUESTA_ENUNCIADO_' . $a]) . "','{$KEY_AES}'),
                           '{$data['PREGUNTA_MODIFICACION_FECHA']}',    
                           '{$data['PREGUNTA_MODIFICACION_IDUSUARIOCREADOR']}',
                           '{$RESPUESTA_ID}'
                           )
                           ";                
            $this->db->query($SQL_string_respuestas);

        }
        return $return;
    }    
    
    public function get_modify_item($PREGUNTA_ID,$KEY_AES){
        $SQL_string = "SELECT "
                . " AES_DECRYPT(PREGUNTA_MODIFICACION_ENUNCIADO,'{$KEY_AES}') PREGUNTA_MODIFICACION_ENUNCIADO,"
                . "  PREGUNTA_MODIFICACION_FECHA "
                . " FROM {$this->db->dbprefix('pregunta_modificacion')} WHERE "
                        . "PREGUNTA_ID = '{$PREGUNTA_ID}'  ";
                        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();        
    }
    
    
    public function get_modify_resp($RESPUESTA_ID,$KEY_AES){
        $SQL_string = "SELECT "
                . " AES_DECRYPT(RESPUESTA_MODIFICACION_ENUNCIADO,'{$KEY_AES}') RESPUESTA_MODIFICACION_ENUNCIADO,"
                . "  RESPUESTA_MODIFICACION_FECHA "
                . " FROM {$this->db->dbprefix('respuesta_modificacion')} WHERE "
                        . "RESPUESTA_ID = '{$RESPUESTA_ID}'  ";
                        //echo $SQL_string;
        $SQL_string_query = $this->db->query($SQL_string);
        return $SQL_string_query->result();          
    }

}
