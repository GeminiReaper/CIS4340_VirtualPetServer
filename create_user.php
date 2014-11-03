<?php

require_once('config.php');

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare('INSERT INTO User VALUES(:Username, :Email, :Password)');
	$stmt->execute(array(
    ':Username' => $_POST["username"],
    ':Email' => $_POST["email"],
    'Password' => password_hash($_POST["password"])
    ));

    $result = array(
    	'result' => 'success'
    );

    echo json_encode($result);

}
catch(PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}

?>