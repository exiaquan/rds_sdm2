<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
		// Cek login
		if($this->session->userdata('sts_login') != true){
			redirect('Welcome');
		}else{
			$data['title'] = 'Dashboard';
			$data['sub_title'] = '';
			$data['breadcrumb'] = '
				<li class="active"><a href="'.base_url().'dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        		<!--<li class="active">Invoice</li>-->
			';
			$data['total_pegawai'] = $this->crud->selectAll('pegawai')->num_rows();
			$data['total_pegawai_pria'] = $this->crud->getDataWhere('pegawai',array('jns_kel_pegawai'=>'PRIA'))->num_rows();
			$data['total_pegawai_wanita'] = $this->crud->getDataWhere('pegawai',array('jns_kel_pegawai'=>'WANITA'))->num_rows();
			$sql_divisi = '
				SELECT COUNT(a.divisi) AS jml_divisi
				FROM departemen a
				GROUP BY a.divisi
			';
			$data['jml_divisi'] = $this->crud->getDataQuery($sql_divisi)->num_rows();
			$this->template->view('dashboard',$data);
		}
	}

}