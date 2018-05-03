<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('email_confirmation_model');
		
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => 'a78ff175a40d81',
			'smtp_pass' => 'ab06e4f200f907',
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
	}
	
	public function index() {
		if($this->input->post('form_register')){
			$user = array(
				'username'	=> $this->input->post('username'),
				'first_name'=> $this->input->post('first_name'),
				'last_name'	=> $this->input->post('last_name'),
				'email'		=> $this->input->post('email'),
				'password'	=> md5($this->input->post('password'))
			);
			$user_id = $this->user_model->insert($user);

			$rand_string = $this->randomstring(30);
			$email_conf = array(
				'user_id'	=> $user_id,
				'token'		=> $rand_string
			);
			$this->email_confirmation_model->insert($email_conf);

			$this->email->from('verdian@softwareseni.com', 'Verdian');
			$this->email->to($this->input->post('email'));

			$this->email->subject('CI Test - Email Confirmation');
			$this->email->message('Please click button below for registration confirmation
				<br>
				<a href="'.site_url('register/confirm/'.$rand_string).'">
					<button>Confirm Registration</button>
				</a>');

			$this->email->send();
			$this->load->view('register');
		} else {
			$this->load->view('register');
		}
	}

    public function randomstring($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function confirm($token='') {
		$check = $this->db
					->where('token',$token)
					->where('expired >',time())
					->get('email_confirmations')
					->first_row();
		if($check) {
			$this->db
					->where('id',$check->user_id)
					->set('confirmed',time())
					->update('users');
			$status = 'success';
			$this->load->view('confirmation',[
				'status' => $status
			]);
		} else {
			$status = 'failed';
			$this->load->view('confirmation',[
				'status' => $status
			]);
		}
	} 
}
