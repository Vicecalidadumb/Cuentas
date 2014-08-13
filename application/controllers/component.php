<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Component extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //DEFINIMOS EL NOMBRE DEL MODULO
        $this->module_sigla = 'COM';

        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->model('user_model');
        $this->load->model('component_model');
        validate_login($this->session->userdata('logged_in'));
    }
    
    public function index() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->component_model->get_components();

        $data['title'] = 'Componetes';
        $data['content'] = 'component/index';
        $this->load->view('template/template', $data);
    }    

    public function view() {
        validation_permission_role($this->module_sigla, 'permission_view');
        $data['components'] = $this->component_model->get_components();

        $data['title'] = 'Componetes';
        $data['content'] = 'component/report';
        $this->load->view('template/template', $data);
    }

    public function random($var = 6, $items = '') {
        validation_permission_role($this->module_sigla, 'permission_view');
        if ($items != '') {
            echo $items;
        } else {
            $data['components'] = $this->component_model->get_components();

            $data['var_random'] = $var;

            $data['title'] = 'Componetes';
            $data['content'] = 'component/random';
            $this->load->view('template/template', $data);
        }
    }
    
    public function add() {
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data['users'] = get_dropdown($this->user_model->get_all_users_rol(), 'USUARIO_ID', 'USUARIO_NOMBRES');
      
        $data['title'] = 'Nuevo Componente';
        $data['content'] = 'component/add';
        $this->load->view('template/template', $data);
    }
    
    public function insert() {
        
        //echo print_y($this->input->post());
        //VALIDAR PERMISO DEL ROL
        validation_permission_role($this->module_sigla, 'permission_add');

        $data = array(
            'COMPONENTE_NOMBRE' => $this->input->post('COMPONENTE_NOMBRE', TRUE),
            'COMPONENTE_SIGLA' => $this->input->post('COMPONENTE_SIGLA', TRUE),
            'COMPONENTE_ESTADO' => 1,
            'COMPONENTE_PREGUNTAS' => $this->input->post('COMPONENTE_PREGUNTAS', TRUE),
            'USUARIO_IDs' => $this->input->post('USUARIO_IDs', TRUE)
        );
        
        $insert = $this->component_model->insert_component($data);
        
        if ($insert) {
            
            $insert_2 = $this->component_model->insert_component_users($data,$insert);
            
            $this->session->set_flashdata(array('message' => 'Registro agregado con exito', 'message_type' => 'info'));
            redirect('component', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al insertar el registro', 'message_type' => 'error'));
            redirect('component', 'refresh');
        }
    }
    
    public function edit($COMPONENTE_ID) {
        $COMPONENTE_ID = deencrypt_id($COMPONENTE_ID); 

        validation_permission_role($this->module_sigla, 'permission_edit');

        $data['component'] = $this->component_model->get_component_id($COMPONENTE_ID);
        if (count($data['component']) > 0) {
            
            $data['users'] = get_dropdown($this->user_model->get_all_users_rol(), 'USUARIO_ID', 'USUARIO_NOMBRES');

            $data['title'] = 'Editar Componente';
            $data['content'] = 'component/edit';
            $this->load->view('template/template', $data);
        } else {
            $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'warning'));
            redirect('user', 'refresh');
        }
    }  
    
    public function update() {
        validation_permission_role($this->module_sigla, 'permission_edit');

        $data = array(
            'COMPONENTE_ID' => $this->input->post('COMPONENTE_ID', TRUE),
            'COMPONENTE_NOMBRE' => $this->input->post('COMPONENTE_NOMBRE', TRUE),
            'COMPONENTE_SIGLA' => $this->input->post('COMPONENTE_SIGLA', TRUE),
            'COMPONENTE_ESTADO' => 1,
            'COMPONENTE_PREGUNTAS' => $this->input->post('COMPONENTE_PREGUNTAS', TRUE),
            'USUARIO_IDs' => $this->input->post('USUARIO_IDs', TRUE)
        );
        
        $update = $this->component_model->update_component($data);
        //echo print_y($update);
        if ($update) {
            $insert_2 = $this->component_model->insert_component_users($data,$data['COMPONENTE_ID']);
            $this->session->set_flashdata(array('message' => 'Registro editado con exito', 'message_type' => 'info'));
            redirect('component', 'refresh');
        } else {
            $this->session->set_flashdata(array('message' => 'Error al editar el Registro', 'message_type' => 'warning'));
            redirect('component', 'refresh');
        }
    }         
    

    /*

      public function view($id_user = '0', $id_component = '0') {
      //VALIDAR PERMISO DEL ROL
      validation_permission_role($this->module_sigla, 'permission_view');

      if ($id_user == '0') {
      if ($this->session->userdata('ID_TIPO_USU') == 1 or $this->session->userdata('ID_TIPO_USU') == 2) {
      if ($this->session->userdata('ID_TIPO_USU') == 1) {
      //CONSULTAR USUARIOS TIPO 2 = CONSTRUCTORES DE ITEMS
      $data['users'] = get_dropdown($this->user_model->get_all_users_type(2), 'USUARIO_ID', 'NOMBRES_C');
      $data['title'] = 'Buscara Items - Seleccion del Usuario';
      $data['content'] = 'question/select_user_view';
      $this->load->view('template/template', $data);
      } else {
      redirect('/question/view/' . encrypt_id($this->session->userdata('USUARIO_ID')), 'refresh');
      }
      } else {
      $this->session->set_flashdata(array('message' => 'No Posee Permisos para Realizar esta Accion.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      } else {

      //VERIFICAR USUARIO
      $id_user = deencrypt_id($id_user);

      $components_array = $this->component_model->get_components_id_user($id_user);
      $data['components'] = get_dropdown($components_array, 'COMPONENTE_ID', 'COMPONENTE_NOMBRE');

      if (count($components_array) > 0) {
      if ($id_component == '0') {
      $data['user'] = $this->user_model->get_user_id_user($id_user);
      $data['id_user'] = $id_user;
      $data['title'] = 'Buscar Items - Seleccion del Componente';
      $data['content'] = 'question/select_component_view';
      $this->load->view('template/template', $data);
      } else {
      $data['user'] = $this->user_model->get_user_id_user($id_user);
      $id_component = deencrypt_id($id_component);
      $component_validate = $this->component_model->get_components_id_user_id_component($id_user, $id_component);

      if (count($component_validate) > 0) {
      //BUSCAR ITEMS
      //$data['component'] = $this->component_model->get_components_id($id_component);
      $data['id_component'] = $id_component;
      $data['id_user'] = $id_user;

      $data['questions'] = $this->question_model->get_questions($id_component, $id_user, $this->session->userdata("KEY_AES"), 1);

      $data['title'] = 'Buscar Items';
      $data['content'] = 'question/view';
      $this->load->view('template/template', $data);
      } else {
      $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      }
      } else {
      $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      }
      }

      public function add($id_user = '0', $id_component = '0') {

      //VALIDAR PERMISO DEL ROL
      validation_permission_role($this->module_sigla, 'permission_add');

      if ($id_user == '0') {
      if ($this->session->userdata('ID_TIPO_USU') == 1 or $this->session->userdata('ID_TIPO_USU') == 2) {
      if ($this->session->userdata('ID_TIPO_USU') == 1) {
      //CONSULTAR USUARIOS TIPO 2 = CONSTRUCTORES DE ITEMS
      $data['users'] = get_dropdown($this->user_model->get_all_users_type(2), 'USUARIO_ID', 'NOMBRES_C');
      $data['title'] = 'Agregar Nuevo Items - Seleccion del Usuario';
      $data['content'] = 'question/select_user';
      $this->load->view('template/template', $data);
      } else {
      redirect('/question/add/' . encrypt_id($this->session->userdata('USUARIO_ID')), 'refresh');
      }
      } else {
      $this->session->set_flashdata(array('message' => 'No Posee Permisos para Realizar esta Accion.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      } else {

      //VERIFICAR USUARIO
      $id_user = deencrypt_id($id_user);

      $components_array = $this->component_model->get_components_id_user($id_user);
      $data['components'] = get_dropdown($components_array, 'COMPONENTE_ID', 'COMPONENTE_NOMBRE');

      if (count($components_array) > 0) {
      if ($id_component == '0') {
      $data['user'] = $this->user_model->get_user_id_user($id_user);
      $data['id_user'] = $id_user;
      $data['title'] = 'Agregar Nuevo Items - Seleccion del Componente';
      $data['content'] = 'question/select_component';
      $this->load->view('template/template', $data);
      } else {
      $data['user'] = $this->user_model->get_user_id_user($id_user);
      $id_component = deencrypt_id($id_component);
      $component_validate = $this->component_model->get_components_id_user_id_component($id_user, $id_component);

      if (count($component_validate) > 0) {
      //REALIZACION DEL ITEM
      $data['component'] = $this->component_model->get_components_id($id_component);
      $data['id_component'] = $id_component;
      $data['id_user'] = $id_user;
      $data['title'] = 'Agregar Nuevo Item';
      $data['content'] = 'question/add';
      $this->load->view('template/template', $data);
      } else {
      $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      }
      } else {
      $this->session->set_flashdata(array('message' => 'No se encontraron componentes asociados al usuario seleccionado.', 'message_type' => 'warning'));
      redirect('/desk', 'refresh');
      }
      }
      }

      public function insert() {
      //echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';
      $PREGUNTA_ENUNCIADO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_ENUNCIADO'));
      $RESPUESTA_ENUNCIADO_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_1'));
      $RESPUESTA_JUSTIFICACION_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_1'));
      $RESPUESTA_ENUNCIADO_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_2'));
      $RESPUESTA_JUSTIFICACION_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_2'));
      $RESPUESTA_ENUNCIADO_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_3'));
      $RESPUESTA_JUSTIFICACION_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_3'));
      $RESPUESTA_ENUNCIADO_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_4'));
      $RESPUESTA_JUSTIFICACION_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_4'));
      if (
      $this->input->post('PREGUNTA_TEMA', TRUE) == '' ||
      $PREGUNTA_ENUNCIADO == '' ||
      $RESPUESTA_ENUNCIADO_1 == '' ||
      $RESPUESTA_JUSTIFICACION_1 == '' ||
      $RESPUESTA_ENUNCIADO_2 == '' ||
      $RESPUESTA_JUSTIFICACION_2 == '' ||
      $RESPUESTA_ENUNCIADO_3 == '' ||
      $RESPUESTA_JUSTIFICACION_3 == '' ||
      $RESPUESTA_ENUNCIADO_4 == '' ||
      $RESPUESTA_JUSTIFICACION_4 == ''
      ) {
      //$this->session->set_flashdata(array('message' => 'Debe Ingresar Todos los Campos Obligatorios.', 'message_type' => 'danger'));
      //redirect('/question/add/' . base64_encode(rand(11111, 99999) . $this->input->post('USUARIO_ID', TRUE)) . '/' . base64_encode(rand(11111, 99999) . $this->input->post('COMPONENTE_ID', TRUE)), 'refresh');
      }
      $data = array(
      'PREGUNTA_TEMA' => $this->input->post('PREGUNTA_TEMA', TRUE),
      'PREGUNTA_TIPOITEM' => $this->input->post('PREGUNTA_TIPOITEM', TRUE),
      'PREGUNTA_NIVELRUBRICA' => $this->input->post('PREGUNTA_NIVELRUBRICA', TRUE),
      'PREGUNTA_NIVELDIFICULTAD' => $this->input->post('PREGUNTA_NIVELDIFICULTAD', TRUE),
      'PREGUNTA_ENUNCIADO' => $PREGUNTA_ENUNCIADO,
      'PREGUNTA_IDRESPUESTA' => $this->input->post('PREGUNTA_IDRESPUESTA', TRUE),
      'PREGUNTA_OBSERVACIONES' => $this->input->post('PREGUNTA_OBSERVACIONES', TRUE),
      'RESPUESTA_ENUNCIADO_1' => $RESPUESTA_ENUNCIADO_1,
      'RESPUESTA_JUSTIFICACION_1' => $RESPUESTA_JUSTIFICACION_1,
      'RESPUESTA_ENUNCIADO_2' => $RESPUESTA_ENUNCIADO_2,
      'RESPUESTA_JUSTIFICACION_2' => $RESPUESTA_JUSTIFICACION_2,
      'RESPUESTA_ENUNCIADO_3' => $RESPUESTA_ENUNCIADO_3,
      'RESPUESTA_JUSTIFICACION_3' => $RESPUESTA_JUSTIFICACION_3,
      'RESPUESTA_ENUNCIADO_4' => $RESPUESTA_ENUNCIADO_4,
      'RESPUESTA_JUSTIFICACION_4' => $RESPUESTA_JUSTIFICACION_4,
      'PREGUNTA_IDUSUARIOCREADOR' => $this->session->userdata('USUARIO_ID'),
      'USUARIO_ID' => $this->input->post('USUARIO_ID', TRUE),
      'COMPONENTE_ID' => $this->input->post('COMPONENTE_ID', TRUE),
      );
      $insert = $this->question_model->insert_question($data, $this->session->userdata("KEY_AES"));
      if ($insert) {
      $this->session->set_flashdata(array('message' => 'Item Agregado con Exito.', 'message_type' => 'info'));
      redirect('desk', 'refresh');
      } else {
      $this->session->set_flashdata(array('message' => 'Error al Agregar el Item.', 'message_type' => 'error'));
      redirect('desk', 'refresh');
      }
      }

      public function update() {
      //echo '<pre><textarea>' . print_r($this->input->post(), true) . '</textarea></pre>';

      $question = $this->question_model->get_question($this->input->post('PREGUNTA_ID', TRUE), $this->session->userdata("KEY_AES"));

      $PREGUNTA_ENUNCIADO = str_replace('<p><br></p>', '', $this->input->post('PREGUNTA_ENUNCIADO'));

      $RESPUESTA_ENUNCIADO_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_1'));
      $RESPUESTA_JUSTIFICACION_1 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_1'));
      $RESPUESTA_ENUNCIADO_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_2'));
      $RESPUESTA_JUSTIFICACION_2 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_2'));
      $RESPUESTA_ENUNCIADO_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_3'));
      $RESPUESTA_JUSTIFICACION_3 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_3'));
      $RESPUESTA_ENUNCIADO_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_ENUNCIADO_4'));
      $RESPUESTA_JUSTIFICACION_4 = str_replace('<p><br></p>', '', $this->input->post('RESPUESTA_JUSTIFICACION_4'));
      if (
      $this->input->post('PREGUNTA_TEMA', TRUE) == '' ||
      $PREGUNTA_ENUNCIADO == '' ||
      $RESPUESTA_ENUNCIADO_1 == '' ||
      $RESPUESTA_JUSTIFICACION_1 == '' ||
      $RESPUESTA_ENUNCIADO_2 == '' ||
      $RESPUESTA_JUSTIFICACION_2 == '' ||
      $RESPUESTA_ENUNCIADO_3 == '' ||
      $RESPUESTA_JUSTIFICACION_3 == '' ||
      $RESPUESTA_ENUNCIADO_4 == '' ||
      $RESPUESTA_JUSTIFICACION_4 == ''
      ) {
      //$this->session->set_flashdata(array('message' => 'Debe Ingresar Todos los Campos Obligatorios.', 'message_type' => 'danger'));
      //redirect('/question/add/' . base64_encode(rand(11111, 99999) . $this->input->post('USUARIO_ID', TRUE)) . '/' . base64_encode(rand(11111, 99999) . $this->input->post('COMPONENTE_ID', TRUE)), 'refresh');
      }
      $data = array(
      'PREGUNTA_ID' => $this->input->post('PREGUNTA_ID', TRUE),
      'PREGUNTA_TEMA' => $this->input->post('PREGUNTA_TEMA', TRUE),
      'PREGUNTA_TIPOITEM' => $this->input->post('PREGUNTA_TIPOITEM', TRUE),
      'PREGUNTA_NIVELRUBRICA' => $this->input->post('PREGUNTA_NIVELRUBRICA', TRUE),
      'PREGUNTA_NIVELDIFICULTAD' => $this->input->post('PREGUNTA_NIVELDIFICULTAD', TRUE),
      'PREGUNTA_ENUNCIADO' => $PREGUNTA_ENUNCIADO,
      'PREGUNTA_IDRESPUESTA' => $this->input->post('PREGUNTA_IDRESPUESTA', TRUE),
      'PREGUNTA_OBSERVACIONES' => $this->input->post('PREGUNTA_OBSERVACIONES', TRUE),
      'RESPUESTA_ENUNCIADO_1' => $RESPUESTA_ENUNCIADO_1,
      'RESPUESTA_JUSTIFICACION_1' => $RESPUESTA_JUSTIFICACION_1,
      'RESPUESTA_ENUNCIADO_2' => $RESPUESTA_ENUNCIADO_2,
      'RESPUESTA_JUSTIFICACION_2' => $RESPUESTA_JUSTIFICACION_2,
      'RESPUESTA_ENUNCIADO_3' => $RESPUESTA_ENUNCIADO_3,
      'RESPUESTA_JUSTIFICACION_3' => $RESPUESTA_JUSTIFICACION_3,
      'RESPUESTA_ENUNCIADO_4' => $RESPUESTA_ENUNCIADO_4,
      'RESPUESTA_JUSTIFICACION_4' => $RESPUESTA_JUSTIFICACION_4,
      'question' => $question
      );
      $insert = $this->question_model->update_question($data, $this->session->userdata("KEY_AES"));

      if ($insert) {
      $this->session->set_flashdata(array('message' => 'Pregunta Actualizada con Exito.', 'message_type' => 'info'));
      redirect('desk', 'refresh');
      } else {
      $this->session->set_flashdata(array('message' => 'Error al Actualizar la Pregunta.', 'message_type' => 'error'));
      redirect('desk', 'refresh');
      }
      }

      public function select_user() {
      //VALIDAR PERMISO DEL ROL
      validation_permission_role($this->module_sigla, 'permission_add');
      $id_user = $this->input->post('USUARIO_ID', TRUE);
      redirect('/question/add/' . encrypt_id($id_user), 'refresh');
      }

      public function select_user_view() {
      //VALIDAR PERMISO DEL ROL
      validation_permission_role($this->module_sigla, 'permission_add');
      $id_user = $this->input->post('USUARIO_ID', TRUE);
      redirect('/question/view/' . encrypt_id($id_user), 'refresh');
      }

      public function select_component($id_user) {
      validation_permission_role($this->module_sigla, 'permission_add');
      $id_component = $this->input->post('COMPONENTE_ID', TRUE);
      redirect('/question/add/' . encrypt_id($id_user) . '/' . encrypt_id($id_component), 'refresh');
      }

      public function select_component_view($id_user) {
      validation_permission_role($this->module_sigla, 'permission_add');
      $id_component = $this->input->post('COMPONENTE_ID', TRUE);
      redirect('/question/view/' . encrypt_id($id_user) . '/' . encrypt_id($id_component), 'refresh');
      }

      public function edit($id_question) {
      //VALIDAR PERMISO DEL ROL (SIEMPRE Y CUANDO EL USUARIO NO SE EDITE A SI MISMO)
      validation_permission_role($this->module_sigla, 'permission_edit');

      $id_question = deencrypt_id($id_question);
      $data['id_question'] = $id_question;

      $data['question'] = $this->question_model->get_question($id_question, $this->session->userdata("KEY_AES"));
      if (count($data['question']) > 0) {
      $data['title'] = 'Editar Pregunta';
      $data['content'] = 'question/edit';
      $this->load->view('template/template', $data);
      } else {
      $this->session->set_flashdata(array('message' => 'Error al Consultar el Registro', 'message_type' => 'error'));
      redirect('user', 'refresh');
      }
      }

     */
}
