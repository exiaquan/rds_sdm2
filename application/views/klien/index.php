<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>clien/Klien/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_klien" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">No</th>
									<th class="text-uppercase text-center" style="width:auto;">ID Departemen</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama Departemen</th>
									<th class="text-uppercase text-center">Nama Klien</th>
									<th class="text-uppercase text-center">Telepon</th>
									<th class="text-uppercase text-center">Email</th>
									<th class="text-uppercase text-center">Website</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($klien as $k):?>
									<?php $departemen = $crud->getDataWhere('departemen', array('id_departemen'=>$k->id_departemen))->row_array();?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $k->id_departemen;?></td>
										<td><?php echo $k->nama_departemen;?></td>
										<td><?php echo $k->nama_klien;?></td>
										<td><?php echo $k->telepon;?></td>
                                        <td><?php echo $k->email;?></td>
										<td><?php echo $k->website;?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>clien/klien/update?id=<?php echo $k->id_klien;?>"><i class="fa fa-edit"></i></a>
											<button class="btn btn-danger btn-sm" onclick="delData(<?php echo $k->id_klien;?>);"><i class="fa fa-trash"></i></button>
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
	$('#tbl_klien').DataTable({
		'ordering':false
	});
});
function delData(id){
	var cfm = confirm('Apakah anda yakin ingin menghapus data ini ?');
	if(cfm == true){
		location.href="<?php echo base_url();?>clien/klien/delete?id="+id;
	}
}
</script>