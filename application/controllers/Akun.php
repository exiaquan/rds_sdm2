<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function listAkun(){
		
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Akun';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'akun"><i class="fa fa-dashboard"></i> Akun</a></li>
        		<!--<li class="active">Invoice</li>-->
			';
			$data['login'] = $this->crud->selectAllOrderby('login','id_pegawai','asc')->result();
			$this->template->view('akun/index',$data);
		}
	
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Akun';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'akun"><i class="fa fa-dashboard"></i> Akun</a></li>
        		<li class="active"><a href="'.base_url().'akun">Tambah</a></li>
			';
			$data['pegawai'] = $this->crud->selectAllOrderby('pegawai','id_pegawai','asc')->result();
			$data['alert'] = '';
			$this->template->view('akun/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('id_pegawai','<b class="text-uppercase">Pegawai</b>','required|is_unique[login.id_pegawai]');
		$form->set_rules('username','<b class="text-uppercase">Username</b>','required');
		$form->set_rules('pass','<b class="text-uppercase">Password</b>','required');
		$form->set_rules('hak_akses','<b class="text-uppercase">Hak Akses</b>','required');

		if($form->run() == FALSE){
			$data['title'] = 'Akun';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'akun"><i class="fa fa-dashboard"></i> Akun</a></li>
        		<li class="active"><a href="'.base_url().'akun">Tambah</a></li>
			';
			$data['pegawai'] = $this->crud->selectAllOrderby('pegawai','id_pegawai','asc')->result();
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$this->template->view('akun/tambah',$data);
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
			$data = array(
				'id_pegawai'=>$input->post('id_pegawai'),
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'username'=>$input->post('username'),
				'pass'=>$input->post('pass'),
				'hak_akses'=>$input->post('hak_akses')
			);

			$this->crud->insertDataSave('login',$data);
			redirect('akun/listakun');
		}
	}

	public function update(){
		$id = $this->input->get('id');

		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Akun';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'akun"><i class="fa fa-dashboard"></i> Akun</a></li>
        		<li class="active"><a href="'.base_url().'akun/update?id='.$id.'">Update</a></li>
			';
			$data['login'] = $this->crud->getDataWhere('login',array('id_pegawai'=>$id))->row_array();
			$data['alert'] = '';
			$this->template->view('akun/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;
		$id = $input->post('id_pegawai');

		$form->set_rules('username','<b class="text-uppercase">Username</b>','required');
		$form->set_rules('pass','<b class="text-uppercase">Password</b>','required');
		$form->set_rules('hak_akses','<b class="text-uppercase">Hak Akses</b>','required');

		if($form->run() == FALSE){
			$data['title'] = 'Akun';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'akun"><i class="fa fa-dashboard"></i> Akun</a></li>
        		<li class="active"><a href="'.base_url().'akun/update?id='.$id.'">Update</a></li>
			';
			$data['login'] = $this->crud->getDataWhere('login',array('id_pegawai'=>$id))->row_array();
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$this->template->view('akun/update',$data);
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
			$whr = array('id_pegawai'=>$input->post('id_pegawai'));
			$data = array(
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'username'=>$input->post('username'),
				'pass'=>$input->post('pass'),
				'hak_akses'=>$input->post('hak_akses')
			);

			$this->crud->updData('login',$whr,$data);
			redirect('akun/listakun');
		}
	}

}