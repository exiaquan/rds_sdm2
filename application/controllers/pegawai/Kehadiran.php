<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Kehadiran';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'kehadiran">Kehadiran</a></li>
			';
			$data['kehadiran'] = $this->crud->selectAllOrderby('kehadiran','tanggal','asc')->result();
			$this->template->view('kehadiran/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Kehadiran';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'kehadiran">Kehadiran</a></li>
			';
			$data['pegawai'] = $this->crud->getDataWhere('pegawai',array('upper(status)'=>'AKTIF'))->result();
			$data['alert'] = '';
			$this->template->view('kehadiran/tambah',$data);
		}
	}

	public function nol($v){
		if($v < 10){return "0".$v;}
		else{return $v;}
	}

	public function saveData(){
		$input = $this->input;
		$form = $this->form_valid;

		$form->set_rules('pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('tanggal','<b class="text-uppercase">Tanggal</b>','required');
		$form->set_rules('status','<b class="text-uppercase">Status</b>','required');
		$form->set_rules('masuk_jam','<b class="text-uppercase">Masuk (Jam)</b>','required');
		$form->set_rules('masuk_menit','<b class="text-uppercase">Masuk (Menit)</b>','required');
		$form->set_rules('masuk_detik','<b class="text-uppercase">Masuk (Detik)</b>','required');
		$form->set_rules('keluar_jam','<b class="text-uppercase">Keluar (Jam)</b>','required');
		$form->set_rules('keluar_menit','<b class="text-uppercase">Keluar (Menit)</b>','required');
		$form->set_rules('keluar_detik','<b class="text-uppercase">Keluar (Detik)</b>','required');
		$form->set_rules('terlambat','<b class="text-uppercase">Terlambat</b>','required');

		if($form->run() == FALSE){
			$data['title'] = 'Kehadiran';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'kehadiran">Kehadiran</a></li>
			';
			$data['pegawai'] = $this->crud->getDataWhere('pegawai',array('upper(status)'=>'AKTIF'))->result();
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$this->template->view('kehadiran/tambah',$data);
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id'=>$input->post('pegawai')))->row_array();
			
			$tgl = $input->post('tanggal');
			$tanggal = NULL;

			if($tgl != NULL){
				$tanggal = date('Y-m-d',strtotime($tgl));
			}

			$mydata = array(
				'id_pegawai'=>$input->post('pegawai'),
				'nama'=>strtoupper($pegawai['nama']),
				'tanggal'=>$tanggal,
				'status'=>strtoupper($input->post('status')),
				'masuk'=>$this->nol($input->post('masuk_jam')).':'.$this->nol($input->post('masuk_menit')).':'.$this->nol($input->post('masuk_detik')),
				'keluar'=>$this->nol($input->post('keluar_jam')).':'.$this->nol($input->post('keluar_menit')).':'.$this->nol($input->post('keluar_detik')),
				'terlambat'=>strtoupper($input->post('terlambat')),
				'ijin'=>strtoupper($input->post('ijin'))
			);

			$respon = $this->crud->insertDataSave('kehadiran',$mydata);
			if($respon['code'] == 0){
				$data['title'] = 'Kehadiran';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '
					<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'kehadiran">Kehadiran</a></li>
				';
				$data['pegawai'] = $this->crud->getDataWhere('pegawai',array('upper(status)'=>'AKTIF'))->result();
				$data['alert'] = '<div class="alert alert-success">'.$respon['message'].'</div>';
				$this->template->view('kehadiran/tambah',$data);

				redirect('pegawai/kehadiran');
			}else{
				$data['title'] = 'Kehadiran';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '
					<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'kehadiran">Kehadiran</a></li>
				';
				$data['pegawai'] = $this->crud->getDataWhere('pegawai',array('upper(status)'=>'AKTIF'))->result();
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$this->template->view('kehadiran/tambah',$data);				
			}
		}

	}

}