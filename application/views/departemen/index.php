<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>hrd/departemen/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_departemen" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">ID</th>
									<th class="text-uppercase text-center" style="width:auto;">Departemen</th>
									<th class="text-uppercase text-center" style="width:auto;">Kpl Departemen</th>
									<th class="text-uppercase text-center">Divisi</th>
									<th class="text-uppercase text-center">Total Pegawai</th>
									<th class="text-uppercase text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($departemen as $dpt):
									$total_pegawai = $crud->getDataWhere('pegawai',array('id_departemen'=>$dpt->id_departemen))->num_rows();
								?>
									<tr>
										<td><?php echo $dpt->id_departemen;?></td>
										<td><?php echo $dpt->departemen;?></td>
										<td><?php echo $dpt->kpl_departemen;?></td>
										<td><?php echo $dpt->divisi;?></td>
										<td><?php echo $total_pegawai;?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>hrd/departemen/update?id=<?php echo $dpt->id_departemen;?>"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>hrd/departemen/delete?id=<?php echo $dpt->id_departemen;?>"><i class="fa fa-trash"></i></a>
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
	$('#tbl_departemen').DataTable({
		'ordering':false
	});
});
</script>