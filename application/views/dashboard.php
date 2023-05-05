<div class="row">
	<div class="col-md-12">
		
		<div class="box box-primary">
			<div class="box-header with-bordered">
				<h1 class="box-title">Selamat datang <?php echo $this->session->userdata('nama');?></h1>
			</div>
			<div class="box-body">
				<div class="col-md-12">
					<div class="col-lg-6 col-xs-6">
						<div class="small-box bg-blue">
							<div class="inner">
								<h3><?php echo $total_pegawai;?></h3>
								<h4>L: <?php echo $total_pegawai_pria;?> | P: <?php echo $total_pegawai_wanita;?></h4>
								<p>Total Pegawai</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
						</div>
					</div>

					<div class="col-lg-6 col-xs-6">
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3><?php echo $jml_divisi;?></h3>
								<h4>&nbsp;</h4>
								<p>Jumlah Divisi</p>
							</div>
							<div class="icon">
								<i class="fa fa-briefcase"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>