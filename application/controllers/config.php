<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class Config extends CI_Controller {

   private $module_sigla;

   public function __construct() {
       parent::__construct();
       //DEFINIMOS EL NOMBRE DEL MODULO
       $this->module_sigla = 'ROL';
       
       $this->load->model('config_model');
       $this->load->helper('miscellaneous');
       $this->load->helper('security');
   }


   public function index() {
       
   }

   public function roles($id_rol = 1) {
       //VALIDAR PERMISO DEL ROL
       validation_permission_role($this->module_sigla, 'permission_view');

       $data['id_rol'] = $id_rol;
       $data['role'] = $this->config_model->get_role($id_rol);
       if (count($data['role']) > 0) {
           $data['roles'] = get_dropdown($this->config_model->get_roles(), 'ID_TIPO_USU', 'NOM_TIPO_USU');
           $data['permissions'] = $this->config_model->get_rol_permissions($id_rol);
           $data['title'] = 'Permisos de Roles del Sistema';
           $data['content'] = 'config/roles';


           $this->load->view('template/template', $data);
       } else {
           $this->session->set_flashdata(array('message' => 'Error, No se encontro el Rol', 'message_type' => 'error'));
           redirect('config/roles/', 'refresh');
       }
   }

   public function roles_update() {
       //VALIDAR PERMISO DEL ROL
       validation_permission_role($this->module_sigla, 'permission_edit');

       $data['rol_id'] = $this->input->post('rol_id', TRUE);
       $data['data'] = $this->input->post();
       $this->config_model->update_roles($data);
       $this->session->set_flashdata(array('message' => 'El Rol se Actualizo con Exito', 'message_type' => 'info'));
       redirect('config/roles/' . $data['rol_id'], 'refresh');
   }

}