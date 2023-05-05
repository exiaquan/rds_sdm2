<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">

				<?php echo $alert;?>
				<form action="../kehadiran/savedata" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Yakin ingin menyimpan ini ?');">
					<input type="hidden" name="myfile" id="myfile" value="<?php echo $myfile;?>">

					<div class="col-md-12" style="margin-top:10px;">
						<div class="table-responsive">
							<table class="table table-bordered" style="width:100%;font-size: 12px;">
								<tr>
									<th class="text-uppercase text-left">ID Pegawai</th>
									<th class="text-uppercase text-left">Nama Pegawai</th>
									<th class="text-uppercase text-left">Status Kehadiran</th>
									<th class="text-uppercase text-left">Shift</th>
									<th class="text-uppercase text-left">Waktu Kehadiran</th>
									<th class="text-uppercase text-left">Masuk</th>
									<th class="text-uppercase text-left">Keluar</th>
									<th class="text-uppercase text-left">Terlambat</th>
									<th class="text-uppercase text-left">Status Perijinan</th>
								</tr>
								<?php for($a=2;$a<=count($sheet);$a++){ ?>
								<?php
									$pegawai = $crud->getDataWhere('pegawai',array('id_pegawai'=>$sheet[$a]["A"]))->row_array();
								?>
								<tr>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["A"] != NULL){echo $sheet[$a]["A"];}?></td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["A"] != NULL){echo $pegawai['nama_pegawai'];}?></td>
									<td class="text-uppercase text-left">
										<?php 
										$masuk = '';
										if($sheet[$a]["D"] != NULL){
											$masuk = PHPExcel_Style_NumberFormat::toFormattedString($sheet[$a]["D"], 'hh:mm:ss');
										}

										$keluar = '';
										if($sheet[$a]["E"] != NULL){
											$keluar = PHPExcel_Style_NumberFormat::toFormattedString($sheet[$a]["E"], 'hh:mm:ss');
										}

										if($masuk != '' && $keluar != ''){
											echo 'Hadir';
										}else{
											echo 'Tdk Hadir';
										}
										?>
									</td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["B"] != NULL){echo $sheet[$a]["B"];}?></td>
									<td class="text-uppercase text-left">
									<?php if($sheet[$a]["C"] != NULL){
										$excel_date = $sheet[$a]["C"]; //here is that value 41621 or 41631
										$unix_date = ($excel_date - 25569) * 86400;
										$excel_date = 25569 + ($unix_date / 86400);
										$unix_date = ($excel_date - 25569) * 86400;
										echo gmdate("Y-m-d", $unix_date);
									}?>
									</td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["D"] != NULL){echo $masuk;}?></td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["E"] != NULL){echo $keluar;}?></td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["F"] != NULL){echo $sheet[$a]["F"];}?></td>
									<td class="text-uppercase text-left"><?php if($sheet[$a]["G"] != NULL){echo $sheet[$a]["G"];}?></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>

					<div class="col-md-12 text-center" style="margin-top:10px;">
						<a class="btn btn-default" href="<?php echo base_url();?>kehadiran/kehadiran/importexcel">Kembali</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
					</div>

				</form>

				

				
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// setInterval(myTime, 1000);

// function nol(v){
// 	if(v < 10){
//     	return "0"+v;
//     }else{
//     	return v;
//     }
// }

// function myTime(){
// 	var date = new Date();
//     var minute = date.getMinutes();
// 	var hour = date.getHours();
//     var second = date.getSeconds();
//     var thetime = nol(hour)+":"+nol(minute)+":"+nol(second);
//     var hadir = $('input[name="status"]:checked').val();
//     if(hadir == 1){
//     	$('input[name="masuk"]').val(thetime);
//     }else{
//     	$('input[name="masuk"]').val("00:00:00");
//     }
// }

// $('input[name="status"]').click(function(){
// 	myTime();
// });
</script>