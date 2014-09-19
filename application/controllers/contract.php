<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contract extends CI_Controller {

    private $module_sigla;

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'CON';

        $this->load->helper('miscellaneous');
        $this->load->model('contract_model');
        $this->load->model('user_model');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $data['registros'] = $this->contract_model->get_all_contract('ALL');
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Contratos.';
        $data['content'] = 'contract/index';
        $this->load->view('template/template', $data);
    }

    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['typecontracts'] = get_dropdown($this->contract_model->get_typecontracts(), 'TIPOCONTRATO_ID', 'TIPOCONTRATO_NOMBRE');
        $data['cvs'] = get_dropdown($this->contract_model->get_cvs(), 'HV_ID', 'HV_NOMBRES');
        $data['proyects'] = get_dropdown($this->contract_model->get_proyects(), 'PROYECTO_ID', 'PROYECTO_NOMBRE');
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nuevo Contrato.';
        $data['content'] = 'contract/add';
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

        $this->form_validation->set_rules('CONTRATO_FECHAINI', 'Fecha de Inicio del Contrato', 'required|trim');
        $this->form_validation->set_rules('CONTRATO_FECHAFIN', 'Fecha de Finalizacion del Contrato', 'required|trim');
        $this->form_validation->set_rules('CONTRATO_VALOR', 'Valor del Contrato', 'required|digits|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['typecontracts'] = get_dropdown($this->contract_model->get_typecontracts(), 'TIPOCONTRATO_ID', 'TIPOCONTRATO_NOMBRE');
            $data['cvs'] = get_dropdown($this->contract_model->get_cvs(), 'HV_ID', 'HV_NOMBRES');
            $data['proyects'] = get_dropdown($this->contract_model->get_proyects(), 'PROYECTO_ID', 'PROYECTO_NOMBRE');
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Nuevo Contrato.';
            $data['content'] = 'contract/add';
            $this->load->view('template/template', $data);
        } else {
            $data = array(
                'TIPOCONTRATO_ID' => $this->input->post('TIPOCONTRATO_ID', TRUE),
                'HV_ID' => $this->input->post('HV_ID', TRUE),
                'CONTRATO_FECHAINI' => $this->input->post('CONTRATO_FECHAINI', TRUE),
                'CONTRATO_FECHAFIN' => $this->input->post('CONTRATO_FECHAFIN', TRUE),
                'CONTRATO_VALOR' => $this->input->post('CONTRATO_VALOR', TRUE),
                'PROYECTO_ID' => $this->input->post('PROYECTO_ID', TRUE),
                'USUARIO_ID' => $this->session->userdata('USUARIO_ID')
            );

            $insert = $this->contract_model->insert_contract($data);
            if ($insert) {
                $this->session->set_flashdata(array('message' => 'Contrato agregado con exito', 'message_type' => 'info'));
                redirect('contract', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al insertar el Contrato', 'message_type' => 'error'));
                redirect('contract', 'refresh');
            }
        }
    }

    public function edit($id_contract) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_contract = deencrypt_id($id_contract);
        $data['registro'] = $this->contract_model->get_contract_id_contract($id_contract);
        if (count($data['registro']) > 0) {

            $data['typecontracts'] = get_dropdown($this->contract_model->get_typecontracts(), 'TIPOCONTRATO_ID', 'TIPOCONTRATO_NOMBRE');
            $data['cvs'] = get_dropdown($this->contract_model->get_cvs(), 'HV_ID', 'HV_NOMBRES');
            $data['proyects'] = get_dropdown($this->contract_model->get_proyects(), 'PROYECTO_ID', 'PROYECTO_NOMBRE');

            $data['states'] = get_array_states();

            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Contrato.';
            $data['content'] = 'contract/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('contract', 'refresh');
        }
    }

    public function update($id_contract) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_contract = deencrypt_id($id_contract);

        //validation_permission_role($this->module_sigla, 'permission_edit');
        //CARGAMOS LA LIBRERIA DE VALIDACION DE CODEIGNITER
        $this->load->library('form_validation');
        //DEFINIMOS LOS DELIMITADORES DE LOS MENSAJES DE ERROR - EN FORMATO HTML
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        //DEFINIMOS LOS CAMPOS QUE VAMOS A VALIDAR, JUNTO CON EL TIPO DE VALIDACION:
        //(https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference)        


        $this->form_validation->set_rules('CONTRATO_FECHAINI', 'Fecha de Inicio del Contrato', 'required|trim');
        $this->form_validation->set_rules('CONTRATO_FECHAFIN', 'Fecha de Finalizacion del Contrato', 'required|trim');
        $this->form_validation->set_rules('CONTRATO_VALOR', 'Valor del Contrato', 'required|digits|trim');

        //SI LA VALIDACION RETORNA UN FALSE, CARGAMOS NUEVAMENTE LA VISTA, SI RETORNA TRUE GUARDAMOS
        if ($this->form_validation->run() == FALSE) {
            $data['registro'] = $this->contract_model->get_contract_id_contract($id_contract);
            if (count($data['registro']) > 0) {
                $data['typecontracts'] = get_dropdown($this->contract_model->get_typecontracts(), 'TIPOCONTRATO_ID', 'TIPOCONTRATO_NOMBRE');
                $data['cvs'] = get_dropdown($this->contract_model->get_cvs(), 'HV_ID', 'HV_NOMBRES');
                $data['proyects'] = get_dropdown($this->contract_model->get_proyects(), 'PROYECTO_ID', 'PROYECTO_NOMBRE');

                $data['states'] = get_array_states();

                $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Modificar Contrato.';
                $data['content'] = 'contract/edit';
                $this->load->view('template/template', $data);
            } else {
                $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
                redirect('user', 'refresh');
            }
        } else {
            $data = array(
                'CONTRATO_ID' => $id_contract,
                'TIPOCONTRATO_ID' => $this->input->post('TIPOCONTRATO_ID', TRUE),
                'HV_ID' => $this->input->post('HV_ID', TRUE),
                'CONTRATO_FECHAINI' => $this->input->post('CONTRATO_FECHAINI', TRUE),
                'CONTRATO_FECHAFIN' => $this->input->post('CONTRATO_FECHAFIN', TRUE),
                'CONTRATO_VALOR' => $this->input->post('CONTRATO_VALOR', TRUE),
                'PROYECTO_ID' => $this->input->post('PROYECTO_ID', TRUE),
                'CONTRATO_ESTADO' => $this->input->post('CONTRATO_ESTADO'),
            );
            $update = $this->contract_model->update_contract($data);

            if ($update) {
                $this->session->set_flashdata(array('message' => 'Registro editado con exito', 'message_type' => 'info'));
                redirect('contract', 'refresh');
            } else {
                $this->session->set_flashdata(array('message' => 'Error al editar el Registro', 'message_type' => 'warning'));
                redirect('contract', 'refresh');
            }
        }
    }

    public function documents($id_contract) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_contract = deencrypt_id($id_contract);
        $data['registro'] = $this->contract_model->get_contract_id_contract($id_contract);
        if (count($data['registro']) > 0) {
            $data['documents'] = $this->contract_model->get_contractdocuments_id_contract($id_contract);
            $data['typedocuments'] = get_dropdown($this->contract_model->get_typedocuments(), 'TIPODOCUMENTO_ID', 'TIPODOCUMENTO_NOMBRE');
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Documentos de Hojas de Vida.';
            $data['content'] = 'contract/documents/index';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('contract', 'refresh');
        }
    }
    
    public function info_documents($id_contract) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');
        $this->load->model('cv_model');

        $id_contract = deencrypt_id($id_contract);
        $data['registro'] = $this->contract_model->get_contract_id_contract($id_contract);
        if (count($data['registro']) > 0) {
            $data['documents'] = $this->contract_model->get_contractdocuments_id_contract($id_contract);
            $data['documents_2'] = $this->cv_model->get_cvdocuments_id_cv($data['registro'][0]->HV_ID);
            $data['typedocuments'] = get_dropdown($this->contract_model->get_typedocuments(), 'TIPODOCUMENTO_ID', 'TIPODOCUMENTO_NOMBRE');
            $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Documentos de Hojas de Vida.';
            $data['content'] = 'contract/documents/index';
            $this->load->view('contract/documents/index_info', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('contract', 'refresh');
        }
    }    

    public function insert_document_contract($id_contract) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_edit');

        $id_contract = deencrypt_id($id_contract);
        $data['registro'] = $this->contract_model->get_contract_id_contract($id_contract);
        if (count($data['registro']) > 0) {
            $FECHA = date("Y_m_d_H_i_s");
            $TIPODOCUMENTO_ID = $this->input->post('TIPODOCUMENTO_ID', TRUE);

            $config['upload_path'] = 'images/documentos/contratos/';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = FALSE;
            $config['max_size'] = '2000';
            $FINE_NAME = $id_contract . '_' . $TIPODOCUMENTO_ID . '_' . $FECHA;
            $config['file_name'] = $FINE_NAME;
            $this->load->library('upload', $config);


            $field_name = "userfile";
            if (!$this->upload->do_upload($field_name)) {
                $error = $this->upload->display_errors();
                //echo 'Error: ' . strip_tags($error);
                $this->session->set_flashdata(array('message' => strip_tags($error), 'message_type' => 'danger'));
                redirect('contract/documents/' . encrypt_id($id_contract), 'refresh');
            } else {

                $upload_data = $this->upload->data();
                $pdf_name = $upload_data['file_name'];

                //echo "Exito!!!" . date("Y_m_d_H_i_s");

                $data = array(
                    'CONTRATO_ID' => $id_contract,
                    'TIPODOCUMENTO_ID' => $TIPODOCUMENTO_ID,
                    'DOCUMENTOCO_OBSERVACION' => addslashes($this->input->post('DOCUMENTOCO_OBSERVACION', TRUE)),
                    'DOCUMENTOCO_IDCREADOR' => $this->session->userdata('USUARIO_ID'),
                    'DOCUMENTOCO_NOMBRE' => $FINE_NAME
                );
                $insert = $this->contract_model->insert_document($data);

                if ($insert) {
                    $this->session->set_flashdata(array('message' => 'Documento cargado con exito.', 'message_type' => 'info'));
                    redirect('contract/documents/' . encrypt_id($id_contract), 'refresh');
                } else {
                    $this->session->set_flashdata(array('message' => 'Error al insertar el documento', 'message_type' => 'error'));
                    redirect('contract/documents/' . encrypt_id($id_contract), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('contract', 'refresh');
        }
    }

    public function view_document($DOCUMENTO_ID) {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_view');

        $DOCUMENTO_ID = deencrypt_id($DOCUMENTO_ID);
        $documen = $this->contract_model->get_document_contract($DOCUMENTO_ID);
        if (count($documen) > 0) {
            //echo '<pre>'.print_r($document,true).'</pre>';
            $file = $documen[0]->DOCUMENTOCO_NOMBRE . '.pdf';
            //echo $file;
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $documen[0]->DOCUMENTOCO_NOMBRE . '.pdf"');
            @readfile('images/documentos/contratos/' . $file);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('contract', 'refresh');
        }
    }

////////////FUNCIONES AJAX
    public function get_schedule_json() {
        $this->load->model('cut_model');
        $contract = $this->contract_model->get_all_contract('1');
        $start = date("Y-m-d", $this->input->get('start'));
        $end = date("Y-m-d", $this->input->get('end'));
        $cut_day = get_cut_day();
        $dias = dias_transcurridos($start, $end);
        $cuts = $this->cut_model->get_all_cuts();
        $events = array();
        $count = 0;
        for ($a = 1; $a <= $dias; $a++) {
            $newdate = date("Y-m-d", strtotime("$start +" . $a . " day"));
            $newdate_d = date("j", strtotime("$start +" . $a . " day"));
            foreach ($cuts as $cut) {
                if ($newdate_d == $cut->CORTE_DIAPAGO) {
                    foreach ($contract as $contrac) {
                        $cut_contrac = $cut_day[date("j", strtotime($contrac->CONTRATO_FECHAINI))];
                        if ($cut_contrac == $cut->CORTE_ID) {
                            if (check_in_range($contrac->CONTRATO_FECHAINI, $contrac->CONTRATO_FECHAFIN, date("Y-m-d", strtotime("$newdate -1 month")))) {
                                $events[$count]['title'] = $cut->CORTE_ID . ' - ' . $contrac->HV_NOMBRES . ' ' . $contrac->HV_APELLIDOS;
                                $events[$count]['start'] = $newdate;
                                $events[$count]['year'] = date("Y", strtotime($newdate));
                                $events[$count]['month'] = date("n", strtotime($newdate));
                                //echo "--OK: " . $newdate . ': ' . $contrac->CONTRATO_FECHAINI . '<br>';
                                $count++;
                            }
                        }
                    }
                }
            }
        }
        for ($a = 0; $a < count($events); $a++) {
            $array_send[] = array(
                'title' => "Corte - " . $events[$a]['title'],
                'start' => $events[$a]['start'] . ' 00:00:00',
                'end' => $events[$a]['start'] . ' 23:59:59',
                'allDay' => true,
                'backgroundColor' => 'Metronic.getBrandColor(\'yellow\')',
                'url' => "" . base_url('cut/view_cut/' . $events[$a]['year'] . '/' . $events[$a]['month']) . ""
            );
        }
        //echo '<pre>' . print_r($array_send, true) . '</pre>';
        echo json_encode($array_send);
    }

}
