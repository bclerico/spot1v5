<?php
echo "starting batch\n";

require '/var/www/php/vendor/autoload.php';

$ini_array = parse_ini_file("watchmyspot.ini");
$db_host_name = $ini_array['db_host_name'];
$db_port = $ini_array['db_port'];
$db_user_id = $ini_array['db_user_id'];
$db_password = $ini_array['db_password'];
$db_name = $ini_array['db_name'];
$queueUrl = 'https://sqs.us-east-1.amazonaws.com/736551035891/SPOT_q1';

use Aws\Sqs\SqsClient;

$client = SqsClient::factory(array(
//    'profile' => '<profile in your aws credentials file>',
    'region'  => 'us-east-1'
));

for ($x=0; $x<10; $x++) {
	$result = $client->receiveMessage(array(
		'QueueUrl' => $queueUrl
	));

	if ($result['Messages'] != null) {
		foreach ($result->getPath('Messages/*/MessageId') as $messageId) {
			echo $x . "..:" . $messageId . "\n\n";
		}

		foreach ($result->getPath('Messages/*/ReceiptHandle') as $receiptHandle) {
			echo $x . "..:" . $receiptHandle . "\n\n";
		}

		foreach ($result->getPath('Messages/*/Body') as $messageBody) {
			echo $messageBody . "\n\n";
			$ar = json_decode($messageBody, true);
			echo $ar['id'] . "\n";
			echo $ar['dt'] . "\n";
			echo $ar['tp'] . "\n";
			echo $ar['lat'] . "\n";
			echo $ar['long'] . "\n";
			echo $ar['msg'] . "\n";
			echo $ar['orig_msg'] . "\n\n";
	
			$sql = "insert into spot_msg (device, latitude, longitude, location_dto, point_date_time, time_zone, subject, msg, orig_email) ";
				$sql = $sql . "VALUES ('" . $ar['id'] . "', " . $ar['lat'] . ", " . $ar['long'] . ", '" . $ar['dt'];
				$sql = $sql . "', '" . $ar['dt'] . "', '" . "UTC" . "', '" . $ar['tp'];
				$sql = $sql . "', '" . $ar['msg'] . "', '" . $ar['orig_msg'] . "');";
		
			$rs = insert_msg($sql, $db_host_name, $db_user_id, $db_password, $db_name) . "\n";
			echo $x . "..." . "Insert Result:" . $rs . "\n";
	
			if ($rs) {
				$result = $client->deleteMessage(array(
					'QueueUrl' => $queueUrl,
					'ReceiptHandle' => $receiptHandle
				));
			}
		}
	}
}
echo "finishing batch\n";

return;

function insert_msg($sql_str="", $host_name="localhost", $user_id="********", $password="********", $db_name="test", $port="3306") {
	error_reporting(E_ALL);

	if (strlen(trim($sql_str)) > 0) {
		$mysqli = new mysqli($host_name, $user_id, $password, $db_name, $port);

		if ($mysqli->connect_errno) {
			echo "mysqli_connect ERROR:";
			echo $mysqli->connect_errno . ":" . $mysqli->connect_error . "\n";
			exit;
		}
		
		$rs = $mysqli->query($sql_str);
		
		var_dump($rs);
		
		if ($rs == "") {
			echo "FALSE\n";
			echo "ERROR:" . $mysqli->error . "\n";
			return false;
		}
		else {
			echo "TRUE\n";
			mysqli_free_result($rs);
			return true;
		}
	}
}

function db_query($sql_str="", $host_name="localhost", $user_id="********", $password="********", $db_name="test", $port="3306") {

	echo "sql_str:" . $sql_str . "\n";
	echo "hostname:" . $host_name . "\n";
	echo "port:" . $port . "\n";
	echo "user_id:" . $user_id . "\n";
	echo "password:" . $password . "\n";
	echo "db_name:" . $db_name . "\n";

	error_reporting(E_ALL);

	if (strlen(trim($sql_str)) > 0) {
		$mysqli = new mysqli($host_name, $user_id, $password, $db_name, $port);

		if ($mysqli->connect_errno) {
			echo "mysqli_connect ERROR:";
			echo $mysqli->connect_errno . ":" . $mysqli->connect_error . "<br/>";
			exit;
		}
		
		$rs = $mysqli->query($sql_str);
		
		if ($rs->num_rows > 0) {
			return $rs;
		}
		else {
			return "";
		}
	}
}

function dto() {
	return Date("YmdHis");
}

?>