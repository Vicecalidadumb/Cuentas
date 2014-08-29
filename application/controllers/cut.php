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
        $data['cuts'] = $this->cut_model->get_all_cuts();
        $this->load->view('template/template', $data);
    }    

}
