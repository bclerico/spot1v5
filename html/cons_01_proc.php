<?php
include("uFunctions_1.php");

session_start();
$_SESSION['device_filter'] = $_POST['device_filter'];
$_SESSION['subject_filter'] = $_POST['subject_filter'];
$_SESSION['query'] = $_POST['query'];

if (strlen(trim($_SESSION['device_filter'])) == 0) {
	$_SESSION['device_filter'] = "*";
}

/* if (strlen(trim($_SESSION['device_filter'])) == 0) {
	$_SESSION['msg'] = "Device Filter is missing and required";
	$_SESSION['status'] = 9;
}
else {
*/	
	$_SESSION['msg'] = "Using Device Filter:" . $_SESSION['device_filter'];

	$_SESSION['status'] = 1;
	$_SESSION['goto'] = "cons_01.php";	
//}
header("Location: ".$_SESSION['goto']);
?>
