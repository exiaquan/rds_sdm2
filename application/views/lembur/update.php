<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				
				<form action="../lembur/savedataupdate" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyimpan ini ?');">
					<input type="hidden" class="form-control" name="kode" value="<?php echo $mydata['kode_lembur'];?>">

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Pegawai</label>
						</div>
						<div class="col-md-10">
							<select class="form-control select2-container" name="pegawai">
								<?php foreach($pegawai as $p):?>
								<?php if($p->id_pegawai == $mydata['id_pegawai']):?>
								<option value="<?php echo $p->id_pegawai;?>"><?php echo $p->id_pegawai;?> | <?php echo $p->nama_pegawai;?> | <?php echo $p->nama_departemen;?> | <?php echo $p->penunjukan;?></option>
								<?php endif;?>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Keterangan</label>
						</div>
						<div class="col-md-10">
							<textarea class="form-control" name="keterangan" style="height:100px;resize: none;"><?php echo $mydata['keterangan'];?></textarea>
						</div>
					</div>

					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Tanggal</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control datepicker" name="tgl" autocomplete="off" value="<?php if($mydata['tgl_lembur'] != NULL){echo date('d-m-Y',strtotime($mydata['tgl_lembur']));}?>">
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