<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoGaji extends CI_Controller {

	public function index(){
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			redirect('payroll/infogaji/listdata');
		}
	}

	public function listData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Info Gaji';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '';
			$data['gaji'] = $this->crud->selectAllOrderby('gaji','kode_slip_gaji','desc')->result();
			$data['crud'] = $this->crud;
			$this->template->view('infogaji/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Info Gaji';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '';
			$sql = '
				SELECT b.*
				FROM kehadiran a
				JOIN pegawai b ON a.id_pegawai=b.id_pegawai
				GROUP BY a.id_pegawai
			';
			$data['pegawai'] = $this->crud->getDataQuery($sql)->result();
			$data['crud'] = $this->crud;
			$data['alert'] = '';
			$this->template->view('infogaji/tambah',$data);
		}
	}

	public function kehadiran(){
		$tglawal = $this->input->post('tglawal');
		$tglakhir = $this->input->post('tglakhir');
		$id_pegawai = $this->input->post('pegawai');

		$tgl1 = '';
		$tgl2 = '';
		if($tglawal != NULL){
			$tgl1 = date('Y-m-d',strtotime($tglawal));
		}

		if($tglakhir != NULL){
			$tgl2 = date('Y-m-d',strtotime($tglakhir));
		}

		$datakehadiran = $this->crud->getDataWhere('kehadiran',array('id_pegawai'=>$id_pegawai,'waktu_kehadiran >= '=>$tgl1,'waktu_kehadiran <= '=>$tgl2))->result();

		$hit_masuk = 0;
		$hit_tdkmsk = 0;
		foreach($datakehadiran as $dk){
			$cek_hari = date('D',strtotime($dk->waktu_kehadiran));

			// hitung masuk
			if($dk->status_masuk == 1 && strtoupper($cek_hari) != "SUN"){
				$hit_masuk = $hit_masuk+1;
			}

			// hitung tdk masuk
			if($dk->status_masuk == 0 && strtoupper($cek_hari) != "SUN"){
				$hit_tdkmsk = $hit_tdkmsk+1;
			}
		}

		// Tampung data
		$tmp = array(
			'jml_hari_kerja'=>$hit_masuk,
			'jml_hari_tdkmsk'=>$hit_tdkmsk
		);

		echo json_encode($tmp);
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('tgl1','<b class="text-uppercase">Tgl Absen Awal</b>','required');
		$form->set_rules('tgl2','<b class="text-uppercase">Tgl Absen Akhir</b>','required');
		$form->set_rules('jml_hari_kerja','<b class="text-uppercase">Jml Hadir</b>','required');
		$form->set_rules('jml_hari_tdkmsk','<b class="text-uppercase">Jml Tdk Hadir</b>','required');
		$form->set_rules('gp','<b class="text-uppercase">GP</b>','required');
		$form->set_rules('tunjangan','<b class="text-uppercase">Tunjangan</b>','required');
		$form->set_rules('pot_absen','<b class="text-uppercase">Pot. Absen</b>','required');
		$form->set_rules('tot_pot_absen','<b class="text-uppercase">Total Pot. Absen</b>','required');
		$form->set_rules('gaji','<b class="text-uppercase">Gaji</b>','required');

		if($form->run() == FALSE){
			// Cek login
			if($this->session->userdata('sts_login') != true){
				redirect('Welcome');
			}else{
				$data['title'] = 'Info Gaji';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '';
				$sql = '
					SELECT b.*
					FROM kehadiran a
					JOIN pegawai b ON a.id_pegawai=b.id_pegawai
					GROUP BY a.id_pegawai
				';
				$data['pegawai'] = $this->crud->getDataQuery($sql)->result();
				$data['crud'] = $this->crud;
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$this->template->view('infogaji/tambah',$data);
			}
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('pegawai')))->row_array();
			$mydata = array(
				'id_pegawai'=>$pegawai['id_pegawai'],
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'departemen'=>$pegawai['id_departemen'],
				'penunjukan'=>$pegawai['penunjukan'],
				'tgl1'=>date('Y-m-d',strtotime($input->post('tgl1'))),
				'tgl2'=>date('Y-m-d',strtotime($input->post('tgl2'))),
				'jml_hari_kerja'=>$input->post('jml_hari_kerja'),
				'jml_hari_tdkmsk'=>$input->post('jml_hari_tdkmsk'),
				'gaji_pokok'=>$input->post('gp'),
				'gaji_tunjangan'=>$input->post('tunjangan'),
				'potongan_absensi'=>$input->post('pot_absen'),
				'total_potongan'=>$input->post('tot_pot_absen'),
				'gaji_bersih_sebelum_potongan'=>$input->post('gp')+$input->post('tunjangan'),
				'total_gaji_diterima'=>$input->post('gaji')
			);

			$this->crud->insertDataSave('gaji',$mydata);
			redirect('payroll/infogaji');
		}
	}

	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('kode_slip_gaji'=>$id),'gaji');
		redirect('payroll/infogaji');
	}

}