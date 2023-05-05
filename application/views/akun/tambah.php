<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../akun/savedata" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini?');">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="id_pegawai">
							<?php foreach($pegawai as $p):?>
								<option value="<?php echo $p->id_pegawai;?>"><?php echo $p->id_pegawai;?> | <?php echo $p->nama_pegawai;?> | <?php echo $p->nama_departemen;?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Username</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="username">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Password</label>
						</div>
						<div class="col-md-10">
							<input type="password" class="form-control" name="pass">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Hak Akses</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="hak_akses">
								<option value="0">Staff HR</option>
								<option value="1">Manager</option>
								<option value="2">Pegawai</option>
								<option value="3">Null</option>
							</select>
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

<script type="text/javascript"></script>