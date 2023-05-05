<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../shift/saveDataUpdate" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
				<input type="hidden" class="form-control" name="id_shift" value="<?php echo $mydata['id_shift'];?>">
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
							<label class="text-uppercase">Shift</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="shift">
								<option><?php echo $mydata['nama_shift'];?></option>
								<option>Shift pagi </option>
                                <option>Shift Siang </option>
                                <option>Shift Malam </option>
							</select>
                            <div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
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