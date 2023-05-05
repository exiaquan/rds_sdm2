<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<?php echo $alert;?>
				<form action="../akun/savedataupdate" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini?');">
					<input type="hidden" name="id_pegawai" value="<?php echo $login['id_pegawai'];?>">

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Username</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="username" value="<?php echo $login['username'];?>">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Password</label>
						</div>
						<div class="col-md-10">
							<input type="password" class="form-control" name="pass" value="<?php echo $login['pass'];?>">
						</div>
					</div>

					<div class="col-md-12" style="margin-top: 10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Hak Akses</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="hak_akses">
								<?php if($login['hak_akses'] == 0):?>
								<option value="0">Staff HR</option>
								<option value="1">Manager</option>
								<option value="2">Pegawai</option>
								<option value="3">null</option>
								<?php endif;?>
								<?php if($login['hak_akses'] == 1):?>
								<option value="1">Manager</option>
								<option value="2">Pegawai</option>
								<option value="3">null</option>
								<option value="0">Superuser</option>
								<?php endif;?>
								<?php if($login['hak_akses'] == 2):?>
								<option value="2">Pegawai</option>
								<option value="3">null</option>
								<option value="0">Staff HR</option>
								<option value="1">Manager</option>
								<?php endif;?>
								<?php if($login['hak_akses'] == 3):?>
								<option value="3">null</option>
								<option value="0">Staff HR</option>
								<option value="1">Manager</option>
								<option value="2">Pegawai</option>
								<?php endif;?>
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