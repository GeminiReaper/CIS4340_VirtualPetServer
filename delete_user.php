<?php

require_once('config.php');

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare('DELETE FROM User WHERE UserId = :UserId');
	$stmt->execute(array(
    'UserId' => $_POST["userId"]
    ));

  $count = $stmt.rowCount();

  if($count > 0) {
    $result = array(
      'result' => 'success',
      'message' => 'User deleted.'
      );
    echo json_encode($result);
  }
  else {
    $result = array(
      'result' => 'error',
      'message' => 'User not deleted.'
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