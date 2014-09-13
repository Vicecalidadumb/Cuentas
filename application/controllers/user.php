<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'USU';


        $this->load->helper('miscellaneous');
        $this->load->model('user_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->user_model->get_all_users('ALL');
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Usuarios.';
        $data['content'] = 'user/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['roles'] = get_dropdown($this->user_model->get_type_user(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
        $data['states'] = get_array_states();
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nuevo Usuarios.';
        $data['content'] = 'user/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');


        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)

        $this->form_validation->set_rules('USUARIO_NOMBRES', 'Nombres', 'required|trim');
        $this->form_validation->set_rules('USUARIO_APELLIDOS', 'Apellidos', 'required|trim');
        $this->form_validation->set_rules('USUARIO_NUMERODOCUMENTO', 'Numero de Documento', 'required|trim');
        $this->form_validation->set_rules('USUARIO_CORREO', 'Correo Electronico', 'required|trim');
        $this->form_validation->set_rules('USUARIO_PASSWORD', 'Contraseña', 'required|trim');
        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['roles'] = get_dropdown($this->user_model->get_type_user(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
            $data['states'] = get_array_states();
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nuevo Usuarios.';
            $data['content'] = 'user/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'USUARIO_PASSWORD' => $this->input->post('USUARIO_PASSWORD', TRUE),
                'USUARIO_NOMBRES' => $this->input->post('USUARIO_NOMBRES', TRUE),
                'USUARIO_APELLIDOS' => $this->input->post('USUARIO_APELLIDOS', TRUE),
                'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
                'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
                'USUARIO_CORREO' => $this->input->post('USUARIO_CORREO', TRUE),
                'USUARIO_GENERO' => $this->input->post('USUARIO_GENERO', TRUE),
                'USUARIO_FECHADENACIMIENTO' => $this->input->post('USUARIO_FECHADENACIMIENTO', TRUE),
                'USUARIO_LUGARDENACIMIENTO' => $this->input->post('USUARIO_LUGARDENACIMIENTO', TRUE),
                'USUARIO_DIRECCIONRESIDENCIA' => $this->input->post('USUARIO_DIRECCIONRESIDENCIA', TRUE),
                'USUARIO_LUGARDERESIDENCIA' => $this->input->post('USUARIO_LUGARDERESIDENCIA', TRUE),
                'USUARIO_TELEFONOFIJO' => $this->input->post('USUARIO_TELEFONOFIJO', TRUE),
                'USUARIO_CELULAR' => $this->input->post('USUARIO_CELULAR', TRUE),
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
    }

    public function edit($id_user) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_user = deencrypt_id($id_user);
        $data['registro'] = $this->user_model->get_user_id_user($id_user);
        if (count($data['registro']) > 0) {
            $data['roles'] = get_dropdown($this->user_model->get_type_user(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
            $data['states'] = get_array_states();

            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Usuarios.';
            $data['content'] = 'user/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }

    public function update($id_user) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_user = deencrypt_id($id_user);

        //validation_permission_role($this->module_sigla, 'permission_edit');
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)        


        $this->form_validation->set_rules('USUARIO_NOMBRES', 'Nombres', 'required|trim');
        $this->form_validation->set_rules('USUARIO_APELLIDOS', 'Apellidos', 'required|trim');
        $this->form_validation->set_rules('USUARIO_NUMERODOCUMENTO', 'Numero de Documento', 'required|trim');
        $this->form_validation->set_rules('USUARIO_CORREO', 'Correo Electronico', 'required|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['registro'] = $this->user_model->get_user_id_user($id_user);
            if (count($data['registro']) > 0) {
                $data['roles'] = get_dropdown($this->user_model->get_type_user(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
                $data['states'] = get_array_states();

                $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Usuarios.';
                $data['content'] = 'user/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('user', 'refresh');
            }
        } else {
            //SI EL USUARIO INGRESO UNA CONTRASEÑA SE ACTUALIZA EN EL SISTEMA
            if ($this->input->post('USUARIO_CLAVE', TRUE) != '') {
                $user_password = make_hash($this->input->post('USUARIO_CLAVE', TRUE));
                $this->user_model->update_user_password($user_password, $id_user);
            }
            $data = array(
                'USUARIO_NOMBRES' => $this->input->post('USUARIO_NOMBRES', TRUE),
                'USUARIO_APELLIDOS' => $this->input->post('USUARIO_APELLIDOS', TRUE),
                'USUARIO_TIPODOCUMENTO' => $this->input->post('USUARIO_TIPODOCUMENTO', TRUE),
                'USUARIO_NUMERODOCUMENTO' => $this->input->post('USUARIO_NUMERODOCUMENTO', TRUE),
                'USUARIO_CORREO' => $this->input->post('USUARIO_CORREO', TRUE),
                'USUARIO_GENERO' => $this->input->post('USUARIO_GENERO', TRUE),
                'USUARIO_FECHADENACIMIENTO' => $this->input->post('USUARIO_FECHADENACIMIENTO', TRUE),
                'USUARIO_LUGARDENACIMIENTO' => $this->input->post('USUARIO_LUGARDENACIMIENTO', TRUE),
                'USUARIO_DIRECCIONRESIDENCIA' => $this->input->post('USUARIO_DIRECCIONRESIDENCIA', TRUE),
                'USUARIO_LUGARDERESIDENCIA' => $this->input->post('USUARIO_LUGARDERESIDENCIA', TRUE),
                'USUARIO_TELEFONOFIJO' => $this->input->post('USUARIO_TELEFONOFIJO', TRUE),
                'USUARIO_CELULAR' => $this->input->post('USUARIO_CELULAR', TRUE),
                'ID_TIPO_USU' => $this->input->post('ID_TIPO_USU', TRUE),
                'USUARIO_ID' => $id_user,
                'USUARIO_ESTADO' => $this->input->post('USUARIO_ESTADO', TRUE)
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
    }

    /*     * ***********************AJAX FUNCTIONS************************** */

    public function get_citys() {
        validate_login($this->session->userdata('logged_in'));

        if ($this->input->is_ajax_request()) {
            $id_state = $this->input->post('id1');
            $id_select = $this->input->post('id2');
            if ($this->input->post('id1') != '') {
                $citys = get_dropdown($this->user_model->get_citys($id_state), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');
                if (count($citys) > 0) {
                    echo form_dropdown($id_select, $citys, '', 'id="' . $id_select . '" class="form-control"');
                } else {
                    echo form_dropdown($id_select, array("" => "--SELECCIONE PRIMERO UN DEPARTAMENTO--"), '', 'id="' . $id_select . '" class="form-control"');
                }
            } else {
                echo form_dropdown($id_select, array("" => "--SELECCIONE PRIMERO UN DEPARTAMENTO--"), '', 'id="' . $id_select . '" class="form-control"');
            }
        } else {
            echo 'Acceso no utorizado';
        }
    }

}
