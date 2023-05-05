<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function getLogin(){
		$input = $this->input;
		$user = $input->post('user');
		$pass = $input->post('password');

		$login = $this->crud->getDataWhere('login',array('username'=>$user))->row_array();
		if(count($login) > 0){
			if(strtoupper($login['username']) == strtoupper($user) && strtoupper($login['pass']) == strtoupper($pass)){
				$ses_set = array(
					'id_pegawai'=>$login['id_pegawai'],
					'username'=>$login['username'],
					'nama'=>$login['nama_pegawai'],
					'hak_akses'=>$login['hak_akses'],
					'sts_login'=>true
				);

				$this->session->set_userdata($ses_set);

				// $respon = array(
				// 	'code'=>0,
				// 	'message'=>'Selamat datang User '.strtoupper($login['nama'])
				// );

				$respon = '<div class="alert alert-success">Selamat datang '.$ses_set['nama'].'</div>';
			}else{
				// $respon = array(
				// 	'code'=>1,
				// 	'message'=>'Password salah'
				// );

				$respon = '<div class="alert alert-warning">Username / password </div>';
			}
		}else{
			// $respon = array(
			// 	'code'=>1,
			// 	'message'=>'User tidak ditemukan'
			// );

			$respon = '<div class="alert alert-danger">User tidak ditemukan</div>';
		}

		//header('Access-Control-Allow-Origin: *');
		//echo json_encode($respon);
		echo $respon;
	}

	public function getLogout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}