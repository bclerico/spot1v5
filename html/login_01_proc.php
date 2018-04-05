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

if (strlen(trim($_SESSION['uid'])) == 0) {
	$_SESSION['msg'] = "Screen Name is missing and required";
	$_SESSION['status'] = 9;
}
elseif (strlen(trim($_SESSION['pwd'])) == 0) {
	$_SESSION['msg'] = "Password is missing and required";
	$_SESSION['status'] = 9;
}
else {
	if (login_to_profile()) {
		$_SESSION['msg'] = "Login Successful!";
		$_SESSION['from'] = "prof_01.php";
		$_SESSION['goto'] = $_SESSION['goto_login_ok'];
	}
	else {
		$_SESSION['msg'] = "Login Failed!";
		$_SESSION['from'] = "login_01.php";
		$_SESSION['goto'] = "login_01.php";
	}

//	$_SESSION['status'] = 1;
//	$_SESSION['from'] = "prof_01.php";
//	$_SESSION['goto'] = "prof_01.php";
}
header("Location: ".$_SESSION['goto']);
?>
