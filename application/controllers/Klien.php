<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klien extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('klien/klien/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Klien';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'Klien"><i class="fa fa-dashboard"></i> Akun Bank</a></li>
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
				'id_akun'=>'',
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
			$this->template->view('bank/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_akun','<b class="text-uppercase">ID</b>','required|is_unique[akun_bank.id_akun]');
		$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('nama_pegawai','<b class="text-uppercase">NAMA PEGAWAI</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('divisi','<b class="text-uppercase">Divisi</b>','required');
		$form->set_rules('no_rekening','<b class="text-uppercase">No Rek</b>','required');
		$form->set_rules('nama_bank','<b class="text-uppercase">NAMA BANK</b>','required');
		$form->set_rules('nama_akun','<b class="text-uppercase">NAMA AKUN</b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">KETERANGAN</b>','required');

		// Temp data
		$tgl_lahir = NULL;
		if($input->post('tgllahir') != NULL){
			$tgl_lahir = date('Y-m-d',strtotime($input->post('tgllahir')));
		}

		// File
		$file = "";
	  	
	  	if(isset($_FILES["file_pegawai"]["name"])){
			$filename = FCPATH.'/assets/file/'.$input->post('id_pegawai');

			if (!file_exists($filename)) {
				mkdir($filename, 0777, true);
			}

	   		//setting konfigurasi upload image
           	$config['upload_path'] = './assets/file/'.$input->post('id_pegawai');
            $config['allowed_types'] = '*';
            //$config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

	   		if($this->upload->do_upload("file_pegawai")){
		     	$hslnya = $this->upload->data();
		     	$file = $hslnya["file_name"];
	    	}
	  	}

	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();

		$mydata = array(
			'id_pegawai'=>$input->post('id_pegawai'),
			'nama_pegawai'=>strtoupper($input->post('nama')),
			'jns_kel_pegawai'=>strtoupper($input->post('gender')),
			'tmp_lhr_pegawai'=>strtoupper($input->post('ttl')),
			'tgl_lhr_pegawai'=>$tgl_lahir,
			'agama_pegawai'=>strtoupper($input->post('agama')),
			'status_pegawai'=>strtoupper($input->post('status')),
			'pendidikan_pegawai'=>strtoupper($input->post('pendidikan')),
			'alamat_pegawai'=>strtoupper($input->post('alamat')),
			'id_departemen'=>$input->post('departemen'),
			'nama_departemen'=>strtoupper($departemen['departemen']),
			'penunjukan'=>$input->post('penunjukan'),
			'file'=>$file
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Tambah';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li class="active"><a href="'.base_url().'pegawai/datapegawai/tambah">Tambah</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$data['mydata'] = $mydata;
			$this->template->view('pegawai/tambah',$data);
			//}
		}else{
			$respon = $this->crud->insertDataSave('pegawai',$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('pegawai/datapegawai');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li class="active"><a href="'.base_url().'pegawai/datapegawai/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$data['mydata'] = $mydata;
				$this->template->view('pegawai/tambah',$data);
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
			$data['title'] = 'Data Pegawai';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'pegawai/datapegawai/update?id='.$id.'">Data Pegawai</a></li>
			';
			$data['alert'] = '';
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
			// );
			$mydata = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('pegawai/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('nama','<b class="text-uppercase">NAMA</b>','required');
		$form->set_rules('gender','<b class="text-uppercase">GENDER</b>','required');
		$form->set_rules('ttl','<b class="text-uppercase">TEMPAT LAHIR</b>','required');
		$form->set_rules('tgllahir','<b class="text-uppercase">Tgl Lahir</b>','required');
		$form->set_rules('agama','<b class="text-uppercase">AGAMA</b>','required');
		$form->set_rules('status','<b class="text-uppercase">Status</b>','required');
		$form->set_rules('pendidikan','<b class="text-uppercase">PENDIDIKAN</b>','required');
		$form->set_rules('alamat','<b class="text-uppercase">ALAMAT</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">Departemen</b>','required');
		$form->set_rules('penunjukan','<b class="text-uppercase">Penunjukan</b>','required');

		// Temp data
		$tgl_lahir = NULL;
		if($input->post('tgllahir') != NULL){
			$tgl_lahir = date('Y-m-d',strtotime($input->post('tgllahir')));
		}

		// File
		$file = $input->post('old_file_pegawai');
	  	
	  	if(isset($_FILES["file_pegawai"]["name"])){
			$filename = FCPATH.'/assets/file/'.$input->post('id_pegawai');

			if (!file_exists($filename)) {
				mkdir($filename, 0777, true);
			}

	   		//setting konfigurasi upload image
           	$config['upload_path'] = './assets/file/'.$input->post('id_pegawai');
            $config['allowed_types'] = '*';
            //$config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

	   		if($this->upload->do_upload("file_pegawai")){
		     	$hslnya = $this->upload->data();
		     	$file = $hslnya["file_name"];
	    	}
	  	}

	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();

	  	$whr = array('id_pegawai'=>$input->post('id_pegawai'));
		$mydata = array(
			'nama_pegawai'=>strtoupper($input->post('nama')),
			'jns_kel_pegawai'=>strtoupper($input->post('gender')),
			'tmp_lhr_pegawai'=>strtoupper($input->post('ttl')),
			'tgl_lhr_pegawai'=>$tgl_lahir,
			'agama_pegawai'=>strtoupper($input->post('agama')),
			'status_pegawai'=>strtoupper($input->post('status')),
			'pendidikan_pegawai'=>strtoupper($input->post('pendidikan')),
			'alamat_pegawai'=>strtoupper($input->post('alamat')),
			'id_departemen'=>$input->post('departemen'),
			'nama_departemen'=>strtoupper($departemen['departemen']),
			'penunjukan'=>$input->post('penunjukan'),
			'file'=>$file
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Data Pegawai';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        		<li><a href="'.base_url().'pegawai/datapegawai/update?id='.$id.'">Data Pegawai</a></li>
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
			// );
			$mydata = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$id))->row_array();
			$data['mydata'] = $mydata;
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('pegawai/update',$data);
			//}
		}else{
			$respon = $this->crud->updData('pegawai',$whr,$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('pegawai/datapegawai');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Data Pegawai';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'pegawai/datapegawai"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'pegawai/datapegawai/update?id='.$id.'">Data Pegawai</a></li>
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
				// );
				$mydata = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$id))->row_array();
				$data['mydata'] = $mydata;
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('pegawai/update',$data);
				//}
			}
		}

	}

}