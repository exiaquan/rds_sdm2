<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>shift/Shift/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_shift" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center">No</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama Pegawai</th>
									<th class="text-uppercase text-center">Nama Shift</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($shift as $s):?>
									<?php //$departemen=$crud->getDataWhere('departemen', array('id_departemen'=>$r->departemen))->row_array();?>
									<?php //$divisi=$crud->getDataWhere('penunjukan', array('kode_penunjukan'=>$r->divisi))->row_array();?>
									<?php $pegawai=$crud->getDataWhere('pegawai', array('id_pegawai'=>$s->id_pegawai))->row_array();?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $pegawai['nama_pegawai'];?></td>
										<td><?php echo $s->nama_shift;?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>shift/shift/update?id=<?php echo $s->id_shift;?>"><i class="fa fa-edit"></i></a>
											<button class="btn btn-danger btn-sm" onclick="delData(<?php echo $s->id_shift;?>);"><i class="fa fa-trash"></i></button>
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
	$('#tbl_resign').DataTable({
		'ordering':false
	});
});
function delData(id){
	var cfm = confirm('Apakah anda yakin ingin menghapus data ini ?');
	if(cfm == true){
		location.href="<?php echo base_url();?>shift/shift/delete?id="+id;
	}
}
</script>