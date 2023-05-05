<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IzinCuti extends CI_Controller {

	public function index(){
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			redirect('perizinan/izincuti/listdata');
		}
	}

	public function listData(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Izin/Cuti';
			$data['sub_title'] = 'List';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'perizinan/izincuti"><i class="fa fa-dashboard"></i> Izin/Cuti</a></li>
			';
			$data['izincuti'] = $this->crud->selectAllOrderby('ijin_cuti','kode_perijinan','asc')->result();
			$this->template->view('izincuti/index',$data);
		}
	}

	public function tambah(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Izin/Cuti';
			$data['sub_title'] = 'Tambah';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'perizinan/izincuti"><i class="fa fa-dashboard"></i> Izin/Cuti</a></li>
				<li class="active"><a href="'.base_url().'perizinan/izincuti/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('izincuti/tambah',$data);
		}
	}

	public function saveData(){
		$form = $this->form_valid;
		$input = $this->input;

		$form->set_rules('id_pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('keterangan_ijin','<b class="text-uppercase">Keterangan Izin</b>','required');
		$form->set_rules('tgl_mulai','<b class="text-uppercase">Tgl Mulai</b>','required');
		$form->set_rules('tgl_akhir','<b class="text-uppercase">Tgl Mulai</b>','required');

		if($form->run() == FALSE){
			// Cek login
			if($this->session->userdata('sts_login') != true){
				redirect('Welcome');
			}else{
				$data['title'] = 'Izin/Cuti';
				$data['sub_title'] = 'Tambah';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'perizinan/izincuti"><i class="fa fa-dashboard"></i> Izin/Cuti</a></li>
					<li class="active"><a href="'.base_url().'perizinan/izincuti/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$this->template->view('izincuti/tambah',$data);
			}
		}else{
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();
			$tgl1 = new DateTime(date('Y-m-d',strtotime($input->post('tgl_mulai'))));
			$tgl2 = new DateTime(date('Y-m-d',strtotime($input->post('tgl_akhir'))));
			$durasi = $tgl2->diff($tgl1);

			$mydata = array(
				'id_pegawai'=>$pegawai['id_pegawai'],
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'departemen'=>$pegawai['id_departemen'],
				'penunjukan'=>$pegawai['penunjukan'],
				'keterangan_ijin'=>strtoupper($input->post('keterangan_ijin')),
				'tgl_mulai'=>date('Y-m-d',strtotime($input->post('tgl_mulai'))),
				'tgl_akhir'=>date('Y-m-d',strtotime($input->post('tgl_akhir'))),
				'durasi'=>$durasi->d+1,
				'file'=>''
			);
		
			$respon = $this->crud->insertDataSave('ijin_cuti',$mydata);

			// Update upload file
			$file = "";
			if(isset($_FILES["file_ijin"]["name"])){
				$filename = FCPATH.'/assets/file/'.$respon['last_id'];

				if (!file_exists($filename)) {
					mkdir($filename, 0777, true);
				}

				//setting konfigurasi upload image
				$config['upload_path'] = './assets/file/'.$respon['last_id'];
				$config['allowed_types'] = '*';
				//$config['allowed_types'] = 'pdf';
				$this->upload->initialize($config);

				if($this->upload->do_upload("file_ijin")){
					$hslnya = $this->upload->data();
					$file = $hslnya["file_name"];
				}

				$whr_ijin = array('kode_perijinan'=>$respon['last_id']);
				$data_ijin = array('file'=>$file);
				$this->crud->updData('ijin_cuti',$whr_ijin,$data_ijin);
			}

			if($respon['code'] == 0){
				// Kurangi cuti pegawai
				$whr_pegawai = array('id_pegawai'=>$pegawai['id_pegawai']);
				$data_pegawai = array('jatah_cuti'=>$pegawai['jatah_cuti']-$mydata['durasi']);
				$this->crud->updData('pegawai',$whr_pegawai,$data_pegawai);
			}
			redirect('perizinan/izincuti');
		}
	}

	public function update(){
		$id = $this->input->get('id');
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Izin/Cuti';
			$data['sub_title'] = 'Update';
			$data['breadcrumb'] = '
				<li><a href="'.base_url().'perizinan/izincuti"><i class="fa fa-dashboard"></i> Izin/Cuti</a></li>
				<li class="active"><a href="'.base_url().'perizinan/izincuti/tambah">Tambah</a></li>
			';
			$data['alert'] = '';
			$data['mydata'] = $this->crud->getDataWhere('ijin_cuti',array('kode_perijinan'=>$id))->row_array();
			$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
			$data['departemen'] = $this->crud->selectAll('departemen')->result();
			$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
			$this->template->view('izincuti/update',$data);
		}
	}

	public function saveDataUpdate(){
		$form = $this->form_valid;
		$input = $this->input;
		$id = $input->post('kode');

		$form->set_rules('id_pegawai','<b class="text-uppercase">Pegawai</b>','required');
		$form->set_rules('keterangan_ijin','<b class="text-uppercase">Keterangan Izin</b>','required');
		$form->set_rules('tgl_mulai','<b class="text-uppercase">Tgl Mulai</b>','required');
		$form->set_rules('tgl_akhir','<b class="text-uppercase">Tgl Mulai</b>','required');

		$file = $input->post('old_file_ijin');
		if(isset($_FILES["file_ijin"]["name"])){
			$filename = FCPATH.'/assets/file/'.$id;

			if (!file_exists($filename)) {
				mkdir($filename, 0777, true);
			}

			//setting konfigurasi upload image
			$config['upload_path'] = './assets/file/'.$id;
			$config['allowed_types'] = '*';
			//$config['allowed_types'] = 'pdf';
			$this->upload->initialize($config);

			if($this->upload->do_upload("file_ijin")){
				$hslnya = $this->upload->data();
				$file = $hslnya["file_name"];
			}
		}

		if($form->run() == FALSE){
			// Cek login
			if($this->session->userdata('sts_login') != true){
				redirect('Welcome');
			}else{
				$data['title'] = 'Izin/Cuti';
				$data['sub_title'] = 'Update';
				$data['breadcrumb'] = '
					<li><a href="'.base_url().'perizinan/izincuti"><i class="fa fa-dashboard"></i> Izin/Cuti</a></li>
					<li class="active"><a href="'.base_url().'perizinan/izincuti/tambah">Tambah</a></li>
				';
				$data['alert'] = '<div class="alert alert-warning">'.validation_errors().'</div>';
				$data['pegawai'] = $this->crud->selectAll('pegawai')->result();
				$data['departemen'] = $this->crud->selectAll('departemen')->result();
				$data['penunjukan'] = $this->crud->selectAll('penunjukan')->result();
				$data['mydata'] = $this->crud->getDataWhere('ijin_cuti',array('kode_perijinan'=>$id))->row_array();
				$this->template->view('izincuti/update',$data);
			}
		}else{
			$saldo_old = $input->post('saldo_old');
			$mydataold = $this->crud->getDataWhere('ijin_cuti',array('kode_perijinan'=>$id))->row_array();
			$pegawai = $this->crud->getDataWhere('pegawai',array('id_pegawai'=>$input->post('id_pegawai')))->row_array();

			// Hitung tgl
			$tgl1 = new DateTime(date('Y-m-d',strtotime($input->post('tgl_mulai'))));
			$tgl2 = new DateTime(date('Y-m-d',strtotime($input->post('tgl_akhir'))));
			$durasi = $tgl2->diff($tgl1);

			// Simpan data
			$whr_data = array('kode_perijinan'=>$id);
			$mydata = array(
				'id_pegawai'=>$pegawai['id_pegawai'],
				'nama_pegawai'=>strtoupper($pegawai['nama_pegawai']),
				'departemen'=>$pegawai['id_departemen'],
				'penunjukan'=>$pegawai['penunjukan'],
				'keterangan_ijin'=>strtoupper($input->post('keterangan_ijin')),
				'tgl_mulai'=>date('Y-m-d',strtotime($input->post('tgl_mulai'))),
				'tgl_akhir'=>date('Y-m-d',strtotime($input->post('tgl_akhir'))),
				'durasi'=>$durasi->d+1,
				'file'=>$file
			);
			$respon = $this->crud->updData('ijin_cuti',$whr_data,$mydata);

			// if($respon['code'] == 0){
			// Kurangi cuti pegawai
			$whr_pegawai = array('id_pegawai'=>$pegawai['id_pegawai']);
			$data_pegawai = array('jatah_cuti'=>($pegawai['jatah_cuti']+$saldo_old)-$mydata['durasi']);
			$this->crud->updData('pegawai',$whr_pegawai,$data_pegawai);
			// }
			redirect('perizinan/izincuti');
		}
	}
	public function delete(){
		$id = $this->input->get('id');
		$this->crud->delData(array('kode_perijinan'=>$id),'ijin_cuti');
		redirect('perizinan/izincuti');
	}

	public function pdfGen(){
		// Load library MPDF
		$this->load->library('M_pdf');
		$mpdf = $this->m_pdf->pdf;

		// Content
		$id = $this->input->get('id');
		$mydata = $this->crud->getDataWhere('ijin_cuti',array('kode_perijinan'=>$id))->row_array();
		$data['mydata'] = $mydata;
		$data['crud'] = $this->crud;
		$this->load->view('izincuti/pdfgen',$data);

		// Output
		$html = $this->output->get_output();
		$mpdf->WriteHTML($html);
 	 	$mpdf->Output();
	}

}