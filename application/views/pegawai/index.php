<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>pegawai/datapegawai/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_pegawai" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center" style="width:auto;">No</th>
									<th class="text-uppercase text-center" style="width:auto;">ID</th>
									<th class="text-uppercase text-center" style="width:auto;">Nama</th>
									<th class="text-uppercase text-center" style="width:auto;">Gender</th>
									<th class="text-uppercase text-center">Tempat, Tanggal lahir</th>
									<th class="text-uppercase text-center">Agama</th>
									<th class="text-uppercase text-center">Status</th>
									<th class="text-uppercase text-center">Pendidikan</th>
									<th class="text-uppercase text-center">Alamat</th>
									<th class="text-uppercase text-center">Departemen</th>
									<th class="text-uppercase text-center">Penunjukan</th>
									<th class="text-uppercase text-center">File</th>
									<th class="text-uppercase text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($pegawai as $p):?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $p->id_pegawai;?></td>
										<td><a href="<?php echo base_url();?>pegawai/datapegawai/detail?id=<?php echo $p->id_pegawai;?>"><?php echo $p->nama_pegawai;?></a></td>
										<td><?php echo $p->jns_kel_pegawai;?></td>
										<td class="text-uppercase"><?php echo $p->tmp_lhr_pegawai;?>, <?php if($p->tgl_lhr_pegawai != NULL){echo date('d F Y',strtotime($p->tgl_lhr_pegawai));}?></td>
										<td><?php echo $p->agama_pegawai;?></td>
										<td><?php echo $p->status_pegawai;?></td>
										<td><?php echo $p->pendidikan_pegawai;?></td>
										<td><?php echo $p->alamat_pegawai;?></td>
										<td><?php echo $p->id_departemen.' - '.$p->nama_departemen;?></td>
										<?php $penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$p->penunjukan))->row_array();?>
										<td><?php echo $p->penunjukan.' - '.$penunjukan['penunjukan'];?></td>
										<td><?php if($p->file != NULL){echo '<a href="'.base_url().'assets/file/'.$p->id_pegawai.'/'.$p->file.'" target="_blank">'.$p->file.'</a>';}?></td>
										<td>
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>pegawai/datapegawai/update?id=<?php echo $p->id_pegawai;?>"><i class="fa fa-edit"></i></a>
											<button class="btn btn-danger btn-sm" onclick="delData(<?php echo $p->id_pegawai;?>);"><i class="fa fa-trash"></i></button>
											<a class="btn btn-default" href="<?php echo base_url();?>pegawai/datapegawai/pdfgen?id=<?php echo $p->id_pegawai;?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
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
	$('#tbl_pegawai').DataTable({
		'ordering':false,
		'paging':false,
		'dom': 'Bfrtip',
        'buttons': [
            'excel'
        ]
	});
});

function delData(id){
	var cfm = confirm('Apakah anda yakin ingin menghapus data ini ?');
	if(cfm == true){
		location.href="<?php echo base_url();?>pegawai/datapegawai/delete?id="+id;
	}
}
</script>