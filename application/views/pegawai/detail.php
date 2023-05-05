<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
            <table class="table table-bordered" style="">
                <tr>
                    <th class="text-uppercase" style="width:20%;">ID</th>
                    <td class="text-uppercase"><?php echo $pegawai['id_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Nama</th>
                    <td class="text-uppercase"><?php echo $pegawai['nama_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Gender</th>
                    <td class="text-uppercase"><?php echo $pegawai['jns_kel_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Tempat, Tgl lahir</th>
                    <td class="text-uppercase"><?php echo $pegawai['tmp_lhr_pegawai'];?>, <?php if($pegawai['tgl_lhr_pegawai'] != NULL){echo date('d F Y',strtotime($pegawai['tgl_lhr_pegawai']));}?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Agama</th>
                    <td class="text-uppercase"><?php echo $pegawai['agama_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Status</th>
                    <td class="text-uppercase"><?php echo $pegawai['status_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Pendidikan</th>
                    <td class="text-uppercase"><?php echo $pegawai['pendidikan_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Alamat</th>
                    <td class="text-uppercase"><?php echo $pegawai['alamat_pegawai'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">Departemen</th>
                    <td class="text-uppercase"><?php echo $pegawai['id_departemen'].' - '.$pegawai['nama_departemen'];?></td>
                </tr>
                <?php $penunjukan = $crud->getDataWhere('penunjukan',array('kode_penunjukan'=>$pegawai['penunjukan']))->row_array();?>
                <tr>
                    <th class="text-uppercase">Penunjukan</th>
                    <td class="text-uppercase"><?php echo $pegawai['penunjukan'].' - '.$penunjukan['penunjukan'];?></td>
                </tr>
                <tr>
                    <th class="text-uppercase">File</th>
                    <td class="text-uppercase"><?php if($pegawai['file'] != NULL){echo '<a href="'.base_url().'assets/file/'.$pegawai['id_pegawai'].'/'.$pegawai['file'].'" target="_blank">'.$pegawai['file'].'</a>';}?></td>
                </tr>						
            </table>
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