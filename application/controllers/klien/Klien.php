<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klien extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 2){
				redirect('klien/Klien/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Klien';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'clien/Klien"><i class="fa fa-dashboard"></i> Klien</a></li>
				';
				$data['klien'] = $this->crud->selectAllOrderby('klien','id_klien','asc')->result();
				$data['crud'] = $this->crud;
				$this->template->view('klien/index',$data);
			}
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Data Klien';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'klien/klien"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'klien/klien/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$mydata = array(
				'id_departemen'=>'',
				'dvisi'=>'',
				'naam_klien'=>'',
				'telepon'=>'',
				'email'=>'',
				'website'=>''
			);
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$this->template->view('klien/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_departemen','<b class="text-uppercase">ID Departemen</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">DEPARTEMEN</b>','required');
		$form->set_rules('nama_klien','<b class="text-uppercase">Nama Klien</b>','required');
		$form->set_rules('telepon','<b class="text-uppercase">Telepon</b>','required');
		$form->set_rules('email','<b class="text-uppercase">Email/b>','required');
		$form->set_rules('website','<b class="text-uppercase">Website</b>','required');

		$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		$mydata = array(
			'id_departemen'=>strtoupper($input->post('id_departemen')),
			'divisi'=>strtoupper($input->post('departemen')),
			'nama_klien'=>strtoupper($input->post('nama_klien')),
			'telepon'=>strtoupper($input->post('telepon')),
			'email'=>$input->post('email'),
			'website'=>$input->post('website')
		);
		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Tambah';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'clien/Klien"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'clien/klien/tambah">Tambah</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$this->template->view('clien/Klien',$data);
			//}
		}else{
			$respon = $this->crud->insertDataSave('klien',$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('clien/klien');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'clien/Klien"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li class="active"><a href="'.base_url().'clien/klien/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$data['mydata'] = $mydata;
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$this->template->view('klien/tambah',$data);
				//}
			}
		}

	}

	public function update(){
		$id = $this->input->get('id');

		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Data Klien';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
				<li class="active"><a href="'.base_url().'clien/klien/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$mydata = $this->crud->getDataWhere('klien',array('id_klien'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$this->template->view('klien/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_departemen','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('nama_departemen','<b class="text-uppercase">NAMA PEGAWAI</b>','required');
		$form->set_rules('nama_klien','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('telepon','<b class="text-uppercase">Divisi</b>','required');
		$form->set_rules('email','<b class="text-uppercase">No Rek</b>','required');
		$form->set_rules('website','<b class="text-uppercase">NAMA BANK</b>','required');

	
	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();

	  	$whr = array('id_klien'=>$input->post('id_klien'));
		  $mydata = array(
			'id_departemen'=>strtoupper($input->post('id_departemen')),
			'departemen'=>strtoupper($input->post('departemen')),
			'nama_klien'=>strtoupper($input->post('nama_klien')),
			'telepon'=>strtoupper($input->post('telepon')),
			'email'=>$input->post('email'),
			'website'=>$input->post('website')
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Data Klien';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'klien/datapklien"><i class="fa fa-dashboard"></i> Pegawai</a></li>
				<li><a href="'.base_url().'clien/klien/update?">Data Klien</a></li>
			';
			$mydata = $this->crud->getDataWhere('klien',array('id_klien'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$this->template->view('klien/update',$data);
			//}
		}else{
			$respon = $this->crud->updData('klien',$whr,$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('pegawai/datapegawai');
			}else{

				$data['title'] = 'Data Pegawai';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'pegawai/datapegawai/update?id='.$id.'">Data Pegawai</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$mydata = $this->crud->getDataWhere('klien',array('id_klien'=>$id))->row_array();
				$data['mydata'] = $mydata;
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$this->template->view('klien/update',$data);
			}
		}

	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('id_kliwn'=>$id),'');
		redirect('clien/klien');
	}

}