<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
      } 
		
     function index(){
         $config = Array( 
           'protocol' => 'smtp', 
           'smtp_host' => 'ssl://smtp.googlemail.com', 
           'smtp_port' => 465, 
           'smtp_user' => 'quantri1haydi@gmail.com', 
           'smtp_pass' => 'Admin1@123', 
         ); 

        $this->load->library('email', $config); 
        $this->email->set_newline("\r\n");

        $this->email->from('quantri1haydi@gmail.com', 'admin Haydi');
        $this->email->to('megatron1st1@gmail.com');

        $this->email->subject(' My mail through codeigniter from localhost '); 
        $this->email->message('Hello World…');
        if (!$this->email->send()) {
          show_error($this->email->print_debugger()); }
        else {
          echo 'Your e-mail has been sent!';
        }
     }
} 
?>