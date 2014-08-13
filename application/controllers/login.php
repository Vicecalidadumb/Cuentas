<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('config_model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        //$this->load->library('My_PHPMailer');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('desk', 'refresh');
        } else {
            $this->load->view('login/index');
        }
    }

    public function remember_pin() {
        $this->load->view('login/pin');
    }

    public function remember_pin_send() {
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $user = $this->user_model->get_user_email($email, $username);
        //$mail = 
        if (sizeof($user) > 0) {
            //echo '<pre>' . print_r($user, true) . '</pre>';

            $mails_destinations = array("yeison.arias@umb.edu.co" => "Yeison Hernando Arias Melo");
            $subject= "Recordatorio PIN - Convocatoria Defensoria del Pueblo<br><br>";
            $message= "Sr(a). <strong>".$user[0]->USUARIO_NOMBRES.' '.$user[0]->USUARIO_APELLIDOS."</strong><br><br>";
            $message.= "Recibimos en la Universidad Manuela Beltr&aacute;n una solicitud para recordatorio de PIN.<br>";
            $message.= "Su numero de PIN es: <strong>".$user[0]->INSCRIPCION_PIN."</strong><br><br><br>";
            $message.= "<span style='color: #328bb0;font-size: 11px;'>Antes de imprimir este e-mail piense bien si es necesario hacerlo. 
            La protecci&oacute;n del medio ambiente es compromiso de todos.<br><br>
            Aviso de Confidencialidad de Email :Este mensaje puede contener informaci&oacute;n privilegiada y/o confidencial. 
            Si usted no es el destinatario indicado en este mensaje (o el responsable de hacer llegar este mensaje al destinatario), 
            no est&aacute; autorizado para copiar o entregar este mensaje a ninguna persona. En este caso, deber&aacute; destruir 
            este mensaje y se le ruega que avise al remitente por e-mail. Por favor, av&iacute;senos de inmediato si usted o su empresa 
            no admite la utilizaci&oacute;n de correo electr&oacute;nico por Internet para mensajes de este tipo. Cualquier opini&oacute;n, 
            conclusi&oacute;n, u otra informaci&oacute;n contenida en este mensaje, que no est&eacute; relacionada con las actividades 
            oficiales de nuestra firma, deber&aacute; considerarse como nunca proporcionada o aprobada por la firma.
            <br><br>
            Internet Email Confidentiality Footer :Privileged/Confidential information may be contained in this message. 
            If you are not the addressee indicated in this message (or responsible for delivery of the message to such person), 
            you may not copy or deliver this message to anyone. In such case, you should destroy this message and kindly notify 
            the sender by reply email. Please advise immediately if you or you employer does not consent to internet email for 
            messages of this kind. Opinions, conclusions and other information in this message that are not related to the 
            official business of my firm shall be understood as neither given nor endorsed by it.</span>";
            
            $path_attachment = array();
            $mail_hostdime = 'vicecalidad@umb.edu.co';

            send_mail($mails_destinations, $subject, $message, $path_attachment, $mail_hostdime);
            
            $this->session->set_flashdata(array('message' => 'Su PIN a sido enviado al correo electronico '.$user[0]->USUARIO_CORREO.', por favor revise la carpeta de Spam ya que hotmail y/o otros puede poner nuestro email en esta carpeta de Spam', 'message_type' => 'danger'));
            redirect('', 'refresh');            
        } else {
            $this->session->set_flashdata(array('message' => 'Error al consultar el registro, por favor intente nuevamente', 'message_type' => 'warning'));
            redirect('login/remember_pin', 'refresh');
        }
    }

    public function make_hash($var = 1) {
        echo make_hash($var);
    }

    public function politicasok() {
        $this->session->set_userdata('politicas', TRUE);
        redirect('particles', 'location');
    }

    public function verify() {
        $username = $this->input->post('username');
        $pass = strip_tags(utf8_decode($this->input->post('password')));
        $user = $this->user_model->get_user_documento($username);
        $user_loginpin = $this->user_model->get_user_loginpin($username, $pass);

        if (sizeof($user) > 0) {

            //if (verifyHash($pass, $user[0]->USUARIO_CLAVE) || check_password($pass, $user[0]->USUARIO_CLAVE) || $pass==$user[0]->USUARIO_CLAVE2) {
            if (sizeof($user_loginpin) > 0) {

                //OBTENER PERMISOS DE MODULOS PARA EL ROL ACTUAL
                $rol_permissions = $this->config_model->get_rol_permissions($user[0]->ID_TIPO_USU, 'SIGLA_MODULO');

                //echo print_r($user,true);
                $newdata = array(
                    'USUARIO_ID' => $user_loginpin[0]->USUARIO_ID,
                    'USUARIO_NOMBRES' => $user_loginpin[0]->USUARIO_NOMBRES,
                    'USUARIO_APELLIDOS' => $user_loginpin[0]->USUARIO_APELLIDOS,
                    'USUARIO_TIPODOCUMENTO' => $user_loginpin[0]->USUARIO_TIPODOCUMENTO,
                    'USUARIO_NUMERODOCUMENTO' => $user_loginpin[0]->USUARIO_NUMERODOCUMENTO,
                    'USUARIO_CORREO' => $user_loginpin[0]->USUARIO_CORREO,
                    'USUARIO_GENERO' => $user_loginpin[0]->USUARIO_GENERO,
                    'USUARIO_FECHADENACIMIENTO' => $user_loginpin[0]->USUARIO_FECHADENACIMIENTO,
                    'USUARIO_DIRECCIONRESIDENCIA' => $user_loginpin[0]->USUARIO_DIRECCIONRESIDENCIA,
                    'USUARIO_TELEFONOFIJO' => $user_loginpin[0]->USUARIO_TELEFONOFIJO,
                    'USUARIO_CELULAR' => $user_loginpin[0]->USUARIO_CELULAR,
                    'USUARIO_ESTADO' => $user_loginpin[0]->USUARIO_ESTADO,
                    'USUARIO_FECHAINGRESO' => $user_loginpin[0]->USUARIO_FECHAINGRESO,
                    'CONVOCATORIA_NOMBRE' => $user_loginpin[0]->CONVOCATORIA_NOMBRE,
                    'CONVOCATORIA_ID' => $user_loginpin[0]->CONVOCATORIA_ID,
                    'INSCRIPCION_PIN' => $user_loginpin[0]->INSCRIPCION_PIN,
                    'ID_TIPO_USU' => $user_loginpin[0]->ID_TIPO_USU,
                    'rol_permissions' => $rol_permissions,
                    'logged_in' => TRUE,
                    'politicas' => FALSE
                );
                //echo print_r($newdata,true);

                $this->session->set_userdata($newdata);
                //echo print_y($this->session->userdata('logged_in'));
                redirect('desk', 'location');
            } else {
                $this->session->set_flashdata(array('message' => '<strong>Error:</strong> Pin Incorrecto.', 'message_type' => 'danger'));
                redirect('', 'refresh');
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Su n&uacute;mero de documento no se encuentra registrado en el sistema, por favor reg&iacute;strese dando clic en el boton "Registrarse"', 'message_type' => 'warning'));
            redirect('', 'refresh');
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        //$this->load->view('login/index');
        redirect('login', 'location');
    }

}
