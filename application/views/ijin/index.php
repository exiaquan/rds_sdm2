<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>ijin/tambah">Tambah Ijin</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_pegawai">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:150px;">ID</th>
									<th class="text-uppercase text-center" style="width:250px;">Nama</th>
									<th class="text-uppercase text-center" style="width:90px;">Dinas</th>
									<th class="text-uppercase text-center" style="width:95px;">Durasi</th>
									<th class="text-uppercase text-center">Hari</th>
									<th class="text-uppercase text-center">Alasam</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($pegawai as $p):?>
									<tr>
										<td><?php echo $p->id;?></td>
										<td><?php echo $p->nama;?></td>
										<td><?php echo $p->dinas;?></td>
										<td><?php echo $p->durasi;?></td>
										<td><?php echo $p->hari;?></td>
										<td><?php echo $p->alasan;?></td>
									</tr>
								<?php endforeach;?>
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
	$('#tbl_produk').DataTable({
		'ordering':false
	});
});
</script>