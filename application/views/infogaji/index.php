<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>payroll/infogaji/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_gaji" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-center">No</th>
									<th class="text-uppercase text-center">ID Pegawai</th>
									<th class="text-uppercase text-center">Nama Pegawai</th>
									<th class="text-uppercase text-center">Departemen</th>
									<th class="text-uppercase text-center">Penunjukan</th>
									<th class="text-uppercase text-center">Tgl Absen Awal</th>
									<th class="text-uppercase text-center">Tgl Absen Akhir</th>
									<th class="text-uppercase text-center">Jml Hari Kerja</th>
									<th class="text-uppercase text-center">Jml Hari Absen</th>
									<th class="text-uppercase text-center">Gaji Pokok</th>
									<th class="text-uppercase text-center">Tunjangan</th>
									<th class="text-uppercase text-center">Pot. Absen</th>
									<th class="text-uppercase text-center">Total Pot. Absen</th>
									<th class="text-uppercase text-center">Gaji diterima</th>
									<th class="text-uppercase text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($gaji as $p):
									$departemen = $crud->getDataWhere('departemen',array('id_departemen'=>$p->departemen))->row_array();
									$penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$p->penunjukan))->row_array();
								?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $p->id_pegawai;?></td>
										<td><?php echo $p->nama_pegawai;?></td>
										<td><?php echo $departemen['departemen'];?></td>
										<td><?php echo $penunjukan['penunjukan'];?></td>
										<td><?php echo $p->tgl1;?></td>
										<td><?php echo $p->tgl2;?></td>
										<td><?php echo $p->jml_hari_kerja;?></td>
										<td><?php echo $p->jml_hari_tdkmsk;?></td>
										<td><?php echo $p->gaji_pokok;?></td>
										<td><?php echo $p->gaji_tunjangan;?></td>
										<td><?php echo $p->potongan_absensi;?></td>
										<td><?php echo $p->total_potongan;?></td>
										<td><?php echo $p->total_gaji_diterima;?></td>
										<td>
											<a class="btn btn-danger btn-sm" href="<?php echo base_url();?>payroll/infogaji/delete?id=<?php echo $p->kode_slip_gaji;?>"><i class="fa fa-trash"></i></a>
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
	$('#tbl_gaji').DataTable({
		'ordering':false,
		'paging':false,
		'dom': 'Bfrtip',
        'buttons': [
            'excel'
        ]
	});
});
</script>