<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cv extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'HVI';

        $this->load->helper('miscellaneous');
        $this->load->model('cv_model');
        $this->load->model('user_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->cv_model->get_all_cv('ALL');
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Hojas de Vida.';
        $data['content'] = 'cv/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['states'] = get_dropdown($this->user_model->get_states(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
        $data['states'][] = '-SELECCIONE UN DEPARTAMENTO-';
        asort($data['states']);
        
        $data['professions'] = get_dropdown($this->cv_model->get_professions(), 'PROFESION_ID', 'PROFESION_NOMBRE');

        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nueva Hoja de Vida.';
        $data['content'] = 'cv/add';
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

        $this->form_validation->set_rules('HV_NOMBRES', 'Nombres', 'required|trim');
        $this->form_validation->set_rules('HV_APELLIDOS', 'Apellidos', 'required|trim');
        $this->form_validation->set_rules('HV_NUMERODOCUMENTO', 'Numero de Documento', 'required|trim');
        $this->form_validation->set_rules('HV_LUGARDENACIMIENTO', 'Lugar de Nacimiento', 'required|trim');
        $this->form_validation->set_rules('HV_LUGARDERESIDENCIA', 'Lugar de Residencia', 'required|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nueva Hoja de Vida.';
            $data['content'] = 'cv/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'HV_NOMBRES' => $this->input->post('HV_NOMBRES', TRUE),
                'HV_APELLIDOS' => $this->input->post('HV_APELLIDOS', TRUE),
                'HV_TIPODOCUMENTO' => $this->input->post('HV_TIPODOCUMENTO', TRUE),
                'HV_NUMERODOCUMENTO' => $this->input->post('HV_NUMERODOCUMENTO', TRUE),
                'HV_CORREO' => $this->input->post('HV_CORREO', TRUE),
                'HV_GENERO' => $this->input->post('HV_GENERO', TRUE),
                'HV_FECHADENACIMIENTO' => $this->input->post('HV_FECHADENACIMIENTO', TRUE),
                'HV_LUGARDENACIMIENTO' => $this->input->post('HV_LUGARDENACIMIENTO', TRUE),
                'HV_DIRECCIONRESIDENCIA' => $this->input->post('HV_DIRECCIONRESIDENCIA', TRUE),
                'HV_LUGARDERESIDENCIA' => $this->input->post('HV_LUGARDERESIDENCIA', TRUE),
                'HV_TELEFONOFIJO' => $this->input->post('HV_TELEFONOFIJO', TRUE),
                'HV_CELULAR' => $this->input->post('HV_CELULAR', TRUE),
                'HV_PROFESION' => $this->input->post('HV_PROFESION', TRUE)
            );

            $insert = $this->cv_model->insert_cv($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Usuario agregado con exito', 'message_type' => 'info'));
                redirect('cv', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar usuario', 'message_type' => 'error'));
                redirect('cv', 'refresh');
            }
        }
    }

    public function edit($id_cv) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_cv = deencrypt_id($id_cv);
        $data['registro'] = $this->cv_model->get_cv_id_cv($id_cv);
        if (count($data['registro']) > 0) {
            $data['depar'] = get_dropdown($this->user_model->get_states(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
            $data['depar'][] = '-SELECCIONE UN DEPARTAMENTO-';
            asort($data['depar']);

            $data['citys'] = get_dropdown($this->user_model->get_citys('ALL'), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');

            $data['states'] = get_array_states();

            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Hojas de Vida.';
            $data['content'] = 'cv/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('cv', 'refresh');
        }
    }

    public function documents($id_cv) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_cv = deencrypt_id($id_cv);
        $data['registro'] = $this->cv_model->get_cv_id_cv($id_cv);
        if (count($data['registro']) > 0) {
            $data['documents'] = $this->cv_model->get_cvdocuments_id_cv($id_cv);
            $data['typedocuments'] = get_dropdown($this->cv_model->get_typedocuments(), 'TIPODOCUMENTO_ID', 'TIPODOCUMENTO_NOMBRE');
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Documentos de Hojas de Vida.';
            $data['content'] = 'cv/documents/index';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('cv', 'refresh');
        }
    }

    public function insert_document_cv($id_cv) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_cv = deencrypt_id($id_cv);
        $data['registro'] = $this->cv_model->get_cv_id_cv($id_cv);
        if (count($data['registro']) > 0) {
            $FECHA = date("Y_m_d_H_i_s");
            $TIPODOCUMENTO_ID = $this->input->post('TIPODOCUMENTO_ID', TRUE);

            $config['upload_path'] = 'images/documentos/';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = FALSE;
            $config['max_size'] = '2000';
            $FINE_NAME = $id_cv . '_' . $TIPODOCUMENTO_ID . '_' . $FECHA;
            $config['file_name'] = $FINE_NAME;
            $this->load->library('upload', $config);


            $field_name = "userfile";
            if (!$this->upload->do_upload($field_name)) {
                $error = $this->upload->display_errors();
                //echo 'Error: ' . strip_tags($error);
                $this->session->set_flashdata(array('message' => strip_tags($error), 'message_type' => 'danger'));
                redirect('cv/documents/' . encrypt_id($id_cv), 'refresh');
            } else {

                $upload_data = $this->upload->data();
                $pdf_name = $upload_data['file_name'];

                //echo "Exito!!!" . date("Y_m_d_H_i_s");

                $data = array(
                    'HV_ID' => $id_cv,
                    'TIPODOCUMENTO_ID' => $TIPODOCUMENTO_ID,
                    'DOCUMENTOHV_OBSERVACION' => addslashes($this->input->post('DOCUMENTOHV_OBSERVACION', TRUE)),
                    'DOCUMENTOHV_IDCREADOR' => $this->session->userdata('USUARIO_ID'),
                    'DOCUMENTOHV_NOMBRE' => $FINE_NAME
                );
                $insert = $this->cv_model->insert_document($data);

                if ($insert) {
                    $this->session->set_flashdata(array('message' => 'Documento cargado con exito.', 'message_type' => 'info'));
                    redirect('cv/documents/' . encrypt_id($id_cv), 'refresh');
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al insertar el documento', 'message_type' => 'error'));
                    redirect('cv/documents/' . encrypt_id($id_cv), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('cv', 'refresh');
        }
    }

    public function view_document($DOCUMENTO_ID) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $DOCUMENTO_ID = deencrypt_id($DOCUMENTO_ID);
        $documen = $this->cv_model->get_document_cv($DOCUMENTO_ID);
        if (count($documen) > 0) {
            //echo '<pre>'.print_r($document,true).'</pre>';
            $file = $documen[0]->DOCUMENTOHV_NOMBRE . '.pdf';
            //echo $file;
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $documen[0]->DOCUMENTOHV_NOMBRE . '.pdf"');
            @readfile('images/documentos/' . $file);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('cv', 'refresh');
        }
    }

    public function update($id_cv) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_cv = deencrypt_id($id_cv);

        //validation_permission_role($this->module_sigla, 'permission_edit');
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)        


        $this->form_validation->set_rules('HV_NOMBRES', 'Nombres', 'required|trim');
        $this->form_validation->set_rules('HV_APELLIDOS', 'Apellidos', 'required|trim');
        $this->form_validation->set_rules('HV_NUMERODOCUMENTO', 'Numero de Documento', 'required|trim');
        $this->form_validation->set_rules('HV_LUGARDENACIMIENTO', 'Lugar de Nacimiento', 'required|trim');
        $this->form_validation->set_rules('HV_LUGARDERESIDENCIA', 'Lugar de Residencia', 'required|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['registro'] = $this->user_model->get_cv_id_cv($id_cv);
            if (count($data['registro']) > 0) {
                $data['depar'] = get_dropdown($this->user_model->get_states(), 'DEPARTAMENTO_ID', 'DEPARTAMENTO_NOMBRE');
                $data['depar'][] = '-SELECCIONE UN DEPARTAMENTO-';
                asort($data['depar']);

                $data['citys'] = get_dropdown($this->user_model->get_citys('ALL'), 'MUNICIPIO_ID', 'MUNICIPIO_NOMBRE');

                $data['states'] = get_array_states();

                $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Hojas de Vida.';
                $data['content'] = 'cv/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('user', 'refresh');
            }
        } else {
            $data = array(
                'HV_NOMBRES' => $this->input->post('HV_NOMBRES', TRUE),
                'HV_APELLIDOS' => $this->input->post('HV_APELLIDOS', TRUE),
                'HV_TIPODOCUMENTO' => $this->input->post('HV_TIPODOCUMENTO', TRUE),
                'HV_NUMERODOCUMENTO' => $this->input->post('HV_NUMERODOCUMENTO', TRUE),
                'HV_CORREO' => $this->input->post('HV_CORREO', TRUE),
                'HV_GENERO' => $this->input->post('HV_GENERO', TRUE),
                'HV_FECHADENACIMIENTO' => $this->input->post('HV_FECHADENACIMIENTO', TRUE),
                'HV_LUGARDENACIMIENTO' => $this->input->post('HV_LUGARDENACIMIENTO', TRUE),
                'HV_DIRECCIONRESIDENCIA' => $this->input->post('HV_DIRECCIONRESIDENCIA', TRUE),
                'HV_LUGARDERESIDENCIA' => $this->input->post('HV_LUGARDERESIDENCIA', TRUE),
                'HV_TELEFONOFIJO' => $this->input->post('HV_TELEFONOFIJO', TRUE),
                'HV_CELULAR' => $this->input->post('HV_CELULAR', TRUE),
                'HV_ID' => $id_cv,
                'HV_ESTADO' => $this->input->post('HV_ESTADO', TRUE),
                'HV_PROFESION' => $this->input->post('HV_PROFESION', TRUE)
            );
            $update = $this->cv_model->update_cv($data);

            if ($update) {
                $this->session->set_flashdata(array('message' => 'Registro editado con exito', 'message_type' => 'info'));
                redirect('cv', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al editar el Registro', 'message_type' => 'warning'));
                redirect('cv', 'refresh');
            }
        }
    }

}
