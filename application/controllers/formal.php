<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('formal_model');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index(){
        $data['title'] = 'Aplicativo de Cargue de Documentos - Educacion Formal';
        $data['documents_particles_user'] = $this->formal_model->get_documents_particles_user($this->session->userdata("INSCRIPCION_PIN"));
        $data['content'] = 'formal/add';
        $this->load->view('template/template', $data);
    }

    public function view_document($DOCUMENTO_ID) {
        $DOCUMENTO_ID = deencrypt_id($DOCUMENTO_ID);
        $document = $this->particles_model->get_document_user($this->session->userdata("INSCRIPCION_PIN"), $DOCUMENTO_ID);
        //echo '<pre>'.print_r($document,true).'</pre>';
        $file = $document[0]->DOCUMENTO_NOMBRE . '.pdf';
        //echo $file;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $document[0]->INSCRIPCION_PIN . '_' . $document[0]->DOCUMENTO_FOLIO . '.pdf"');
        @readfile('images/documentos/' . $file);
    }

    public function insert() {
        date_default_timezone_set('America/Bogota');
        //echo '<pre>' . print_r($this->input->post()) . '</pre>';

        $TIPO_DOCUMENTO_ID = $this->input->post('TIPO_DOCUMENTO_ID', TRUE);
        $FECHA = date("Y_m_d_H_i_s");

        $config['upload_path'] = 'images/documentos/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '2000';
        $FINE_NAME = $this->session->userdata("CONVOCATORIA_ID") . '_' . $this->session->userdata("INSCRIPCION_PIN") . '_' . $TIPO_DOCUMENTO_ID . '_' . $FECHA;
        $config['file_name'] = $FINE_NAME;
        $this->load->library('upload', $config);


        $field_name = "userfile_" . $TIPO_DOCUMENTO_ID;
        if (!$this->upload->do_upload($field_name)) {
            $error = $this->upload->display_errors();
            //echo 'Error: ' . strip_tags($error);
            $this->session->set_flashdata(array('message' => strip_tags($error), 'message_type' => 'danger'));
            redirect('particles', 'refresh');
        } else {

            $upload_data = $this->upload->data();
            $pdf_name = $upload_data['file_name'];

            //echo "Exito!!!" . date("Y_m_d_H_i_s");

            $data = array(
                'INSCRIPCION_PIN' => $this->session->userdata("INSCRIPCION_PIN"),
                'TIPO_DOCUMENTO_ID' => $TIPO_DOCUMENTO_ID,
                'DOCUMENTO_NOMBRE' => $FINE_NAME,
                'DOCUMENTO_FECHA' => $FECHA,
                'DOCUMENTO_ESTADO' => '1'
            );
            $insert = $this->particles_model->insert_document($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Documento cargado con exito.', 'message_type' => 'info'));
                redirect('particles', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el documento', 'message_type' => 'error'));
                redirect('particles', 'refresh');
            }
        }

        /*
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
         * 
         */
    }

}
