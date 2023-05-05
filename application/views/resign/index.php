<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>resig/resign/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_resign" style="font-size:12px;">
							<thead>
								<tr>
								<th class="text-uppercase text-center" style="width:auto;">No</th>
									<th class="text-uppercase text-center" style="width:auto;">ID Pegawai</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama Pegawai</th>
									<th class="text-uppercase text-center">Per Tanggal</th>
									<th class="text-uppercase text-center">Keterangan</th>
									<th class="text-uppercase text-center">File</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=1;foreach($resign as $r):?>
									<?php //$departemen=$crud->getDataWhere('departemen', array('id_departemen'=>$r->departemen))->row_array();?>
									<?php //$divisi=$crud->getDataWhere('penunjukan', array('kode_penunjukan'=>$r->divisi))->row_array();?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $r->id_pegawai;?></td>
										<td><?php echo $r->nama_pegawai;?></td>
										<td class="text-uppercase"> <?php if($r->per_tanggal != NULL){echo date('d F Y',strtotime($r->per_tanggal));}?></td>
                                        <td><?php echo $r->keterangan;?></td>
										<td><?php if($r->file != NULL){echo '<a href="'.base_url().'assets/file/'.$r->kode_resign.'/'.$r->file.'" target="_blank">'.$r->file.'</a>';}?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>resig/resign/update?id=<?php echo $r->kode_resign;?>"><i class="fa fa-edit"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>resig/resign/delete?id=<?php echo $r->kode_resign;?>"><i class="fa fa-trash"></i></a>
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
</script>