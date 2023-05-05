<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('bank/AkunBank/update?id='.$this->session->userdata('hak_akses'));
			}else{
				$data['title'] = 'Kehadiran';
				$data['sub_title'] = 'List';
				$data['breadcrumb'] = '
					<li class="active"><a href="'.base_url().'kehadiran/Kehadiran"><i class="fa fa-dashboard"></i> Akun Bank</a></li>
				';
				$data['kehadiran'] = $this->crud->selectAllOrderby('kehadiran','id_pegawai,waktu_kehadiran','asc')->result();
				$data['crud'] = $this->crud;
				$this->template->view('kehadiran/index',$data);
			}
		}
	}

	public function importExcel(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('dashboard');
			}else{
				$data['title'] = 'Kehadiran';
				$data['sub_title'] = 'Import';
				$data['breadcrumb'] = '';
				$data['alert'] = '';
				$data['crud'] = $this->crud;
				$this->template->view('kehadiran/import',$data);
			}
		}
	}

	public function previewData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			if($this->session->userdata('hak_akses') == 3){
				redirect('dashboard');
			}else{
				$this->load->library('upload');

				// File
				$myfile = $this->input->post('myfile');
			  	
			  	if(isset($_FILES["excel"]["name"])){
					$filename = FCPATH.'/assets/excel';

					if (!file_exists($filename)) {
						mkdir($filename, 0777, true);
					}

			   		//setting konfigurasi upload image
		           	$config['upload_path'] = "./assets/excel";
		            $config['allowed_types'] = 'xls|xlsx';
		            $config['overwrite'] = true;
		            $this->upload->initialize($config);

			   		if($this->upload->do_upload("excel")){
				     	$hslnya = $this->upload->data();
				     	$myfile = $hslnya["file_name"];
			    	}
			  	}

			  	$this->load->library('Excel');
			  	$reader= PHPExcel_IOFactory::createReader('Excel5');
			    $reader->setReadDataOnly(true);
			    $path = "./assets/excel/".$myfile;
			    $excel = $reader->load($path);

			    $sheet = $excel->getActiveSheet()->toArray(null,true,true,true);
			    // $arrayCount = count($sheet); 
			    // for($i=2;$i<=$arrayCount;$i++)
			    // {                   
			    //     echo $sheet[$i]["A"].$sheet[$i]["B"].$sheet[$i]["C"];
			    // }

				$data['title'] = 'Kehadiran';
				$data['sub_title'] = 'Preview';
				$data['breadcrumb'] = '';
				$data['alert'] = '';
				$data['crud'] = $this->crud;
				$data['myfile'] = $myfile;
				$data['sheet'] = $sheet;
				$this->template->view('kehadiran/preview',$data);
			}
		}
	}

	public function saveData(){
		$myfile = $this->input->post('myfile');
		$this->load->library('Excel');
		$reader= PHPExcel_IOFactory::createReader('Excel5');
		$reader->setReadDataOnly(true);
	    $path = "./assets/excel/".$myfile;
	    $excel = $reader->load($path);

	    $sheet = $excel->getActiveSheet()->toArray(null,true,true,true);
	    $jml_data_msk = 0;
	    for($a=2;$a<=count($sheet);$a++){
	    	
	    	// Cek Column Pegawai dan Tgl, Column A dan C
	    	if($sheet[$a]["A"] != NULL && $sheet[$a]["C"] != NULL){
	    		// Pegawai
	    		$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$sheet[$a]["A"]))->row_array();

	    		// Get tgl absen
	    		$excel_date = $sheet[$a]["C"]; //here is that value 41621 or 41631
				$unix_date = ($excel_date - 25569) * 86400;
				$excel_date = 25569 + ($unix_date / 86400);
				$unix_date = ($excel_date - 25569) * 86400;
				$tgl_absen = gmdate("Y-m-d", $unix_date);

				// Waktu absen
				$masuk = '';
				if($sheet[$a]["D"] != NULL){
					$masuk = PHPExcel_Style_NumberFormat::toFormattedString($sheet[$a]["D"], 'hh:mm:ss');
				}

				$keluar = '';
				if($sheet[$a]["E"] != NULL){
					$keluar = PHPExcel_Style_NumberFormat::toFormattedString($sheet[$a]["E"], 'hh:mm:ss');
				}

				// Hadir
				$hadir = '';
				$sts_masuk = 0;
				if($masuk != '' && $keluar != ''){
					$hadir = 'Hadir';
					$sts_masuk = 1;
				}else{
					$hadir = 'Tdk Hadir';
					$sts_masuk = 0;
				}

				// Terlambat
				$terlambat = $sheet[$a]["F"];

				// Status Perijinan
				$sts_perijinan = $sheet[$a]["G"];

				// Shift
				$shift = $sheet[$a]["B"];

				// Simpan data di kehadiran
				$whr = array(
					'id_pegawai'=>$sheet[$a]["A"],
					'waktu_kehadiran'=>$tgl_absen
				); 

				$cek_kehadiran = $this->crud->getDataWhere('kehadiran',$whr)->num_rows();
				
				// Jika ada update
				if($cek_kehadiran > 0){
					$data = array(
						'nama_pegawai'=>$pegawai['nama_pegawai'],
					  	'status_kehadiran'=>strtoupper($hadir),
					  	'masuk'=>$masuk,
					  	'keluar'=>$keluar,
					  	'terlambat'=>$terlambat,
					  	'status_perijinan'=>strtoupper($sts_perijinan),
					  	'shift'=>$shift,
					  	'status_masuk'=>$sts_masuk
					);

					$respon = $this->crud->updData('kehadiran',$whr,$data);
				}

				// Jika tidak ada insert
				else{
					$data = array(
						'id_pegawai'=>$sheet[$a]["A"],
					  	'nama_pegawai'=>$pegawai['nama_pegawai'],
					  	'status_kehadiran'=>strtoupper($hadir),
					  	'waktu_kehadiran'=>$tgl_absen,
					  	'masuk'=>$masuk,
					  	'keluar'=>$keluar,
					  	'terlambat'=>$terlambat,
					  	'status_perijinan'=>strtoupper($sts_perijinan),
					  	'shift'=>$shift,
					  	'status_masuk'=>$sts_masuk
					);

					$respon = $this->crud->insertDataSave('kehadiran',$data);
				}

				// Hitung data masuk
				if($respon['code'] == 0){
					$jml_data_msk++;
				}
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';

	    	}

	    }

	    // Output data
	    $output = $jml_data_msk.' data telah berhasil di masukkan<br>';
	    $output .= '<a href="'.base_url().'kehadiran/kehadiran">Kembali ke list Kehadiran</a>';
	    echo $output;

	    header( "refresh:5;url=".base_url()."kehadiran/kehadiran" );


	}
}