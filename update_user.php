<?php

require_once('config.php');

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare('UPDATE User SET Email = :Email, Password = :Password WHERE UserId = :UserId');
	$stmt->execute(array(
        ':Email' => $_POST["email"],
        ':Password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
        'UserId' => $_POST["userId"]
        ));

    $result = array(
    	'result' => 'success',
    	'message' => 'User updated.'
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