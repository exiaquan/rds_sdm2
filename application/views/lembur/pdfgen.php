<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $mydata['kode_lembur'];?></title>
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
			<th class="text-uppercase">Formulir Lembur</th>
		</tr>
	</table>

	<table style="width:100%;border-left: 1px solid black;border-right: 1px solid black;padding: 5px;border-bottom: 1px solid black;font-size: 12px;">
		<tr>
			<th class="text-uppercase text-left" style="width:100px;">Kode</th>
			<td>: <?php echo $mydata['kode_lembur'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left">Pegawai</th>
			<td>: <?php echo $mydata['id_pegawai'];?> / <?php echo $mydata['nama_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left">Departemen</th>
			<td>: <?php echo $departemen['departemen'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left">Penunjukan</th>
			<td>: <?php echo $penunjukan['penunjukan'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left">Keterangan</th>
			<td>: <?php echo $mydata['keterangan'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase text-left">Tanggal</th>
			<td>: <?php echo $mydata['tgl_lembur'];?></td>
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