<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Departemen';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'departemen"><i class="fa fa-dashboard"></i> Departemen</a></li>
			';
			$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();
			$this->template->view('departemen/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Departemen';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'departemen"><i class="fa fa-dashboard"></i> Departemen</a></li>
				<li><a href="'.base_url().'departemen/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$this->template->view('departemen/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_departemen','<b class="text-uppercase">ID</b>','required|is_unique[pegawai.id_pegawai]');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('kpl_departemen','<b class="text-uppercase">Kpl Departemen/b','required');
		$form->set_rules('divisi','<b class="text-uppercase">Divisi</b>','required');

		// Hitung pegawai
		$totalpegawai = $this->crud->getDataWhere('pegawai',array('id_departemen'=>$input->post('id_departemen')))->num_rows();

		// Temp data
		$mydata = array(
			'id_departemen'=>strtoupper($input->post('id_departemen')),
			'departemen'=>strtoupper($input->post('departemen')),
			'kpl_departemen'=>strtoupper($input->post('kpl_departemen')),
			'divisi'=>strtoupper($input->post('divisi')),
			'total_pegawai'=>$totalpegawai
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Tambah';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'departemen"><i class="fa fa-dashboard"></i> Departemen</a></li>
				<li><a href="'.base_url().'departemen/tambah">Tambah</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$data['mydata'] = $mydata;
			$this->template->view('departemen/tambah',$data);
			//}
		}else{
			$respon = $this->crud->insertDataSave('departemen',$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('departemen');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'departemen"><i class="fa fa-dashboard"></i> Departemen</a></li>
					<li><a href="'.base_url().'departemen/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$data['mydata'] = $mydata;
				$this->template->view('departemen/tambah',$data);
				//}
			}
		}
	}
}