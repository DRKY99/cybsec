<?php 
include_once './manager.php';
$message;
try {
    $db = new DBClass();
    $connection = $db->getConnection();
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("INSERT INTO user (username, password) VALUES (:username, md5(:password))");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $response = $stmt->execute();
    if($response==1){
        $message->success = true;
        $jsonMessage = json_encode($message);
        echo($jsonMessage);
    }
    else {
        throw new Exception('Database');
    }

} catch (\Throwable $th) {
    $message->success = false;
    $jsonMessage = json_encode($message);
    echo($jsonMessage);
}

?>