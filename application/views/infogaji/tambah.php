<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<form action="../infogaji/savedata" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini?');">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="pegawai">
								<option value="">(Pilih)</option>
							<?php foreach($pegawai as $p):?>
								<option value="<?php echo $p->id_pegawai;?>"><?php echo $p->id_pegawai;?> | <?php echo $p->nama_pegawai;?> | <?php echo $p->nama_departemen;?> | <?php echo $p->penunjukan;?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tgl Absen Awal</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control datepicker" name="tgl1" value="" onchange="getKehadiran();">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tgl Absen Akhir</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control datepicker" name="tgl2" value="" onchange="getKehadiran();">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Jml Hadir</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="jml_hari_kerja" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Jml Tdk Hadir</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="jml_hari_tdkmsk" value="">
							<small class="text-uppercase text-info">*NB: Minggu tdk dihitung, tdk masuk -98324</small>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">GP</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="gp" value="" onchange="hitGaji();">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tunjangan</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="tunjangan" value="" onchange="hitGaji();">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Pot. Absen</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="pot_absen" value="98324" onchange="hitGaji();">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Total Pot. Absen</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="tot_pot_absen" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Gaji</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="gaji" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#tbl_produk').DataTable({
		'ordering':false
	});
});

function getKehadiran(){
	var d = {
		tglawal:$('input[name="tgl1"]').val(),
		tglakhir:$('input[name="tgl2"]').val(),
		pegawai:$('select[name="pegawai"]').val()
	};

	$.ajax({
		url:'../infogaji/kehadiran',
		type:'POST',
		data:d,
		dataType:'JSON',
		success:function(result){
			var r = result;
			$('input[name="jml_hari_kerja"]').val(r.jml_hari_kerja);
			$('input[name="jml_hari_tdkmsk"]').val(r.jml_hari_tdkmsk);
		},error:function(xhr){
			console.log(xhr.responseText);
		}
	});
}

function hitGaji(){
	var jml_hadir = parseFloat($('input[name="jml_hari_kerja"]').val());
	var jml_tdkmsk = parseFloat($('input[name="jml_hari_tdkmsk"]').val());
	var gp = parseFloat($('input[name="gp"]').val());
	if(isNaN(gp)){
		gp = 0;
	}

	var tunjangan = parseFloat($('input[name="tunjangan"]').val());
	if(isNaN(tunjangan)){
		tunjangan = 0;
	}

	var tot_pot = (parseFloat($('input[name="pot_absen"]').val())*jml_tdkmsk);
	$('input[name="tot_pot_absen"]').val(tot_pot);
	var gaji = (gp+tunjangan)-tot_pot;
	$('input[name="gaji"]').val(gaji);
}
</script>