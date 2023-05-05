<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../klien/saveDataUpdate" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
				<input type="hidden" class="form-control" name="id_klien" value="<?php echo $mydata['id_klien'];?>">
                <div class="col-md-12" style="margin-top:10px;">
					
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
							<label class="text-uppercase">Nama Klien:</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nama_klien" value="<?php echo $mydata['nama_klien'];?>">
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Telepon :</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="telepon" value="<?php echo $mydata['telepon'];?>">
						</div>
					</div>
            		<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Email :</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="email" value="<?php echo $mydata['email'];?>">
						</div>
					</div>
                    <div class="col-md-12" style="margin-top:15px;">
						<div class="col-md-2">
							<label class="text-uppercase">website</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="website" style="height:100px;resize:none;"><?php echo $mydata['website'];?></textarea>
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