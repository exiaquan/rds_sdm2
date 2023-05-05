<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends CI_Controller {

	public function index(){
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			redirect('perizinan/lembur/listdata');
		}
	}

	public function listData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Lembur';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '';
			$data['lembur'] = $this->crud->selectAllOrderby('lembur','kode_lembur','asc')->result();
			$this->template->view('lembur/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Lembur';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '';
			$data['alert'] = '';
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			//$data['departemen'] = $this->crud->selectAll('departemen')->result();
			//$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('lembur/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('tgl','<b class="text-uppercase">Tanggal</b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">Keterangan</b>','required');

		if($form->run() == FALSE){
			// Cek login
			if($this->session->userdata('sts_login') != true){
				redirect('Welcome');
			}else{
				$data['title'] = 'Lembur';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				//$data['departemen'] = $this->crud->selectAll('departemen')->result();
				//$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('lembur/tambah',$data);
			}
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('pegawai')))->row_array();
			$mydata = array(
				'id_pegawai'=>$pegawai['id_pegawai'],
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'departemen'=>$pegawai['id_departemen'],
				'penunjukan'=>$pegawai['penunjukan'],
				'tgl_lembur'=>date('Y-m-d',strtotime($input->post('tgl'))),
				'keterangan'=>strtoupper($input->post('keterangan'))
			);
			$this->crud->insertDataSave('lembur',$mydata);
			redirect('perizinan/lembur');
		}
	}

	public function update(){
		$id = $this->input->get('id');

		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Lembur';
			$data['sub_title'] = 'Update';
			$data['breadcrumb'] = '';
			$data['alert'] = '';
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['mydata'] = $this->crud->getDataWhere('lembur',array('kode_lembur'=>$id))->row_array();
			//$data['departemen'] = $this->crud->selectAll('departemen')->result();
			//$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('lembur/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;
		$id = $this->input->post('kode');

		$form->set_rules('pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('tgl','<b class="text-uppercase">Tanggal</b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">Keterangan</b>','required');

		if($form->run() == FALSE){
			// Cek login
			if($this->session->userdata('sts_login') != true){
				redirect('Welcome');
			}else{
				$data['title'] = 'Lembur';
				$data['sub_title'] = 'Update';
				$data['breadcrumb'] = '';
				$data['alert'] = '';
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				$data['mydata'] = $this->crud->getDataWhere('lembur',array('kode_lembur'=>$id))->row_array();
				//$data['departemen'] = $this->crud->selectAll('departemen')->result();
				//$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('lembur/update',$data);
			}
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('pegawai')))->row_array();
			$wdata = array('kode_lembur'=>strtoupper($id));
			$mydata = array(
				'id_pegawai'=>$pegawai['id_pegawai'],
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'departemen'=>$pegawai['id_departemen'],
				'penunjukan'=>$pegawai['penunjukan'],
				'tgl_lembur'=>date('Y-m-d',strtotime($input->post('tgl'))),
				'keterangan'=>strtoupper($input->post('keterangan'))
			);
			$this->crud->updData('lembur',$wdata,$mydata);
			redirect('perizinan/lembur');
		}
	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('kode_lembur'=>$id),'lembur');
		redirect('perizinan/lembur');
	}
	public function pdfGen(){
		// Load library MPDF
		$this->load->library('M_pdf');
		$mpdf = $this->m_pdf->pdf;

		// Content
		$id = $this->input->get('id');
		$mydata = $this->crud->getDataWhere('lembur',array('kode_lembur'=>$id))->row_array();
		$data['mydata'] = $mydata;
		$data['crud'] = $this->crud;
		$this->load->view('lembur/pdfgen',$data);

		// Output
		$html = $this->output->get_output();
		$mpdf->WriteHTML($html);
 	 	$mpdf->Output();
	}

}