<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkunBank extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('bank/AkunBank/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Akun Bank';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'bank/AkunBank"><i class="fa fa-dashboard"></i> Akun Bank</a></li>
				';
				$data['akunbank'] = $this->crud->selectAllOrderby('akun_bank','id_akun','asc')->result();
				$data['crud'] = $this->crud;
				$this->template->view('bank/index',$data);
			}
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Data Akun Bank';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'bank/akunbank"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'bank/akunbank/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$mydata = array(
				'id_pegawai'=>'',
				'nama_pegawai'=>'',
				'departemen'=>'',
				'divisi'=>'',
				'no_rekening'=>'',
				'nama_bank'=>'',
				'nama_akun'=>'',
				'keterangan'=>''
			);
			$data['mydata'] = $mydata;
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('bank/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('divisi','<b class="text-uppercase">Divisi</b>','required');
		$form->set_rules('no_rek','<b class="text-uppercase">No Rek</b>','required');
		$form->set_rules('nama_bank','<b class="text-uppercase">NAMA BANK</b>','required');
		$form->set_rules('nama_akun','<b class="text-uppercase">NAMA AKUN</b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">KETERANGAN</b>','required');

		
	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();

		$mydata = array(
			'id_pegawai'=>strtoupper($input->post('id_pegawai')),
			'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
			'departemen'=>strtoupper($input->post('departemen')),
			'divisi'=>strtoupper($input->post('divisi')),
			'no_rekening'=>strtoupper($input->post('no_rek')),
			'nama_bank'=>$input->post('nama_bank'),
			'nama_akun'=>strtoupper($input->post('nama_akun')),
			'keterangan'=>$input->post('keterangan')
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Tambah';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'bank/AkunBank"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'bank/akunbank/tambah">Tambah</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$data['mydata'] = $mydata;
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('bank/tambah',$data);
			//}
		}else{
			$respon = $this->crud->insertDataSave('akun_bank',$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('bank/akunbank');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'bank/akunbank"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li class="active"><a href="'.base_url().'bank/akunbank/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$data['mydata'] = $mydata;
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('bank/tambah',$data);
				//}
			}
		}

	}

	public function update(){
		$id = $this->input->get('id');
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Data Akun Bank';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'bank/akunbank"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'bank/akunbank/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$mydata= $this->crud->getDatawhere('akun_bank',array('id_akun'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$this->template->view('bank/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_akun','<b class="text-uppercase">ID</b>','required');
		$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('divisi','<b class="text-uppercase">Divisi</b>','required');
		$form->set_rules('no_rek','<b class="text-uppercase">No Rek</b>','required');
		$form->set_rules('nama_bank','<b class="text-uppercase">NAMA BANK</b>','required');
		$form->set_rules('nama_akun','<b class="text-uppercase">NAMA AKUN</b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">KETERANGAN</b>','required');

		$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
	  	$whr = array('id_akun'=>$input->post('id_akun'));
		$mydata = array(
			'id_pegawai'=>strtoupper($input->post('id_pegawai')),
			'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
			'departemen'=>strtoupper($input->post('departemen')),
			'divisi'=>strtoupper($input->post('divisi')),
			'no_rekening'=>strtoupper($input->post('no_rek')),
			'nama_bank'=>$input->post('nama_bank'),
			'nama_akun'=>strtoupper($input->post('nama_akun')),
			'keterangan'=>$input->post('keterangan')
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Data Pegawai';
			$data['sub_title'] = 'Update ';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'bank/akunbank/tambah"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'bank/akunbank/update?">Data Bank</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$mydata= $this->crud->getDatawhere('akun_bank',array('id_akun'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('bank/update',$data);
			//}
		}else{
			$respon = $this->crud->updData('akun_bank',$whr,$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('bank/akunbank');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Data Pegawai';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'bank/akunbank"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'bank/akunbank/tambah?id='.$id.'">Data Akun Bank</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				// $mydata = array(
				// 	'id_pegawai'=>'',
				// 	'nama_pegawai'=>'',
				// 	'jns_kel_pegawai'=>'',
				// 	'tmp_lhr_pegawai'=>'',
				// 	'tgl_lhr_pegawai'=>'',
				// 	'agama_pegawai'=>'',
				// 	'status_pegawai'=>'',
				// 	'pendidikan_pegawai'=>'',
				// 	'alamat_pegawai'=>'',
				// 	'id_departemen'=>'',
				// 	'penunjukan'=>'',
				// 	'file'=>''
				$data['alert'] = '';
				$mydata= $this->crud->getDatawhere('akun_bank',array('id_akun'=>$id))->row_array();
				$data['mydata'] = $mydata;
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('bank/update',$data);
				//}
			}
		}

	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('id_akun'=>$id),'akun_bank');
		redirect('bank/akunbank');
	}
}

