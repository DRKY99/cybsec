<?php 

include_once './manager.php';
try {
    $db = new DBClass();
    $connection = $db->getConnection();
    $username = $_GET['username'];
    $password = $_GET['password'];
    $stmt = $connection->query("SELECT id,username FROM user WHERE username='".$username."' AND password=md5('".$password."')");

    $response->success = true;
    $response->data = array();

    while ($row = $stmt->fetch()) {
        $obj->id = $row['id'];
        $obj->username =$row['username'];
        array_push($response->data,$obj);
    }
    if (empty($response->data)) {
        throw new Exception('Database');
    }

    $jsonMessage = json_encode($response);
    echo($jsonMessage);

} catch (\Throwable $th) {
    $response->success = false;
    $jsonMessage = json_encode($response);
    echo($jsonMessage);
}
?>
