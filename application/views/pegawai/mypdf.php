<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $pegawai['id_pegawai'];?> - <?php echo $pegawai['nama_pegawai'];?></title>
	<style type="text/css">
		html,body{font-family: Arial;}
		.text-uppercase{text-transform: uppercase;}
		.text-center{text-align: center;}
		.text-left{text-align: left;}
		.text-right{text-align: right;}
	</style>
</head>
<body>
	<table style="">
		<tr>
			<th class="text-uppercase">ID</th>
			<td class="text-uppercase"><?php echo $pegawai['id_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Nama</th>
			<td class="text-uppercase"><?php echo $pegawai['nama_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Gender</th>
			<td class="text-uppercase"><?php echo $pegawai['jns_kel_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Tempat, Tgl lahir</th>
			<td class="text-uppercase"><?php echo $pegawai['tmp_lhr_pegawai'];?>, <?php if($pegawai['tgl_lhr_pegawai'] != NULL){echo date('d F Y',strtotime($pegawai['tgl_lhr_pegawai']));}?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Agama</th>
			<td class="text-uppercase"><?php echo $pegawai['agama_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Status</th>
			<td class="text-uppercase"><?php echo $pegawai['status_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Pendidikan</th>
			<td class="text-uppercase"><?php echo $pegawai['pendidikan_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Alamat</th>
			<td class="text-uppercase"><?php echo $pegawai['alamat_pegawai'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">Departemen</th>
			<td class="text-uppercase"><?php echo $pegawai['id_departemen'].' - '.$pegawai['nama_departemen'];?></td>
		</tr>
		<?php $penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$pegawai['penunjukan']))->row_array();?>
		<tr>
			<th class="text-uppercase">Penunjukan</th>
			<td class="text-uppercase"><?php echo $pegawai['penunjukan'].' - '.$penunjukan['penunjukan'];?></td>
		</tr>
		<tr>
			<th class="text-uppercase">File</th>
			<td class="text-uppercase"><?php if($pegawai['file'] != NULL){echo '<a href="'.base_url().'assets/file/'.$pegawai['id_pegawai'].'/'.$pegawai['file'].'" target="_blank">'.$pegawai['file'].'</a>';}?></td>
		</tr>						
	</table>
</body>
</html>