<!DOCTYPE html>
<html>
<?php echo $head;?>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<style type="text/css">
/*ATUR STYLE SELECT2 AGAR SESUAI*/
    .select2-container .select2-selection--single
    {
      width: 100%;
      height: 40px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered
    {
        line-height: 34px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow
    {
        height: 40px!important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice 
    {
        background-color: rgba(0,0,0,0.41);
        color: whitesmoke;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove 
    {
        color: whitesmoke;
    }
    span.select2-selection.select2-selection--single {
        outline: none;
    }

/* Tambahan lain */
.font-12px{
  font-size: 12px;
}

/* Modals */
/*.modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}

.modal {
  background: transparent !important;
}*/
</style>
<script type="text/javascript">
$(document).ready(function(){
  $('.select2,.select2-container').select2({placeholder:'Pilih'});
});
</script>
<body class="hold-transition skin-purple-light fixed sidebar-mini">
<div class="wrapper">
<?php echo $header;?>
<?php echo $aside;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title;?>
    <small><?php echo $sub_title;?></small>
  </h1>
  <ol class="breadcrumb">
    <?php echo $breadcrumb;?>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

  <!--------------------------
    | Your Page Content Here |
    -------------------------->
    <?php echo $content;?>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer;?>
</div>

<script type="text/javascript">
function setAsideClassActive(){
  /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
}
$(document).ready(function(){
  Pace.restart();
	setAsideClassActive();

  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  });

  $('.timepicker').datepicker({
    format: 'hh:mm:ss',
    orientation: "bottom",
    autoclose: true
  });
});
</script>
</body>
</html>