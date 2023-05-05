<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>hrd/penunjukan/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_penunjukan" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">Kode</th>
									<th class="text-uppercase text-center" style="width:auto;">ID Departemen</th>
									<th class="text-uppercase text-center" style="width:auto;">Departemen</th>
									<th class="text-uppercase text-center">Penunjukan</th>
									<th class="text-uppercase text-center">Keterangan</th>
									<th class="text-uppercase text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($penunjukan as $p):?>
									<tr>
										<td><?php echo $p->kode_penunjukan;?></td>
										<td><?php echo $p->id_departemen;?></td>
										<td><?php echo $p->departemen;?></td>
										<td><?php echo $p->penunjukan;?></td>
										<td><?php echo $p->keterangan;?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>hrd/penunjukan/update?id=<?php echo $p->kode_penunjukan;?>"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>hrd/penunjukan/delete?id=<?php echo $p->kode_penunjukan;?>"><i class="fa fa-trash"></i></a>
										</td>
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
	$('#tbl_penunjukan').DataTable({
		'ordering':false
	});
});
</script>