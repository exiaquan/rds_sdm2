<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				
				<form action="../penunjukan/savedata" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Kode</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="kode_penunjukan" value="<?php echo $mydata['kode_penunjukan'];?>">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Departemen</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="departemen">
							<?php foreach($departemen as $dpt):?>
								<?php if($mydata['id_departemen'] == $dpt->id_departemen):?>
								<option value="<?php echo $dpt->id_departemen;?>"><?php echo $dpt->id_departemen;?> | <?php echo $dpt->departemen;?></option>
								<?php endif;?>
							<?php endforeach;?>
							<?php foreach($departemen as $dpt):?>
								<?php if($mydata['id_departemen'] != $dpt->id_departemen):?>
								<option value="<?php echo $dpt->id_departemen;?>"><?php echo $dpt->id_departemen;?> | <?php echo $dpt->departemen;?></option>
								<?php endif;?>
							<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Penunjukan</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="penunjukan" value="<?php echo $mydata['penunjukan'];?>">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Keterangan</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="keterangan" style="height:100px;resize: none;"><?php echo $mydata['keterangan'];?></textarea>
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
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
	$('#tbl_penunjukan').DataTable({
		'ordering':false
	});
});
</script>