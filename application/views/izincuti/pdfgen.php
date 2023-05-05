<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $mydata['kode_perijinan'];?></title>
	<style type="text/css">
		html,body{
			margin: 5px !important;
			font-family: Arial;
		}
		.text-uppercase{text-transform: uppercase;}
		.text-left{text-align: left;}
		.text-right{text-align: right;}
		.text-center{text-align: center;}
	</style>
</head>
<body>
	<?php
		$departemen = $crud->getDataWhere('departemen',array('id_departemen'=>$mydata['departemen']))->row_array();
		$penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$mydata['penunjukan']))->row_array();
	?>
	<table style="width: 100%;border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;">		
		<tr>
			<th class="text-uppercase text-left">
				<img src="./assets/icon.png" style="width:90px;" />
			</th>
		</tr>
		<tr>
			<th class="text-uppercase text-left">PT. REYCOM DOCUMENT SOLUSI</th>
		</tr>
	</table>

	<table style="width:100%;border-left: 1px solid black;border-right: 1px solid black;padding: 5px;">
		<tr>
			<th class="text-uppercase">Formulir Cuti</th>
		</tr>
	</table>

	<table style="width:100%;font-size: 12px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;padding: 5px;">
		<tr>
			<th class="text-uppercase text-left" style="width:50px;">Nama</th>
			<td class="text-uppercase text-left">: <?php echo $mydata['nama_pegawai'];?></td>
			<th class="text-uppercase text-left" style="width:50px;">Bagian</th>
			<td class="text-uppercase text-left">: <?php echo $departemen['departemen'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left" style="width:50px;">NIK</th>
			<td class="text-uppercase text-left">: <?php echo $mydata['id_pegawai'];?></td>
			<th class="text-uppercase text-left" style="width:50px;">Tgl</th>
			<td class="text-uppercase text-left">: <?php echo $mydata['tgl_mulai'];?></td>
		</tr>
	</table>

	<table style="width:100%;font-size: 12px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;padding: 5px;">
		<tr>
			<?php
				$jatah_cuti = 12;
			?>
			<td class="text-uppercase text-left" style="width:550px;">Hak Cuti Tahun <?php if($mydata['tgl_mulai']!=null){echo date('Y',strtotime($mydata['tgl_mulai']));}?></td>
			<td style="width:150px;" class="text-right">=</td>
			<td style="width:95px;" class="text-uppercase text-right"><?php echo $jatah_cuti;?></td>
			<td class="text-uppercase">hari</td>
		</tr>
		<tr>
			<?php
				$ambil_data_cuti = $crud->getDataWhere('ijin_cuti',array('id_pegawai'=>$mydata['id_pegawai'],'tgl_mulai < '=>$mydata['tgl_mulai']))->result();
				$ambil_cuti = 0;
				foreach($ambil_data_cuti as $adc){
					$ambil_cuti += $adc->durasi;
				}
			?>
			<td class="text-uppercase text-left" style="width:550px;">Cuti sudah diambil Tahun <?php if($mydata['tgl_mulai']!=null){echo date('Y',strtotime($mydata['tgl_mulai']));}?></td>
			<td style="width:150px;" class="text-right">=</td>
			<td style="width:95px;" class="text-uppercase text-right"><?php echo $ambil_cuti;?></td>
			<td class="text-uppercase">hari</td>
		</tr>
		<tr>
			<?php
				$sisa_cuti = $jatah_cuti-$ambil_cuti;
			?>
			<td class="text-uppercase text-left" style="width:550px;"></td>
			<td style="width:150px;" class="text-uppercase text-right">SISA CUTI =</td>
			<td style="width:95px;" class="text-uppercase text-right"><?php echo $sisa_cuti;?></td>
			<td class="text-uppercase">hari</td>
		</tr>
	</table>

	<table style="width:100%;font-size: 12px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;padding: 5px;">
		<tr>
			<?php
				$my_cuti = $mydata['durasi'];
			?>
			<td class="text-uppercase text-left" style="width:550px;">Mengajukan cuti</td>
			<td style="width:150px;" class="text-right">=</td>
			<td style="width:95px;" class="text-uppercase text-right"><?php echo $my_cuti;?></td>
			<td class="text-uppercase">hari</td>
		</tr>
		<tr>
			<?php
				$my_sisa_cuti = $sisa_cuti-$my_cuti;
			?>
			<td class="text-uppercase text-left" style="width:550px;"></td>
			<td style="width:150px;" class="text-uppercase text-right">SISA CUTI =</td>
			<td style="width:95px;" class="text-uppercase text-right"><?php echo $my_sisa_cuti;?></td>
			<td class="text-uppercase">hari</td>
		</tr>
	</table>

	<table style="width:100%;font-size: 10px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;padding: 5px;">
		<tr>
			<td class="text-uppercase text-left">Cuti Tgl <?php echo $mydata['tgl_mulai'];?> s/d Tgl <?php echo $mydata['tgl_akhir'];?></td>
		</tr>
		<tr>
			<td class="text-uppercase text-left">Hari Kerja &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hari, Hari Libur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hari</td>
		</tr>
	</table>
	
	<table style="width:100%;font-size: 10px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
		<tr>
			<th class="text-uppercase text-left" style="padding: 5px;width:80px;">Tujuan Cuti</th>
			<td style="padding: 5px;width: 300px;">: <?php echo $mydata['keterangan_ijin'];?></td>
			<th style="border-left:1px solid black;padding: 5px;width:200px;" class="text-uppercase text-left">No telp yg bisa dihubungi</th>
			<td style="padding: 5px;">:<br><?php echo $mydata['alasan'];?></td>
		</tr>
	</table>

	<table style="width:100%;font-size: 10px;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
		<tr>
			<th class="text-uppercase text-center">Diajukan oleh</th>
			<th class="text-uppercase text-center">Diketahui oleh</th>
			<th class="text-uppercase text-center">Disetujui oleh</th>
		</tr>
		<tr>
			<td style="height:50px;"></td>
			<td style="height:50px;"></td>
			<td style="height:50px;"></td>
		</tr>
		<tr>
			<td class="text-uppercase text-center"><?php echo $mydata['nama_pegawai'];?></td>
			<td class="text-uppercase text-center">HRD</td>
			<td class="text-uppercase text-center">DIR/OM/MGR</td>
		</tr>
		<tr>
			<td class="text-uppercase text-center">Tgl.</td>
			<td class="text-uppercase text-center">Tgl.</td>
			<td class="text-uppercase text-center">Tgl.</td>
		</tr>
	</table>
</body>
</html>