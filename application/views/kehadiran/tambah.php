<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">

				<?php echo $alert;?>
				<form action="../kehadiran/savedata" method="POST">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Nama Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="pegawai">
								<option value="">(Pilih)</option>
							<?php foreach($pegawai as $p):?>
								<option value="<?php echo $p->id;?>"><?php echo $p->nama;?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tanggal</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control datepicker" name="tanggal" autocomplete="off" value="<?php echo date('d-m-Y');?>">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Status</label>
						</div>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="status" value="1" checked> <span>Hadir</span></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" name="status" value="0"> <span>Tidak Hadir</span></label>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Masuk</label>
						</div>
						<div class="col-md-4">
							<div class="table-responsive">
								<table style="width:100%;">
									<tr>
										<td>
											<input type="text" maxlength="2" class="form-control" name="masuk_jam" value="00">
										</td>
										<td>
											<input type="text" maxlength="2" class="form-control" name="masuk_menit" value="00">
										</td>
										<td>
											<input type="text" maxlength="2" class="form-control" name="masuk_detik" value="00">
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Keluar</label>
						</div>
						<div class="col-md-4">
							<div class="table-responsive">
								<table style="width:100%;">
									<tr>
										<td>
											<input type="text" maxlength="2" class="form-control" name="keluar_jam" value="00">
										</td>
										<td>
											<input type="text" maxlength="2" class="form-control" name="keluar_menit" value="00">
										</td>
										<td>
											<input type="text" maxlength="2" class="form-control" name="keluar_detik" value="00">
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Terlambat</label>
						</div>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="terlambat" value="terlambat"> <span>Terlambat</span></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" name="terlambat" value="tidak terlambat" checked> <span>Tidak Terlambat</span></label>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Ijin</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="ijin" value="">
							<small class="text-info">*NB: diisi jika tidak hadir</small>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button class="btn btn-primary" type="submit">Simpan</button>
						</div>
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