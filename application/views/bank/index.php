<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>bank/akunbank/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_bank" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">No</th>
									<th class="text-uppercase text-center" style="width:auto;">ID Pegawai</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama Pegawai</th>
									<th class="text-uppercase text-center">Departemen</th>
									<th class="text-uppercase text-center">Divisi</th>
									<th class="text-uppercase text-center">No Rek</th>
									<th class="text-uppercase text-center">Nama Bank</th>
									<th class="text-uppercase text-center">Nama Akun</th>
									<th class="text-uppercase text-center">Keterangan</th>
									<th class="text-uppercase text-left">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($akunbank as $a):?>
									<?php $departemen=$crud->getDataWhere('departemen', array('id_departemen'=>$a->departemen))->row_array();?>
									<?php $divisi=$crud->getDataWhere('penunjukan', array('kode_penunjukan'=>$a->divisi))->row_array();?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $a->id_pegawai;?></td>
										<td><?php echo $a->nama_pegawai;?></td>
										<td><?php echo $departemen['departemen'];?></td>
										<td><?php echo $divisi['penunjukan'];?></td>
										<td><?php echo $a->no_rekening;?></td>
										<td><?php echo $a->nama_bank;?></td>
                                        <td><?php echo $a->nama_akun;?></td>
										<td><?php echo $a->keterangan;?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>bank/akunbank/update?id=<?php echo $a->id_akun;?>"><i class="fa fa-edit"></i></a>
											<button class="btn btn-danger btn-sm" onclick="delData(<?php echo $a->id_akun;?>);"><i class="fa fa-trash"></i></button>
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
	$('#tbl_bank').DataTable({
		'ordering':false
	});
});
function delData(id){
	var cfm = confirm('Apakah anda yakin ingin menghapus data ini ?');
	if(cfm == true){
		location.href="<?php echo base_url();?>bank/akunbank/delete?id="+id;
	}
}
</script>