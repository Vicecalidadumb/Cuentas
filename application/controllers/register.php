<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        //$this->module_sigla = 'USU';

        $this->load->model('register_model');
        $this->load->helper('miscellaneous');

        $this->load->library('My_RECAPTCHA');
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        //validation_permission_role($this->module_sigla, 'permission_view');
        //$data['users'] = $this->user_model->get_all_users(1);
        //$data['title'] = 'Usuarios';
        //$data['content'] = 'user/index';
        //$this->load->view('template/template', $data);
    }

    public function add() {
        $data['resp_captcha'] = '';
        $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
        $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
        asort($data['departments_1']);
        $data['departments_2'] = $data['departments_1'];
        $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');
        $data['tipos_documentos'] = get_tipos_documentos();
        $data['title'] = 'Registro de Usuarios';
        $data['content'] = 'register/add';
        $this->load->view('template/template', $data);
    }

    public function document_check($document = 0, $convocatoria = 0) {
        //FUNCION CREADA PARA VALIDAR LA CREACION DE USUARIOS DE UNA CONVOCATORIA.
        $user = $this->register_model->get_user_convocatoria($document, $convocatoria);
        if (count($user) > 0) {
            $this->form_validation->set_message('document_check', 'El usuario con documento <strong>' . $document . '</strong> ya se encuentra inscrito en la convocatoria.');
            return false;
        } else {
            return true;
        }
    }

    public function insert() {
        $resp_captcha = '';
        $privatekey = "6LeZ8PUSAAAAAPOaXIcCLwoKxqWAJJ6sxEcQpYv0";
        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $this->input->post('recaptcha_challenge_field', TRUE), $this->input->post('recaptcha_response_field', TRUE));

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es requerido.');
        $this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe ser numero.');
        $this->form_validation->set_message('min_length', 'El campo <strong>%s</strong> debe contener almenos 2 caracteres.');
        $this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe contener un correo electronico valido.');

        $this->form_validation->set_rules('USUARIO_TIPODOCUMENTO', 'Tipo de Documento', 'required|trim');
        $this->form_validation->set_rules('USUARIO_NOMBRES', 'Nombres', 'required|min_length[2]|trim');
        $this->form_validation->set_rules('USUARIO_GENERO', 'Genero', 'required|trim');
        $this->form_validation->set_rules('USUARIO_DIRECCIONRESIDENCIA', 'Direccion', 'trim');
        $this->form_validation->set_rules('USUARIO_TELEFONOFIJO', 'Telefono', 'required|trim');
        $this->form_validation->set_rules('USUARIO_CORREO', 'Correo Electronico', 'trim');
        $this->form_validation->set_rules('USUARIO_CORREO_2', 'Correo Electronico', 'required|valid_email|trim');
        $this->form_validation->set_rules('USUARIO_NUMERODOCUMENTO', 'Numero de Documento', 'required|numeric|min_length[2]|trim|callback_document_check[' . $this->input->post('CONVOCATORIA_ID', TRUE) . ']');
        $this->form_validation->set_rules('USUARIO_APELLIDOS', 'Apellidos', 'required|min_length[2]|trim');
        $this->form_validation->set_rules('USUARIO_FECHADENACIMIENTO', 'Fecha de Nacimiento', 'required|min_length[10]|trim');
        $this->form_validation->set_rules('USUARIO_LUGARDENACIMIENTO', 'Municipio de Nacimiento', 'required|trim');
        $this->form_validation->set_rules('USUARIO_LUGARDERESIDENCIA', 'Municipio de Residencia', 'required|trim');
        $this->form_validation->set_rules('USUARIO_CELULAR', 'Numero Celular', 'trim');
        $this->form_validation->set_rules('CONVOCATORIA_ID', 'Inscribirse en la convocatoria', 'required|trim');

        if ($this->form_validation->run() == FALSE || !$resp->is_valid) {
            
            if(!$resp->is_valid){
                $data['resp_captcha'] = '<div class="alert alert-warning">
                                    Los caracteres representados en la imagen no se ha introducido correctamente. Por favor vuelva a intentarlo.
                                </div> ';
            }
                       
            $data['departments_1'] = get_dropdown($this->register_model->get_all_departments(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
            $data['departments_1'][''] = '--SELECCIONE UN DEPARTAMENTO--';
            asort($data['departments_1']);
            $data['departments_2'] = $data['departments_1'];
            $data['convocatorias'] = get_dropdown($this->register_model->get_all_calls(), 'CONVOCATORIA_ID', 'CONVOCATORIA_NOMBRE');
            $data['tipos_documentos'] = get_tipos_documentos();
            $data['title'] = 'Registro de Usuarios';
            $data['content'] = 'register/add';
            $this->load->view('template/template', $data);
            
        } else {
            $data = array(
                'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
                'USUARIO_NOMBRES' => addslashes(mb_strtoupper($this->input->post('USUARIO_NOMBRES', TRUE), 'utf-8')),
                'USUARIO_GENERO' => $this->input->post('USUARIO_GENERO', TRUE),
                'USUARIO_DIRECCIONRESIDENCIA' => addslashes(mb_strtoupper($this->input->post('USUARIO_DIRECCIONRESIDENCIA', TRUE), 'utf-8')),
                'USUARIO_TELEFONOFIJO' => $this->input->post('USUARIO_TELEFONOFIJO', TRUE),
                'USUARIO_CORREO' => addslashes(mb_strtoupper($this->input->post('USUARIO_CORREO', TRUE), 'utf-8')),
                'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
                'USUARIO_APELLIDOS' => addslashes(mb_strtoupper($this->input->post('USUARIO_APELLIDOS', TRUE), 'utf-8')),
                'USUARIO_FECHADENACIMIENTO' => $this->input->post('USUARIO_FECHADENACIMIENTO', TRUE),
                'USUARIO_LUGARDENACIMIENTO' => $this->input->post('USUARIO_LUGARDENACIMIENTO', TRUE),
                'USUARIO_LUGARDERESIDENCIA' => $this->input->post('USUARIO_LUGARDERESIDENCIA', TRUE),
                'USUARIO_CELULAR' => $this->input->post('USUARIO_CELULAR', TRUE),
                'CONVOCATORIA_ID' => $this->input->post('CONVOCATORIA_ID', TRUE)
            );
            $insert = $this->register_model->insert_user($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Usuario agregado con exito', 'message_type' => 'info'));
                redirect('register/view_certified/' . encrypt_id($insert) . '/' . encrypt_id($this->input->post('CONVOCATORIA_ID', TRUE)), 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al agregar el registro', 'message_type' => 'danger'));
                redirect('register/add', 'refresh');
            }
        }
    }

    public function view_certified($id_user = '', $id_convocatoria = '') {
        $data['user'] = $this->register_model->get_user_inscription(deencrypt_id($id_user), deencrypt_id($id_convocatoria));
        //echo '<pre>'.print_r($user,true).'</pre>';
        if (count($data['user']) > 0) {
            $data['title'] = 'Certificado de Registro';
            $data['content'] = 'register/view_certified';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al cargar el certificado de inscripcion.', 'message_type' => 'danger'));
            redirect('', 'refresh');
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

    public function get_mun() {

        if ($this->input->is_ajax_request()) {

            $id_dep = $this->input->post('dep');
            $select = $this->input->post('select');
            $index = $this->input->post('index');

            if ($id_dep > 0) {
                $mun = get_dropdown($this->register_model->get_all_cities($id_dep), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');
                echo form_dropdown($select, $mun, ' ', 'class="form-control" tabindex=' . $index);
            } else {
                echo form_dropdown($select, array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), ' ', 'class="form-control" tabindex=' . $index);
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
