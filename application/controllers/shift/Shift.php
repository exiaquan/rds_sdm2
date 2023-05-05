<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 2){
				redirect('shift/Shift/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Data Shift';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'shift/Shift"><i class="fa fa-dashboard"></i> Shift</a></li>
				';
				$data['shift'] = $this->crud->selectAllOrderby('shift','id_shift','asc')->result();
				$data['crud'] = $this->crud;
				$this->template->view('shift/index',$data);
			}
		};
	}
public function tambah(){
	// Cek login
	if($this->session->userdata('sts_login') != true){
		redirect('Welcome');
	}else{
		$data['title'] = 'Data Shift';
		$data['sub_title'] = 'Tambah';
		$data['breadcrumb'] = '
			<li><a href="'.base_url().'shift/shhift"><i class="fa fa-dashboard"></i> Pegawai</a></li>
			<li class="active"><a href="'.base_url().'shift/shift/tambah">Tambah</a></li>
		';
	}
$data['alert'] = '';
			$mydata = array(
				'id_shift'=>'',
				'id_pegawai'=>'',
				'shift'=>''
			);
			$data['mydata'] = $mydata;
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('shift/tambah',$data);
		}

		public function saveData(){
			$form = $this->form_valid;
			$input = $this->input;
	
			// Form validation
			$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
			$form->set_rules('shift','<b class="text-uppercase">Shift</b>','required');
	
			
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
	
			$mydata = array(
				'id_pegawai'=>strtoupper($input->post('id_pegawai')),
				'nama_shift'=>strtoupper($input->post('shift'))
			);
	
			if($form->run() == FALSE){
				// Cek login
				// if($this->session->userdata('sts_login') != true){
				// 	redirect('Welcome');
				// }else{
				$data['title'] = 'Tambah';
				$data['sub_title'] = '';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'shift/shift"><i class="fa fa-dashboard"></i> Shift</a></li>
					<li class="active"><a href="'.base_url().'shift/shift/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$data['mydata'] = $mydata;
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$this->template->view('shift/tambah',$data);
				//}
			}else{
				$respon = $this->crud->insertDataSave('shift',$mydata);
				if($respon['code'] == 0){
					echo '<script>alert("'.$respon['message'].'");</script>';
					redirect('shift/shift');
				}else{
					// Cek login
					// if($this->session->userdata('sts_login') != true){
					// 	redirect('Welcome');
					// }else{
					$data['title'] = 'Tambah';
					$data['sub_title'] = '';
					$data['breadcrumb'] = '
						<li><a href="'.base_url().'shift/shift"><i class="fa fa-dashboard"></i> Shift</a></li>
						<li class="active"><a href="'.base_url().'shift/shift/tambah">Tambah</a></li>
					';
					$data['alert'] = '<div class="alert alert-warning">'.$respon['message'].'</div>';
					$data['mydata'] = $mydata;
					$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
					$this->template->view('shift/tambah',$data);
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
		$data['title'] = 'Data Shift';
		$data['sub_title'] = 'Update '.$id;
		$data['breadcrumb'] = '
			
		';
		$data['alert'] = '';
		
		$mydata = $this->crud->getDataWhere('shift',array('id_shift'=>$id))->row_array();
		$data['mydata'] = $mydata;
		$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
		$this->template->view('shift/update',$data);
	}
}

public function saveDataUpdate(){
	$form = $this->form_valid;
	$input = $this->input;
	$id = $input->post('id_shift');

	// Form validation
	// Form validation
	$form->set_rules('id_pegawai','<b class="text-uppercase">ID PEGAWAI</b>','required');
	$form->set_rules('shift','<b class="text-uppercase">Shift</b>','required');



	$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();

	  $whr = array('id_shift'=>$input->post('id_shift'));
	  $mydata = array(
		'id_pegawai'=>strtoupper($input->post('id_pegawai')),
		'nama_shift'=>strtoupper($input->post('shift'))
	);


	if($form->run() == FALSE){
		// Cek login
		// if($this->session->userdata('sts_login') != true){
		// 	redirect('Welcome');
		// }else{
		$data['title'] = 'Data Shift';
		$data['sub_title'] = 'Update '.$id;
		$data['breadcrumb'] = '
			<li class="active"><a href="'.base_url().'shift/shift"><i class="fa fa-dashboard"></i> <Shift/a></li>
			<li><a href="'.base_url().'shift/shift/update?id='.$id.'">Data Shift</a></li>
		';
		$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
		$mydata = $this->crud->getDataWhere('shift',array('id_shift'=>$id))->row_array();
		$data['mydata'] = $mydata;
		$data['pegawai'] = $this->crud->selectAll('pegawai')->result();

		$this->template->view('shift/update',$data);
		//}
	}else{
		$respon = $this->crud->updData('shift',$whr,$mydata);
		if($respon['code'] == 0){
			echo '<script>alert("'.$respon['message'].'");</script>';
			redirect('shift/shift');
		}else{
			redirect('shift/shift/update?id='.$id);
			// $data['title'] = 'Data  Shift';
			// $data['sub_title'] = 'Update '.$id;
			// $data['breadcrumb'] = '
			// 	<li class="active"><a href="'.base_url().'shift/shift"><i class="fa fa-dashboard"></i> Pegawai</a></li>
			// 	<li><a href="'.base_url().'shift/shift/update?id='.$id.'">Data Shift</a></li>
			// ';
			// $data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';

			// $mydata = $this->crud->getDataWhere('shift',array('id_shift'=>$id))->row_array();
			// $data['mydata'] = $mydata;
			// $data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			// $this->template->view('shift/update',$data);
			//}
		}
	}

}
public function delete(){
	$id = $this->input->get('id');
	$this->crud->delData(array('id_shift'=>$id),'shift');
	redirect('shift/shift');
}
}
