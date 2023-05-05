<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../datapegawai/savedataupdate" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
					<input type="hidden" class="form-control" name="id_pegawai" value="<?php echo $mydata['id_pegawai'];?>">

                    <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Nama Pegawai</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nama" value="<?php echo $mydata['nama_pegawai'];?>">
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Jenis Kelamin</label>
						</div>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="gender" value="pria" <?php if(strtolower($mydata['jns_kel_pegawai']) == "pria"){echo 'checked';}?>>Pria</label>
							<label class="radio-inline"><input type="radio" name="gender" value="wanita" <?php if(strtolower($mydata['jns_kel_pegawai']) == "wanita"){echo 'checked';}?>>Wanita</label>
						</div>
					</div>
           			<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tempat Lahir, Tgl Lahir</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" name="ttl" value="<?php echo $mydata['tmp_lhr_pegawai'];?>">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control datepicker" name="tgllahir" autocomplete="off" value="<?php if($mydata['tgl_lhr_pegawai'] != NULL){echo date('d-m-Y',strtotime($mydata['tgl_lhr_pegawai']));}?>">
						</div>
					</div>
            		<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Agama</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="agama" value="<?php echo $mydata['agama_pegawai'];?>">
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Status</label>
						</div>
						<div class="col-md-10">	
							<label class="radio-inline"><input type="radio" name="status" value="Menikah" <?php if(strtolower($mydata['status_pegawai']) == "Menikah"){echo 'checked';}?>>Menikah</label>
							<label class="radio-inline"><input type="radio" name="status" value="Belum Menikah" <?php if(strtolower($mydata['status_pegawai']) == "Belum menikah"){echo 'checked';}?>>Belum Menikah</label>
						</div>
					</div>
            		<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Pendidikan</label>
						</div>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="pendidikan" value="SMA/SMK" <?php if(strtolower($mydata['pendidikan_pegawai']) == "SMA/SMK"){echo 'checked';}?>>SMA/SMK</label>
							<label class="radio-inline"><input type="radio" name="pendidikan" value="D3" <?php if(strtolower($mydata['pendidikan_pegawai']) == "D3"){echo 'checked';}?>>D3</label>
							<label class="radio-inline"><input type="radio" name="pendidikan" value="S1" <?php if(strtolower($mydata['pendidikan_pegawai']) == "S1"){echo 'checked';}?>>S1</label>
							<label class="radio-inline"><input type="radio" name="pendidikan" value="s2" <?php if(strtolower($mydata['pendidikan_pegawai']) == "S2"){echo 'checked';}?>>S2</label>
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:15px;">
						<div class="col-md-2">
							<label class="text-uppercase">Alamat</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="alamat" style="height:100px;resize:none;"><?php echo $mydata['alamat_pegawai'];?></textarea>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Departemen</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="departemen">
							<?php foreach($departemen as $dpt):?>
							<?php if($dpt->id_departemen == $mydata['id_pegawai']):?>
								<option value="<?php echo $dpt->id_departemen;?>"><?php echo $dpt->id_departemen;?> | <?php echo $dpt->departemen;?></option>
							<?php endif;?>
							<?php endforeach;?>
							<?php foreach($departemen as $dpt1):?>
							<?php if($dpt1->id_departemen != $mydata['id_pegawai']):?>
								<option value="<?php echo $dpt1->id_departemen;?>"><?php echo $dpt1->id_departemen;?> | <?php echo $dpt1->departemen;?></option>
							<?php endif;?>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Penunjukan</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="penunjukan">
							<?php foreach($penunjukan as $pjk):?>
							<?php if($pjk->kode_penunjukan == $mydata['kode_penunjukan']):?>
								<option value="<?php echo $pjk->kode_penunjukan;?>"><?php echo $pjk->kode_penunjukan;?> | <?php echo $pjk->id_departemen;?> | <?php echo $pjk->departemen;?></option>
							<?php endif;?>
							<?php endforeach;?>
							<?php foreach($penunjukan as $pjk1):?>
							<?php if($pjk1->kode_penunjukan != $mydata['kode_penunjukan']):?>
								<option value="<?php echo $pjk1->kode_penunjukan;?>"><?php echo $pjk1->kode_penunjukan;?> | <?php echo $pjk1->id_departemen;?> | <?php echo $pjk1->departemen;?></option>
							<?php endif;?>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">File</label>
						</div>
						<div class="col-md-10">
							<input type="file" class="form-control" name="file_pegawai" value="">
							<input type="hidden" name="old_file_pegawai" value="<?php echo $mydata['file'];?>">
							<small class="text-info"><?php if($mydata['file'] != NULL){echo '<a href="'.base_url().'assets/file/'.$mydata['id_pegawai'].'/'.$mydata['file'].'">'.$mydata['file'].'</a>';}?></small>
						</div>
					</div>
            		<div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
// $("form#form-pegawai").submit(function(e) {
//     e.preventDefault();    

//     var conf = confirm("Apakah anda yakin ingin menyimpan ini ?");

//     if(conf == true){
//     	var formData = new FormData(this);

// 	    $.ajax({
// 	        url: './savedata',
// 	        type: 'POST',
// 	        data: formData,
// 	        cache: false,
// 	        contentType: false,
// 	        processData: false,
// 	        beforeSend:function(){
// 	        	$('#alert-pegawai').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Menyimpan data...</div>');
// 	        },
// 	        success: function (data) {

// 	          	$('#alert-pegawaii').html(data);
	          	 
// 	        },
// 	        error:function(xhr){
// 	        	$('#alert-pegawai').html(xhr.responseText);
// 	        }
// 	    });
//     }
// });
</script>