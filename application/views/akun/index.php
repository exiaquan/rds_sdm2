<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12" style="margin-bottom: 10px;">
					<a class="btn btn-default" href="<?php echo base_url();?>akun/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_pegawai" style="font-size:12px;">
							<thead>
								<tr>
									<th class="text-uppercase text-left" style="width:auto;">No</th>
									<th class="text-uppercase text-left" style="width:auto;">ID</th>
									<th class="text-uppercase text-left" style="width:auto;">Nama</th>
									<th class="text-uppercase text-left" style="width:auto;">Username</th>
									<th class="text-uppercase text-left">Password</th>
									<th class="text-uppercase text-left">Hak Akses</th>
									<th class="text-uppercase text-left">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;foreach($login as $p):?>
									<tr>
										<td class="text-uppercase"><?php echo $no++;?></td>
										<td class="text-uppercase"><?php echo $p->id_pegawai;?></td>
										<td class="text-uppercase"><?php echo $p->nama_pegawai;?></td>
										<td class="text-uppercase"><?php echo $p->username;?></td>
										<td class="text-uppercase"><?php echo $p->pass;?></td>
										<td class="text-uppercase">
											<?php 
											if($p->hak_akses == 0){echo 'Superuser';}
											if($p->hak_akses == 1){echo 'Manager';}
											if($p->hak_akses == 2){echo 'HRD';}
											if($p->hak_akses == 3){echo 'Pegawai';}
											?>
										</td>
										<td class="text-uppercase">
											<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>akun/update?id=<?php echo $p->id_pegawai;?>"><i class="fa fa-edit"></i></a>
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
		'ordering':false
	});
});
</script>