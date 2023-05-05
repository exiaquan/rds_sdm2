<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>perizinan/izincuti/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_izincuti" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-left">No</th>
									<th class="text-uppercase text-left">ID Pegawai</th>
									<th class="text-uppercase text-left">Nama Pegawai</th>
									<th class="text-uppercase text-left">Departemen</th>
									<th class="text-uppercase text-left">Penunjukan</th>
									<th class="text-uppercase text-left">Keterangan Izin</th>
									<th class="text-uppercase text-left">Tgl Mulai</th>
									<th class="text-uppercase text-left">Tgl Akhir</th>
									<th class="text-uppercase text-left">Durasi</th>
									<th class="text-uppercase text-center">File</th>
									<th class="text-uppercase text-left">Aksi</th>
									<!-- <th class="text-uppercase text-left">Sisa Cuti</th>
									<th class="text-uppercase text-left">Alasan</th> -->
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($izincuti as $p):
									$departemen = $crud->getDataWhere('departemen',array('id_departemen'=>$p->departemen))->row_array();
									$penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$p->penunjukan))->row_array();
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $p->id_pegawai;?></td>
									<td><?php echo $p->nama_pegawai;?></td>
									<td><?php echo $departemen['departemen'];?></td>
									<td><?php echo $penunjukan['penunjukan'];?></td>
									<td><?php echo $p->keterangan_ijin;?></td>
									<td><?php echo $p->tgl_mulai;?></td>
									<td><?php echo $p->tgl_akhir;?></td>
									<td><?php echo $p->durasi;?> HARI</td>
									<td><?php if($p->file != NULL){echo '<a href="'.base_url().'assets/file/'.$p->kode_perijinan.'/'.$p->file.'" target="_blank">'.$p->file.'</a>';}?></td>
									<td>
										<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>perizinan/izincuti/update?id=<?php echo $p->kode_perijinan;?>"><i class="fa fa-edit"></i></a>
										<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>perizinan/izincuti//delete?id=<?php echo $p->kode_perijinan;?>"><i class="fa fa-trash"></i></a>
										<a class="btn btn-default btn-sm" href="<?php echo base_url();?>perizinan/izincuti/pdfgen?id=<?php echo $p->kode_perijinan;?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
									</td>
									<!-- <td><?php echo $p->sisa_cuti;?> HARI</td> -->
									<!-- <td><?php echo $p->alasan;?></td> -->
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
$(document).ready(function(){
	$('#tbl_izincuti').DataTable({
		'ordering':false,
		'dom': 'Bfrtip',
        'buttons': [
            'excel'
        ]
	});
});
</script>