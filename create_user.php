<?php

require_once('config.php');

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare('INSERT INTO User (Username, Email, Password) VALUES(:Username, :Email, :Password)');
	$stmt->execute(array(
		':Username' => $_POST["username"],
		':Email' => $_POST["email"],
		':Password' => password_hash($_POST["password"], PASSWORD_DEFAULT)
		));

	$result = array(
		'result' => 'success',
		'message' => 'User created.'
		);

	echo json_encode($result);

}
catch(PDOException $e) {

	$result = array(
		'result' => 'error',
		'message' => $e->getMessage()
		);

	echo json_encode($result);
}

?>