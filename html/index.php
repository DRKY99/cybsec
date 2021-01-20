<?php 

include_once './manager.php';
try {
    $db = new DBClass();
    $db->getConnection();
    echo('done');
} catch (\Throwable $th) {
    echo($th);
}

try {
    echo($_POST['message']);
} catch (\Throwable $th) {
    echo('no post');
}

try {
    echo($_GET['message']);
} catch (\Throwable $th) {
    echo('no get');
}

/*
    include_once './manager.php';
    try 
    {
    $dbclass = new DBClass(); 
    $connection = $dbclass.getConnection();
    //$sql = file_get_contents("data/database.sql"); 
    //$connection->exec($sql);
    echo "Database connected!";
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    */

?>