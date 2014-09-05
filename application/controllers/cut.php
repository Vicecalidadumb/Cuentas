<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cut extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('cut_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Cortes.';
        $data['content'] = 'cut/index';
        $data['cuts'] = $this->cut_model->get_all_cuts();
        $this->load->view('template/template', $data);
    }

    public function add() {
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Cortes.';
        $data['content'] = 'cut/add';
        $this->load->view('template/template', $data);
    }

    public function insert() {
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)

        $this->form_validation->set_rules('CORTE_NOMBREADMIN', 'Nombre Administrativo', 'required|trim');
        $this->form_validation->set_rules('CORTE_DIAPAGO', 'Dia de Pago', 'numeric|required|min_length[1]|max_length[2]|trim');
        $this->form_validation->set_rules('CORTE_DIAINICIO', 'Dia de Inicio', 'numeric|required|min_length[1]|max_length[2]|trim');
        $this->form_validation->set_rules('CORTE_DIAFIN', 'Dia de Finalizacion', 'numeric|required|min_length[1]|max_length[2]|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Cortes.';
            $data['content'] = 'cut/add';
            $this->load->view('template/template', $data);
        } else {
            //GUARDAMOS LAS VARIABLES POST EN UN ARRAY
            $data = array(
                'CORTE_NOMBREADMIN' => $this->input->post('CORTE_NOMBREADMIN', TRUE),
                'CORTE_DIAPAGO' => $this->input->post('CORTE_DIAPAGO', TRUE),
                'CORTE_DIAINICIO' => $this->input->post('CORTE_DIAINICIO', TRUE),
                'CORTE_DIAFIN' => $this->input->post('CORTE_DIAFIN', TRUE),
                'USUARIO_ID' => $this->session->userdata('USUARIO_ID')
            );
            //ENVIAMOS EL ARRAY CON LOS DATOS AL MODELO Y GUARDAMOS EN $insert EL RESULTADO
            $insert = $this->cut_model->insert_cut($data);

            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
                redirect('cut', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al agregar el registro', 'message_type' => 'danger'));
                redirect('cut', 'refresh');
            }
        }
    }

    public function edit($CORTE_ID) {
        $CORTE_ID = deencrypt_id($CORTE_ID);
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Editar Cortes.';
        $data['content'] = 'cut/edit';
        $data['cut'] = $this->cut_model->get_cut_id($CORTE_ID);
        $this->load->view('template/template', $data);
    }

    public function update($CORTE_ID) {
        $CORTE_ID = deencrypt_id($CORTE_ID);
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)

        $this->form_validation->set_rules('CORTE_NOMBREADMIN', 'Nombre Administrativo', 'required|trim');
        $this->form_validation->set_rules('CORTE_DIAPAGO', 'Dia de Pago', 'numeric|required|min_length[1]|max_length[2]|trim');
        $this->form_validation->set_rules('CORTE_DIAINICIO', 'Dia de Inicio', 'numeric|required|min_length[1]|max_length[2]|trim');
        $this->form_validation->set_rules('CORTE_DIAFIN', 'Dia de Finalizacion', 'numeric|required|min_length[1]|max_length[2]|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Editar Cortes.';
            $data['content'] = 'cut/edit';
            $data['cut'] = $this->cut_model->get_cut_id($CORTE_ID);
            $this->load->view('template/template', $data);
        } else {
            //GUARDAMOS LAS VARIABLES POST EN UN ARRAY
            $data = array(
                'CORTE_NOMBREADMIN' => $this->input->post('CORTE_NOMBREADMIN', TRUE),
                'CORTE_DIAPAGO' => $this->input->post('CORTE_DIAPAGO', TRUE),
                'CORTE_DIAINICIO' => $this->input->post('CORTE_DIAINICIO', TRUE),
                'CORTE_DIAFIN' => $this->input->post('CORTE_DIAFIN', TRUE),
                'CORTE_ID' => $CORTE_ID
            );
            //ENVIAMOS EL ARRAY CON LOS DATOS AL MODELO Y GUARDAMOS EN $insert EL RESULTADO
            $insert = $this->cut_model->update_cut($data);

            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Registro editado con exito', 'message_type' => 'info'));
                redirect('cut', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al editar el registro', 'message_type' => 'danger'));
                redirect('cut', 'refresh');
            }
        }
    }

}
