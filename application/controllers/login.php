<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('config_model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        //$this->load->library('My_PHPMailer');
    }

    public function index() {
        //FUNCION PRINCIPAL PARA EL LOGIN - CARGA LA VISTA LOGIN/INDEX.PHP
        if ($this->session->userdata('logged_in')) {
            redirect('desk', 'refresh');
        } else {
            $this->load->view('login/index');
        }
    }

    public function make_hash($var = 1) {
        //FUNCION PARA GENERAR NUEVAS CONTRASEÑAS
        echo make_hash($var);
    }

    public function verify() {

        //RECOLECTAMOS LOS DATOS DE LOS CAMPOS DE USUARIO Y CONTRASEÑA
        $username = $this->input->post('username');
        $pass = strip_tags(utf8_decode($this->input->post('password')));

        //CONSULTAMOS EL USUARIO CON BASE EN EL NUMERO DE DOCUMENTO
        $user = $this->user_model->get_user_documento($username);

        //VERIFICAMOS SI EL USUARIO EXISTE
        if (sizeof($user) > 0) {
            //VERIFICAMOS QUE LA CONTRASEÑA SEA VALIDA
            if (verifyHash($pass, $user[0]->USUARIO_PASSWORD) || check_password($pass, $user[0]->USUARIO_PASSWORD)) {

                //OBTENER PERMISOS DE MODULOS PARA EL ROL ACTUAL
                $rol_permissions = $this->config_model->get_rol_permissions($user[0]->ID_TIPO_USU, 'SIGLA_MODULO');

                //PREPARAMOS LAS VARIABLES QUE VAMOS A GUARDAR EN SESSION
                $newdata = array(
                    'USUARIO_ID' => $user[0]->USUARIO_ID,
                    'USUARIO_NOMBRES' => $user[0]->USUARIO_NOMBRES,
                    'USUARIO_APELLIDOS' => $user[0]->USUARIO_APELLIDOS,
                    'USUARIO_TIPODOCUMENTO' => $user[0]->USUARIO_TIPODOCUMENTO,
                    'USUARIO_NUMERODOCUMENTO' => $user[0]->USUARIO_NUMERODOCUMENTO,
                    'USUARIO_CORREO' => $user[0]->USUARIO_CORREO,
                    'USUARIO_GENERO' => $user[0]->USUARIO_GENERO,
                    'USUARIO_FECHADENACIMIENTO' => $user[0]->USUARIO_FECHADENACIMIENTO,
                    'USUARIO_DIRECCIONRESIDENCIA' => $user[0]->USUARIO_DIRECCIONRESIDENCIA,
                    'USUARIO_TELEFONOFIJO' => $user[0]->USUARIO_TELEFONOFIJO,
                    'USUARIO_CELULAR' => $user[0]->USUARIO_CELULAR,
                    'USUARIO_ESTADO' => $user[0]->USUARIO_ESTADO,
                    'USUARIO_FECHAINGRESO' => $user[0]->USUARIO_FECHAINGRESO,
                    'ID_TIPO_USU' => $user[0]->ID_TIPO_USU,
                    'rol_permissions' => $rol_permissions,
                    'logged_in' => TRUE,
                );
                
                $this->session->set_userdata($newdata);
                
                redirect('desk', 'location');
            } else {
                $this->session->set_flashdata(array('message' => '<strong>Error:</strong> Contrase&ntilde;a Incorrecta.', 'message_type' => 'danger'));
                redirect('', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Su n&uacute;mero de documento no se encuentra registrado en el sistema.', 'message_type' => 'warning'));
            redirect('', 'refresh');
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('login', 'location');
    }

}
