<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_branch.php');
if(!isset($_SESSION['objLogin']) && $_SESSION['login_type'] == "5"){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";
$branch_name = '';
$b_email = '';
$b_contact_no = '';
$b_address = '';
$b_status = '';
$title = $_data['text_1'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['text_11'];
$form_url= WEB_URL . "branch/addbranch.php";
$id="";
$hdnid="0";




if(isset($_POST['txtBrName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql_branch = "INSERT INTO `tblbranch`(`branch_name`, `b_email`, `b_contact_no`, `b_address`,`b_status`) VALUES ('$_POST[txtBrName]','$_POST[txtBrEmail]','$_POST[txtBrConNo]','$_POST[txtareaAddress]','$_POST[radioStatus]')";
	mysql_query($sql_branch,$link);
	mysql_close($link);
	$url = WEB_URL . 'branch/branchlist.php?m=add';
	header("Location: $url");
	
	}
	else{
		$sql_branch = "UPDATE `tblbranch` SET `branch_name`='".$_POST['txtBrName']."',`b_email`='".$_POST['txtBrEmail']."',`b_contact_no`='".$_POST['txtBrConNo']."',`b_address`='".$_POST['txtareaAddress']."',`b_status` ='".$_POST['radioStatus']."' WHERE branch_id = '".$_GET['id']."'";
		mysql_query($sql_branch,$link);
		mysql_close($link);
		$url = WEB_URL . 'branch/branchlist.php?m=up';
		header("Location: $url");
		
	}
	$success = "block";
}
	if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tblbranch where branch_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){ 
		
		$branch_name = $row['branch_name'];
		$b_email = $row['b_email'];
		$b_contact_no = $row['b_contact_no'];
		$b_address = $row['b_address'];
		$b_status = $row['b_status'];
		$hdnid = $_GET['id'];
		$title = $_data['text_1_1'];
		$button_text = $_data['update_button_text'];
		$successful_msg = $_data['text_12'];
		$form_url = WEB_URL . "branch/addbranch.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
if(isset($_GET['mode']) && $_GET['mode'] == 'view'){
	$title = 'View Branch Details';
}
	
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1> <?php echo $title;?> </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><a href="<?php echo WEB_URL?>branch/branchlist.php"><?php echo $_data['text_2'];?></a></li>
    <li class="active"><?php echo $_data['text_1'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>branch/branchlist.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_3'];?></h3>
      </div>
      
      <!-- /.box-body --> 
    </div>
    <!-- /.box --> 
  </div>
</div>
<!-- /.row -->
<?php include('../footer.php'); ?>
