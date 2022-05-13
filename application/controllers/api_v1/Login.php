
<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('jwt');
		$this->load->helper('authorization');
		$this->load->helper('encodedata');
		$this->load->helper('decodedata');
		$this->load->helper('generate_token');
		$this->load->model('M_api_login');
		$this->load->helper('update_token');
		//$this->load->helper('update_tokenDriver');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Token");
	}

	public function login_post()
	{
		$captcha = $this->post('captcha');

		$secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		$ip = $_SERVER['REMOTE_ADDR'];
		// post request to server
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);

		// should return JSON with success as true
		if ($responseKeys["success"]) {
			$cek = $this->M_api_login->login($this->post('username'));

			$pass = MD5($this->post('password'));

			if ($cek != null) {
				if ($pass == $cek->password) {

					$access_token = generate_token();

					$update_token = update_token($access_token, $cek->id);

					$timestamp = time();
					$expire = $timestamp + 86400;
					if ($update_token > 0) {

						$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
						$status = parent::HTTP_OK;
						$response = [
							'status' => $status,
							'username' => $cek->name,
							'role' => $cek->role,
							'token' => $token
						];
						$this->response($response, $status);
					} else {

						$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
					}
				} else {

					$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
				}
			} else {
				$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
			}
		} else {
			$this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE); //406
		}
	}

	public function listGudangLogin_get()
	{
		$list = $this->M_api_login->listGudangLoginModel();
		if ($list != null) {
			$this->response(['data' => $list]);
		} else {
			$status = parent::HTTP_NO_CONTENT;
			$this->response(['message' => "list null"], $status);
		}
	}

	//Login apk Gudang
	public function picGudangOk_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginPicGudang($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {
					//$checkDefaultParrent = $this->M_api_login->checkDefaultParrentModel($cek->warehouse_id);
					
					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'warehouse_id' => $cek->warehouse_id,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }





	}

	public function truckKoordinator_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginKoordinator($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }





	}

	public function managerGudang_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginManagerGudang($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }





	}

	public function picCeker_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginPicCeker($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {
					$checkDefaultParrent = $this->M_api_login->checkDefaultParrentModel($cek->warehouse_id);

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'warehouse_id' => $checkDefaultParrent->id,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }





	}

	public function loginKorlap_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginKorlap($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }

	}

	//check version
	public function downloadApk_post()
	{
		$versi = $this->post('versi_apk');
		$type = $this->post('apk_type');
		$check = $this->M_api_login->checkVersiApk($versi, $type);

		if ($check == NULL) {
			$ambil = $this->M_api_login->ambilApk($type);

			$status = parent::HTTP_OK;
			$response = [
				'apk_version' => $ambil->apk_version,
				'url' => base_url() . 'assets/upload/apk/' . $ambil->apk_name
			];
			$this->response($response, $status);
		} else {
			$this->response(['msg' => 'versi android sama'], parent::HTTP_NO_CONTENT);
		}
	}

	public function loginBackOffice_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginBackOffice($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }

	}

	public function loginDriverNasional_post()
	{
		$cek = $this->M_api_login->loginDriverNasionalModel($this->post('phone'));

		$pass = md5($this->post('password'));

		if ($cek != null) {

			if ($pass == $cek->password) {

				$access_token = generate_token();

				//$update_token = update_tokenDriver($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				$update_token = 1;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name_driver, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name_driver,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
	}

	public function loginDashboard_post()
	{
		$captcha = $this->post('captcha');

		//    $secretKey = "6LfkRqgZAAAAAJq7bqYzr-UyqWd5eLUtawX3YQf5";
		//    $ip = $_SERVER['REMOTE_ADDR'];
		//    // post request to server
		//    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		//    $response = file_get_contents($url);
		//    $responseKeys = json_decode($response,true);

		//    // should return JSON with success as true
		//    if($responseKeys["success"]) {
		$cek = $this->M_api_login->loginDashboard($this->post('username'));

		$pass = MD5($this->post('password'));

		if ($cek != null) {
			if ($pass == $cek->password) {

				$access_token = generate_token();

				$update_token = update_token($access_token, $cek->id);

				$timestamp = time();
				$expire = $timestamp + 86400;
				if ($update_token > 0) {

					$token = AUTHORIZATION::generateToken(['id' => encodedata($cek->id), 'username' => $cek->name, 'token' => $access_token, 'timestamp' => $expire]);
					$status = parent::HTTP_OK;
					$response = [
						'status' => $status,
						'username' => $cek->name,
						'role' => $cek->role,
						'token' => $token
					];
					$this->response($response, $status);
				} else {

					$this->response(['msg' => 'update token failed'], parent::HTTP_NO_CONTENT);
				}
			} else {

				$this->response(['msg' => 'Invalid password!'], parent::HTTP_METHOD_NOT_ALLOWED); //405
			}
		} else {
			$this->response(['msg' => 'user tidak di temukan!'], parent::HTTP_NOT_FOUND); //404
		}
		//    } else {
		// 	   $this->response(['msg' => 'captcha error !!'], parent::HTTP_NOT_ACCEPTABLE);//406
		//    }

	}
}
