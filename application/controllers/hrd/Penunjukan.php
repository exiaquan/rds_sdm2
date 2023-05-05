<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjukan extends CI_Controller {

	public function index(){
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			redirect('hrd/penunjukan/listdata');
		}
	}

	public function listData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Penunjukan';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
			';
			$data['penunjukan'] = $this->crud->selectAllOrderby('penunjukan','kode_penunjukan','asc')->result();
			$this->template->view('penunjukan/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Penunjukan';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
				<li class="active"><a href="'.base_url().'penunjukan/tambah">Tambah</a></li>
			';
			$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

			// Temp data
			$mydata = array(
				'kode_penunjukan'=>'',
				'id_departemen'=>'',
				'departemen'=>'',
				'penunjukan'=>'',
				'keterangan'=>''
			);

			$data['mydata'] = $mydata;
			$data['alert'] = '';
			$this->template->view('penunjukan/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('kode_penunjukan','<b class="text-uppercase">Kode</b>','required|is_unique[penunjukan.kode_penunjukan]');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('penunjukan','<b class="text-uppercase">Penunjukan</b>','required');

		// Temp data
		$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		$mydata = array(
			'kode_penunjukan'=>strtoupper($input->post('kode_penunjukan')),
			'id_departemen'=>strtoupper($departemen['id_departemen']),
			'departemen'=>strtoupper($departemen['departemen']),
			'penunjukan'=>strtoupper($input->post('penunjukan')),
			'keterangan'=>strtoupper($input->post('keterangan'))
		);

		if($form->run() == FALSE){
			$data['title'] = 'Penunjukan';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
				<li class="active"><a href="'.base_url().'penunjukan/tambah">Tambah</a></li>
			';
			$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

			$data['mydata'] = $mydata;
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$this->template->view('penunjukan/tambah',$data);
		}else{
			$respon = $this->crud->insertDataSave('penunjukan',$mydata);

			if($respon['code'] == 0){
				$data['title'] = 'Penunjukan';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
					<li class="active"><a href="'.base_url().'penunjukan/tambah">Tambah</a></li>
				';
				$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();
				$data['mydata'] = $mydata;
				$data['alert'] = '<div class="alert alert-success">'.$respon['message'].'</div>';
				$this->template->view('penunjukan/tambah',$data);
				redirect('hrd/penunjukan');
			}else{
				$data['title'] = 'Penunjukan';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
					<li class="active"><a href="'.base_url().'penunjukan/tambah">Tambah</a></li>
				';
				$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();
				$data['mydata'] = $mydata;
				$data['alert'] = '<div class="alert alert-success">'.$respon['message'].'</div>';
				$this->template->view('penunjukan/tambah',$data);
			}
		}
	}

	public function update(){
		$id = $this->input->get('id');

		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Penunjukan';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
				<li class="active"><a href="'.base_url().'penunjukan/update?id='.$id.'">Update</a></li>
			';
			$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

			// Temp data
			// $mydata = array(
			// 	'kode_penunjukan'=>'',
			// 	'id_departemen'=>'',
			// 	'departemen'=>'',
			// 	'penunjukan'=>'',
			// 	'keterangan'=>''
			// );

			$mydata = $this->crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$id))->row_array();

			$data['mydata'] = $mydata;
			$data['alert'] = '';
			$this->template->view('penunjukan/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;
		$id = $input->post('kode_penunjukan');

		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('penunjukan','<b class="text-uppercase">Penunjukan</b>','required');

		// Temp data
		$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		
		$whr = array(
			'kode_penunjukan'=>strtoupper($input->post('kode_penunjukan'))
		);

		$mydata = array(
			'id_departemen'=>strtoupper($departemen['id_departemen']),
			'departemen'=>strtoupper($departemen['departemen']),
			'penunjukan'=>strtoupper($input->post('penunjukan')),
			'keterangan'=>strtoupper($input->post('keterangan'))
		);

		if($form->run() == FALSE){
			$data['title'] = 'Penunjukan';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
				<li class="active"><a href="'.base_url().'penunjukan/update?id='.$id.'">Update</a></li>
			';
			$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

			$data['mydata'] = $this->crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$id))->row_array();
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$this->template->view('penunjukan/update',$data);
		}else{
			$respon = $this->crud->updData('penunjukan',$whr,$mydata);

			if($respon['code'] == 0){
				$data['title'] = 'Penunjukan';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
					<li class="active"><a href="'.base_url().'penunjukan/update?id='.$id.'">Update</a></li>
				';
				$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

				$data['mydata'] = $this->crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$id))->row_array();
				$data['alert'] = '<div class="alert alert-success">'.$respon['message'].'</div>';
				$this->template->view('penunjukan/update',$data);
				redirect('hrd/penunjukan');
			}else{
				$data['title'] = 'Penunjukan';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'penunjukan"><i class="fa fa-dashboard"></i> Penunjukan</a></li>
					<li class="active"><a href="'.base_url().'penunjukan/update?id='.$id.'">Update</a></li>
				';
				$data['departemen'] = $this->crud->selectAllOrderby('departemen','id_departemen','asc')->result();

				$data['mydata'] = $this->crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$id))->row_array();
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$this->template->view('penunjukan/update',$data);
			}
		}
	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('kode_penunjukan'=>$id),'penunjukan');
		redirect('hrd/penunjukan');
	}
}