<?php

require_once('config.php');

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare('SELECT * FROM User WHERE Username = :Username');
	$stmt->execute(array(
    ':Username' => $_POST['username']
    ));

    $count = $stmt->rowCount();

    if($count > 0) {
    	$row = $stmt->fetch();

    	if(password_verify($_POST['password'], $row['Password'])) {

    		$data = array(
    			'userId' => $row['UserId'],
    			'username' => $row['Username'],
    			'email' => $row['Email']
    			);

    		$result = array(
    			'result' => 'success',
    			'message' => 'User logged in.'
    			);

    		$result['data'] = $data;
    		echo json_encode($result);
    	}
    	else {
    		$result = array(
    			'result' => 'error',
    			'message' => 'Invalid password.'
    			);
    		echo json_encode($result);
    	}
    }
    else {
    	$result = array(
    		'result' => 'error',
    		'message' => 'User not found.'
    		);
    	echo json_encode($result);
    }
}
catch(PDOException $e) {

	 $result = array(
    	'result' => 'error',
    	'message' => $e->getMessage()
     );

	echo json_encode($result);
}

?>