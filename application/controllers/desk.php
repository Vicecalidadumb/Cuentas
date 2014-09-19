<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Desk extends CI_Controller {
    
    private $module_sigla;

    public function __construct() {
       //DEFINIMOS EL NOMBRE DEL MODULO
       $this->module_sigla = 'DESK';        
        
        parent::__construct();
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        validate_login($this->session->userdata('logged_in'));
    }

    public function index() {
        $data['title'] = 'Universidad Manuela Beltran, Aplicativo de Cuentas - Escritorio.';
        $data['content'] = 'desk/index';
        $this->load->view('template/template', $data);
    }   

}
