<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">

				<?php echo $alert;?>
				<form action="../kehadiran/previewdata" method="POST" enctype="multipart/form-data">
					
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Excel (Format : <a href="<?php echo base_url();?>assets/mineformat.xls">File</a>)</label>
						</div>
						<div class="col-md-8">
							<input type="file" class="form-control" name="excel" required>
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary" type="submit">Preview</button>
						</div>
					</div>

				</form>

				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<div id="tbl_kehadiran"></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// setInterval(myTime, 1000);

// function nol(v){
// 	if(v < 10){
//     	return "0"+v;
//     }else{
//     	return v;
//     }
// }

// function myTime(){
// 	var date = new Date();
//     var minute = date.getMinutes();
// 	var hour = date.getHours();
//     var second = date.getSeconds();
//     var thetime = nol(hour)+":"+nol(minute)+":"+nol(second);
//     var hadir = $('input[name="status"]:checked').val();
//     if(hadir == 1){
//     	$('input[name="masuk"]').val(thetime);
//     }else{
//     	$('input[name="masuk"]').val("00:00:00");
//     }
// }

// $('input[name="status"]').click(function(){
// 	myTime();
// });
</script>