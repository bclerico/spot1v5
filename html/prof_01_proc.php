<?php
include("uFunctions_1.php");
include("uFunctions_2.php");

session_start();

if (!isset($_SESSION['from'])) {
	header("Location: abort.html" );
	exit();
}

$_SESSION['uid'] = $_POST['uid'];
$_SESSION['pwd'] = $_POST['pwd'];
$_SESSION['re-pwd'] = $_POST['re-pwd'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['mi'] = $_POST['mi'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['bc_long'] = $_POST['bc_long'];
$_SESSION['bc_lat'] = $_POST['bc_lat'];
$_SESSION['spot_id'] = $_POST['spot_id'];
$_SESSION['spot_device_name'] = $_POST['spot_device_name'];

if (strlen(trim($_SESSION['uid'])) == 0) {
	$_SESSION['msg'] = "Screen Name is missing and required";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['pwd'])) == 0) {
	$_SESSION['msg'] = "Password is missing and required";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['re-pwd'])) == 0) {
	$_SESSION['msg'] = "Re-entered Password is missing and required";
	$_SESSION['status'] = 9;
}
elseif ($_SESSION['pwd'] != $_SESSION['re-pwd']) {
	$_SESSION['msg'] = "Re-entered Password does not match";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['email'])) == 0) {
	$_SESSION['msg'] = "Email Address is missing and required";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['fname'])) == 0) {
	$_SESSION['msg'] = "First Name is missing and required";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['lname'])) == 0) {
	$_SESSION['msg'] = "Last Name is missing and required";
	$_SESSION['status'] = 9;
}
else {
	if ($_SESSION['spot_id'] == "") {
		$_SESSION['spot_id'] = $_SESSION['uid'];
	}
	
	if ($_SESSION['spot_device_name'] == "") {
		$_SESSION['spot_device_name'] = $_SESSION['uid'];
	}
	
	if (update_profile()) {
		$_SESSION['msg'] = "Update Successful!";
	}
	else {
		$_SESSION['msg'] = "Update Failed!";
	}

//	$_SESSION['status'] = 1;
//	$_SESSION['goto'] = "home_01.php";	
}

if ($_SESSION['status'] == 9) {
	$_SESSION['goto'] = "prof_01.php";	
}

header("Location: ".$_SESSION['goto']);
?>
