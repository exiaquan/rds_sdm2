<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../departemen/savedata" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">ID</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="id_departemen" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Departemen</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="departemen" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Kpl Departemen</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="kpl_departemen" value="">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Divisi</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="divisi" value="">
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

<script type="text/javascript"></script>