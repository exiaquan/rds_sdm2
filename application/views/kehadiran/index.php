<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>kehadiran/kehadiran/importexcel">Import Excel</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_kehadiran" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">No</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama</th>
									<th class="text-uppercase text-center" style="width:auto;">Tanggal</th>
									<th class="text-uppercase text-center" style="width:auto;">Status</th>
									<th class="text-uppercase text-center">Masuk</th>
									<th class="text-uppercase text-center">Keluar</th>
									<th class="text-uppercase text-center">Terlambat</th>
									<th class="text-uppercase text-center">Ijin</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($kehadiran as $p):?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $p->nama_pegawai;?></td>
										<td><?php echo $p->waktu_kehadiran;?></td>
										<td class="text-uppercase"><?php echo $p->status_kehadiran;?></td>
										<td><?php echo $p->masuk;?></td>
										<td><?php echo $p->keluar;?></td>
										<td><?php echo $p->terlambat;?></td>
										<td><?php echo $p->status_perijinan;?></td>
									</tr>
								<?php $no++;endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#tbl_kehadiran').DataTable({
		'ordering':false
	});
});
</script>