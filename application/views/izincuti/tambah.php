<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">

				<?php echo $alert;?>
				
				<form action="../izincuti/savedata" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');" enctype="multipart/form-data">

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="id_pegawai">
							<?php foreach($pegawai as $p):?>
								<option value="<?php echo $p->id_pegawai;?>"><?php echo $p->id_pegawai;?> | <?php echo $p->nama_pegawai;?></option>
							<?php endforeach;?>
							</select>
							<small class="text-uppercase text-info" id="detail_pegawai">*NB: Untuk departemen dan penunjukan mengikuti pegawai</small>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Keterangan Izin</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="keterangan_ijin" style="height:100px;resize:none;"></textarea>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tgl mulai</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control datepicker" name="tgl_mulai" autocomplete="off">
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tgl akhir</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control datepicker" name="tgl_akhir" autocomplete="off">
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">File</label>
						</div>
						<div class="col-md-10">
							<input type="file" class="form-control" name="file_ijin" value="">
						</div>
					</div>

					<!-- <div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Alasan</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="alasan" style="height:100px;resize: none;"></textarea>
						</div>
					</div> -->

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