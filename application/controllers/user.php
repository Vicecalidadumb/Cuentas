<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'USU';

        $this->load->model('user_model');
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        //$this->load->library('My_PHPGangsta');
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['users'] = $this->user_model->get_all_users(1);
        $data['title'] = 'Usuarios';
        $data['content'] = 'user/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['roles'] = get_dropdown($this->user_model->get_all_roles(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
        $data['states'] = get_array_states();
        $data['title'] = 'Nuevo Usuario';
        $data['content'] = 'user/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data = array(
            'USUARIO_NOMBRES' => $this->input->post('USUARIO_NOMBRES', TRUE),
            'USUARIO_APELLIDOS' => $this->input->post('USUARIO_APELLIDOS', TRUE),
            'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
            'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
            'USUARIO_CORREO' => $this->input->post('USUARIO_CORREO', TRUE),
            'USUARIO_CLAVE' => make_hash($this->input->post('USUARIO_CLAVE', TRUE)),
            'ID_TIPO_USU' => $this->input->post('ID_TIPO_USU', TRUE)
        );
        $insert = $this->user_model->insert_user($data);
        if ($insert) {
            $this->session->set_flashdata(array('message' => 'Usuario agregado con exito', 'message_type' => 'info'));
            redirect('user', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al insertar usuario', 'message_type' => 'error'));
            redirect('user', 'refresh');
        }
    }

    public function edit($id_user) {
        $id_user = deencrypt_id($id_user);

        validation_permission_role($this->module_sigla, 'permission_edit');

        $data['user'] = $this->user_model->get_user($id_user);
        if (count($data['user']) > 0) {
            $data['roles'] = get_dropdown($this->user_model->get_all_roles(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
            $data['states'] = get_array_states();

            $data['title'] = 'Editar Usuario';
            $data['content'] = 'user/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }

    public function update() {
        validation_permission_role($this->module_sigla, 'permission_edit');

        if ($this->input->post('USUARIO_CLAVE', TRUE) != '') {
            $user_password = make_hash($this->input->post('USUARIO_CLAVE', TRUE));
            $user_id = $this->input->post('USUARIO_ID', TRUE);
            $this->user_model->update_user_password($user_password, $user_id);
        }

        $data = array(
            'USUARIO_ID' => $this->input->post('USUARIO_ID', TRUE),
            'USUARIO_NOMBRES' => $this->input->post('USUARIO_NOMBRES', TRUE),
            'USUARIO_APELLIDOS' => $this->input->post('USUARIO_APELLIDOS', TRUE),
            'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
            'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
            'USUARIO_CORREO' => $this->input->post('USUARIO_CORREO', TRUE),
            'ID_TIPO_USU' => $this->input->post('ID_TIPO_USU', TRUE)
        );
        $update = $this->user_model->update_user($data);

        if ($update) {
            $this->session->set_flashdata(array('message' => 'Usuario editado con exito', 'message_type' => 'info'));
            redirect('user', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al editar usuario', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }

    /*     * ***********************AJAX FUNCTIONS************************** */

    public function check_user_username_ajax() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $user_username = $this->input->post('user_username');
            if ($this->input->post('user_id') > 0) {
                $user_id = $this->input->post('user_id');
                $user = $this->user_model->get_user_username_userid($user_username, $user_id);
            } else {
                $user = $this->user_model->get_user_username($user_username);
            }
            if (sizeof($user) > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function check_user_mail_ajax() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $user_mail = $this->input->post('user_mail');
            if ($this->input->post('user_id') > 0) {
                $user_id = $this->input->post('user_id');
                $user = $this->user_model->get_user_email_userid($user_mail, $user_id);
            } else {
                $user = $this->user_model->get_user_email($user_mail);
            }
            if (sizeof($user) > 0) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function get_users_keyword() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->get('q');
            $users = $this->user_model->get_users_keyword($keyword);
            echo json_encode($users);
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function get_users_core_keyword() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $keyword = $this->input->get('q');
            $users = $this->user_model->get_users_core_keyword($keyword);
            echo json_encode($users);
        } else {
            echo 'Acceso no utorizado';
        }
    }

    public function update_user_notes() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $notes = $this->input->post('notes');
//$this->session->userdata('user_notes') = $notes;
            $this->session->set_userdata('user_notes', $notes);
            $user_id = $this->session->userdata('user_id');
            $this->user_model->update_user_notes($notes, $user_id);
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
