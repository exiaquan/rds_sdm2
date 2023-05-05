<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>perizinan/lembur/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_lembur" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center">No</th>
									<th class="text-uppercase text-center" style="width:auto;">ID Pegawai</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama Pegawai</th>
									<th class="text-uppercase text-center">Departemen</th>
									<th class="text-uppercase text-center">Penunjukan</th>
									<th class="text-uppercase text-center">Tgl lembur</th>
									<th class="text-uppercase text-center">Keterangan</th>
									<th class="text-uppercase text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($lembur as $p):
									$departemen = $crud->getDataWhere('departemen',array('id_departemen'=>$p->departemen))->row_array();
									$penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$p->penunjukan))->row_array();
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $p->id_pegawai;?></td>
									<td><?php echo $p->nama_pegawai;?></td>
									<td><?php echo $departemen['departemen'];?></td>
									<td><?php echo $penunjukan['penunjukan'];?></td>
									<td><?php echo $p->tgl_lembur;?></td>
									<td><?php echo $p->keterangan;?></td>
									<td>
										<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>perizinan/lembur/update?id=<?php echo $p->kode_lembur;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>perizinan/lembur/delete?id=<?php echo $p->kode_lembur;?>"><i class="fa fa-trash"></i></a>
										<a class="btn btn-default btn-sm" href="<?php echo base_url();?>perizinan/lembur/pdfgen?id=<?php echo $p->kode_lembur;?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
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
	$('#tbl_lembur').DataTable({
		'ordering':false,
		'dom': 'Bfrtip',
        'buttons': [
            'excel'
        ]
	});
});
</script>