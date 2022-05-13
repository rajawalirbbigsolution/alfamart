<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('session');
		$this->load->helper('decodedata');
		$this->load->helper('encodedata');
	}

	public function index()
	{
		if (!$this->session->userdata('userid') || !$this->session->userdata('name')) {
			$this->load->view('login/login');
		} else {
			redirect($this->session->userdata('menu')[0]->module_url);
			// var_dump($this->session->userdata('menu')[0]->module_url);
		}
	}

	public function cek_data()
	{
		$token = $this->input->post("g-recaptcha-response");
		$RECAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
		$RECAPTCHA_SECRET = "6LdlTsAZAAAAAOlc5gBxyZWuOyfCEL1xhViZq8FB";

		$recaptcha = file_get_contents($RECAPTCHA_URL . '?secret=' . $RECAPTCHA_SECRET . '&response=' . $token);
		$recaptcha = json_decode($recaptcha);
		
		if ($recaptcha->score >= 0.5) {
			$name = $this->input->post("name");
			$password = md5($this->input->post("password"));

			$user = $this->M_login->getUser($name);


			$alert = "";
			if (count($user) > 0) {
				if ($password == $user[0]->password) {
					$menu_list = $this->M_login->getMenu($user[0]->id);
					$sessiondata = array(
						'userid' => $user[0]->id,
						'name' => $user[0]->name,
						'role' => $user[0]->role,
						'provinsi' => $user[0]->provinsi,
						'warehouse_id' => $user[0]->warehouse_id,
						'menu' => $menu_list,
					);

					$this->session->set_userdata($sessiondata);
					$cookie = array(
						'name'   => 'id',
						'value'  => $user[0]->id,
						'expire' => '86500'
					);
					$this->input->set_cookie($cookie);
					redirect('Data');
				} else {
					$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed | </strong> User tidak ditemukan.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				}
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed | </strong> Data user tidak ditemukan.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
			}

			$this->session->set_flashdata('notice', $alert);
			redirect('Login');
		} else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed | </strong> Captcha invalid.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Login');
		}
	}

	public function logout()
	{
		$sessiondata = array(
			'userid' => "",
			'name' => "",
			'role' => ""
		);
		$this->session->unset_userdata($sessiondata);
		$this->session->sess_destroy();
		redirect('Login');
	}
	public function ForgotPassword()
	{
		$this->load->view('login/forgotpwd');
	}

	function send()
	{
		$token = $this->input->post("g-recaptcha-response");
		$RECAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
		$RECAPTCHA_SECRET = "6LeFJP0UAAAAADYRqbz9kTBWk9JueAbgmxKVN9Sa";
		$recaptcha = file_get_contents($RECAPTCHA_URL . '?secret=' . $RECAPTCHA_SECRET . '&response=' . $token);
		$recaptcha = json_decode($recaptcha);
		if ($recaptcha->score >= 0.5) {
			$email_penerima = $this->input->post('email_penerima');
			$this->db->where('email', $email_penerima);
			$query = $this->db->get('ms_user');
			if (count($query->result()) > 0) {
				$this->load->library('mailer');
				$random_char = '0123456789abcdefghijklmnopqrstuvwxyzACDEFGHIJKLMNOPQRSTUVWXYZ';
				$rand = substr(str_shuffle($random_char), 0, 6);

				$password1 = $rand;
				$password = md5($password1);
				$subjek = 'Forget Password DNR BANSOS';
				$content = $this->load->view('login/template_email', array('password' => $password1), true);

				$sendmail = array(
					'email_penerima' => $email_penerima,
					'subjek' => $subjek,
					'content' => $content,
				);

				$send = $this->mailer->send($sendmail);
				$update = date("d/m/Y h:i:s");
				$this->db->set('password', $password);
				$this->db->set('updated_date', $update);
				$this->db->where('email', $email_penerima);
				$this->db->update('ms_user');

				$alert = '<div class="alert alert-success alert-dismissible fade show" role="alart">
							<strong>Berhasil | </strong> Silahkan Cek Email Anda.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				$this->session->set_flashdata('notice', $alert);
				redirect('Login');
				echo "<b>" . $send['status'] . "</b><br />";
				echo $send['message'];
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed | </strong>Email tidak ditemukan.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						</div>';
				$this->session->set_flashdata('notice', $alert);
				redirect('Login/ForgotPassword');
			}
		} else {
			$alert =
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Failed | </strong> Captcha invalid.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
			$this->session->set_flashdata('notice', $alert);
			redirect('Login/ForgotPassword');
		}
	}
}
