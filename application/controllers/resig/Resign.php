<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resign extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('resig/Resign/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Data Resign';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'resig/resign"><i class="fa fa-dashboard"></i> Resign</a></li>
				';
				$data['resign'] = $this->crud->selectAllOrderby('resign','kode_resign','asc')->result();
				$data['crud'] = $this->crud;
				$this->template->view('resign/index',$data);
			}
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Data Resign';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'resig/resign"><i class="fa fa-dashboard"></i>Resign</a></li>
        		<li class="active"><a href="'.base_url().'resig/Resign/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$mydata = array(
				'id_pegawai'=>'',
				'nama_pegawai'=>'',
				'depatemen'=>'',
				'penunjukan'=>'',
				'jenis_resign'=>'',
				'per_tanggal'=>'',
				'keterangan'=>'',
				'file'=>''
			);
			$data['mydata'] = $mydata;
            $data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('resign/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		// Form validation
		$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">DEPARTEMENb>','required');
		$form->set_rules('penunjukan','<b class="text-uppercase">PENUNJUKANr</b>','required');
		$form->set_rules('per_tanggal','<b class="text-uppercase">PER TANGGAL/b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">KETERANGAN</b>','required');

		// Temp data
		$per_tanggal = NULL;
		if($input->post('per_tanggal') != NULL){
			$per_tanggal = date('Y-m-d',strtotime($input->post('per_tanggal')));
		}
	
		$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();

		$mydata = array(
			'id_pegawai'=>strtoupper($input->post('id_pegawai')),
			'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
			'departemen'=>strtoupper($input->post('departemen')),
			'penunjukan'=>strtoupper($input->post('penunjukan')),
			'per_tanggal'=>$per_tanggal,
			'keterangan'=>strtoupper($input->post('keterangan')),
			'file'=>''
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Tambah';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'resig/Resign"><i class="fa fa-dashboard"></i>Resgin</a></li>
        		<li class="active"><a href="'.base_url().'resig/reeign/tambah">Tambah</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$data['mydata'] = $mydata;
			$this->template->view('resign/tambah',$data);
			//}
		}else{
			$respon = $this->crud->insertDataSave('resign',$mydata);

			// File
			$file = "";
	  	
			if(isset($_FILES["file_resign"]["name"])){
				$filename = FCPATH.'/assets/file/'.$respon['last_id'];

				if (!file_exists($filename)) {
					mkdir($filename, 0777, true);
				}

				//setting konfigurasi upload image
				$config['upload_path'] = './assets/file/'.$respon['last_id'];
				$config['allowed_types'] = '*';
				//$config['allowed_types'] = 'pdf';
				$this->upload->initialize($config);

				if($this->upload->do_upload("file_resign")){
					$hslnya = $this->upload->data();
					$file = $hslnya["file_name"];
				}

				$whr_resign = array('kode_resign'=>$respon['last_id']);
				$data_resign = array('file'=>$file);
				$this->crud->updData('resign',$whr_resign,$data_resign);
			}

			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('resig/resign');
			}else{
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'resig/Resign"><i class="fa fa-dashboard"></i> Resign</a></li>
	        		<li class="active"><a href="'.base_url().'resig/resign/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
				$data['mydata'] = $mydata;
				$this->template->view('resign/tambah',$data);
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
			$data['title'] = 'Data Pesign';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				
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
			$mydata = $this->crud->getDataWhere('resign',array('kode_resign'=>$id))->row_array();
			$data['mydata'] = $mydata;
            $data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('resign/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;
		$id = $input->post('kode_resign');

		// Form validation
		$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
		$form->set_rules('departemen','<b class="text-uppercase">DEPARTEMENb>','required');
		$form->set_rules('penunjukan','<b class="text-uppercase">PENUNJUKANr</b>','required');
		$form->set_rules('per_tanggal','<b class="text-uppercase">PER TANGGAL/b>','required');
		$form->set_rules('keterangan','<b class="text-uppercase">KETERANGAN</b>','required');

		// Temp data
		$per_tanggal = NULL;
		if($input->post('per_tanggal') != NULL){
			$per_tanggal = date('Y-m-d',strtotime($input->post('per_tanggal')));
		}
		// File
		$file = $input->post('old_file_resign');
	  	
	  	if(isset($_FILES["file_resign"]["name"])){
			$filename = FCPATH.'/assets/file/'.$input->post('kode_resign');

			if (!file_exists($filename)) {
				mkdir($filename, 0777, true);
			}

	   		//setting konfigurasi upload image
           	$config['upload_path'] = './assets/file/'.$input->post('kode_resign');
            $config['allowed_types'] = '*';
            //$config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

	   		if($this->upload->do_upload("file_resign")){
		     	$hslnya = $this->upload->data();
		     	$file = $hslnya["file_name"];
	    	}
	  	}

	  	$departemen = $this->crud->getDataWhere('departemen',array('id_departemen'=>$input->post('departemen')))->row_array();
		$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();

	  	$whr = array('kode_resign'=>$input->post('kode_resign'));
		$mydata = array(
			'id_pegawai'=>strtoupper($input->post('id_pegawai')),
			'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
			'departemen'=>strtoupper($input->post('departemen')),
			'penunjukan'=>strtoupper($input->post('penunjukan')),
			'per_tanggal'=>$per_tanggal,
			'keterangan'=>strtoupper($input->post('keterangan')),
			'file'=>$file
		);

		if($form->run() == FALSE){
			// Cek login
			// if($this->session->userdata('sts_login') != true){
			// 	redirect('Welcome');
			// }else{
			$data['title'] = 'Data Resign';
			$data['sub_title'] = 'Update '.$id;
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'resig/resign"><i class="fa fa-dashboard"></i> Resign</a></li>
        		<li><a href="'.base_url().'resig/resign/update?id='.$id.'">Data Resign</a></li>
			';
			$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
			$mydata = $this->crud->getDataWhere('kode_resign',array('kode_resign'=>$id))->row_array();
			$data['mydata'] = $mydata;
            $data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('resignupdate',$data);
			//}
		}else{
			$respon = $this->crud->updData('resign',$whr,$mydata);
			if($respon['code'] == 0){
				echo '<script>alert("'.$respon['message'].'");</script>';
				redirect('resig/resign');
			}else{

				$data['title'] = 'Data  Resign';
				$data['sub_title'] = 'Update '.$id;
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'resig/resign"><i class="fa fa-dashboard"></i> Pegawai</a></li>
	        		<li><a href="'.base_url().'resig/resign/update?id='.$id.'">Data Resign</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';

				$mydata = $this->crud->getDataWhere('kode_resign',array('kode_resign'=>$id))->row_array();
				$data['mydata'] = $mydata;
				$data['pegawai'] = $this->crud->selectAll('pegawai')->rersult();
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('resign/update',$data);
				//}
			}
		}

	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('kode_resign'=>$id),'resign');
		redirect('resig/resign');
	}
}