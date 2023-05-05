
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../resign/savedata" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
					<div class="col-md-12">
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">ID Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="id_pegawai">
							<?php foreach($pegawai as $pgw1):?>
								<option value="<?php echo $pgw1->id_pegawai;?>"><?php echo $pgw1->id_pegawai;?> | <?php echo $pgw1->nama_pegawai;?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>	
                    <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Departemen</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="departemen">
							<?php foreach($departemen as $dpt):?>
								<option value="<?php echo $dpt->id_departemen;?>"><?php echo $dpt->id_departemen;?> | <?php echo $dpt->departemen;?></option>
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
								<option value="<?php echo $pjk->kode_penunjukan;?>"><?php echo $pjk->kode_penunjukan;?> | <?php echo $pjk->penunjukan;?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
           			<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Per Tanggal</label>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control datepicker" name="per_tanggal" autocomplete="off" value="<?php if($mydata['per_tanggal'] != NULL){echo date('d-m-Y',strtotime($mydata['per_tanggal']));}?>">
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:15px;">
						<div class="col-md-2">
							<label class="text-uppercase">Keterangan</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="keterangan" style="height:100px;resize:none;"><?php echo $mydata['keterangan'];?></textarea>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">File</label>
						</div>
						<div class="col-md-10">
							<input type="file" class="form-control" name="file_resign" value="">
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